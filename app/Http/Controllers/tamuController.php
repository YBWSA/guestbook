<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tujuan;
use App\Models\TamuMhs;
use App\Models\TamuInternal;
use App\Models\TamuEksternal;
use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
// export excel
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;



class tamuController extends Controller
{


    /**
     * tujuan bertemu
     * */
    public function getTujuan(Request $request)
    {
        $profesi = $request->get('profesi');

        $tujuan = Tujuan::where('profesi', $profesi)->get(['id', 'unit', 'jabatan', 'nama']);

        // Kelompokkan berdasarkan unit
        $grouped = $tujuan->groupBy('unit');

        $response = [];

        foreach ($grouped as $unit => $items) {
            $options = [];
            foreach ($items as $item) {
                $options[] = [
                    'id' => $item->id,
                    'text' => $item->nama . ' - ' . $item->jabatan,
                ];
            }

            $response[] = [
                'unit' => $unit,
                'data' => $options,
            ];
        }

        return response()->json($response);
    }



    /**
     * view halaman depan buku tamu
     * */
    public function view()
    {
        $tujuan = Tujuan::all()->groupBy('profesi');
        // dump($tujuan);

        return view('tamu.view', compact('tujuan'));
    }

    /**total jumlah tamu hari ini */

    public function getTotalTamuHariIni(): JsonResponse
    {
        $today = Carbon::today();

        $countMhs = TamuMhs::whereDate('created_at', $today)->count();
        $countInternal = TamuInternal::whereDate('created_at', $today)->count();
        $countEksternal = TamuEksternal::whereDate('created_at', $today)->count();

        $total = $countMhs + $countInternal + $countEksternal;

        return response()->json([
            'total' => $total,
        ]);
    }



    /**
     * Display the admin index view.
     *
     * @return \Illuminate\View\View
     */
    // This method is used to show the admin dashboard after login
    public function index()
    {
        $now = Carbon::now();
        $today = $now->toDateString();

        // Hitung per tabel untuk bulan ini
        $mhsBulan = TamuMhs::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $internalBulan = TamuInternal::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $eksternalBulan = TamuEksternal::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        // Total semua tamu bulan ini
        $totalBulan = $mhsBulan + $internalBulan + $eksternalBulan;

        // Hitung total tamu hari ini
        $mhsHari = TamuMhs::whereDate('created_at', $today)->count();
        $internalHari = TamuInternal::whereDate('created_at', $today)->count();
        $eksternalHari = TamuEksternal::whereDate('created_at', $today)->count();
        $totalHari = $mhsHari + $internalHari + $eksternalHari;

        return view('admin.index', compact(
            'mhsBulan',
            'internalBulan',
            'eksternalBulan',
            'totalHari',
            'totalBulan'
        ));
    }

    // statistik
    public function statistik()
    {
        $year = Carbon::now()->year;
        $bulan = collect(range(1, 12))->mapWithKeys(fn($m) => [$m => 0]);

        $mhs = \App\Models\TamuMhs::selectRaw('MONTH(created_at) bulan, COUNT(*) total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $internal = \App\Models\TamuInternal::selectRaw('MONTH(created_at) bulan, COUNT(*) total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        $eksternal = \App\Models\TamuEksternal::selectRaw('MONTH(created_at) bulan, COUNT(*) total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan')
            ->toArray();

        // Isi array 12 bulan secara berurutan (Jan..Des)
        $mhsData       = collect(range(1, 12))->map(fn($m) => $mhs[$m] ?? 0)->values();
        $internalData  = collect(range(1, 12))->map(fn($m) => $internal[$m] ?? 0)->values();
        $eksternalData = collect(range(1, 12))->map(fn($m) => $eksternal[$m] ?? 0)->values();

        return response()->json([
            'mhs'       => $mhsData,
            'internal'  => $internalData,
            'eksternal' => $eksternalData,
        ]);
    }

    // export excel
    public function exportExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $sheet->mergeCells('A1:O1')->setCellValue('A1', 'REKAPITULASI FRONT OFFICE SEKRETARIAT');
        $sheet->mergeCells('A2:O2')->setCellValue('A2', 'YAYASAN BADAN WAKAF SULTAN AGUNG');
        $sheet->mergeCells('A3:O3')->setCellValue('A3', 'TAHUN ' . date('Y'));
        $sheet->getStyle('A1:A3')->getFont()->setBold(true);
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header
        $sheet->mergeCells('A5:A6')->setCellValue('A5', 'No');
        $sheet->mergeCells('B5:B6')->setCellValue('B5', 'Asal / Keterangan');
        $sheet->mergeCells('C5:N5')->setCellValue('C5', 'BULAN');
        $sheet->mergeCells('O5:O6')->setCellValue('O5', 'JUMLAH');

        $bulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $col = 'C';
        foreach ($bulan as $b) {
            $sheet->setCellValue($col . '6', $b);
            $col++;
        }

        // Ambil data dari DB
        $tahun = date('Y');
        $data = [
            ['no' => 1, 'keterangan' => 'Tamu Internal', 'model' => TamuInternal::class],
            ['no' => 2, 'keterangan' => 'Tamu Luar', 'model' => TamuEksternal::class],
            ['no' => 3, 'keterangan' => 'Tamu Mahasiswa', 'model' => TamuMhs::class],
        ];

        $row = 7;
        $totalBulanan = array_fill(0, 12, 0);
        $totalSemua = 0;

        foreach ($data as &$d) {
            $sheet->setCellValue('A' . $row, $d['no']);
            $sheet->setCellValue('B' . $row, $d['keterangan']);

            $jumlahRow = 0;
            $col = 'C';
            for ($i = 1; $i <= 12; $i++) {
                $count = $d['model']::whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $i)
                    ->count();

                $sheet->setCellValue($col . $row, $count == 0 ? '-' : $count);
                $jumlahRow += $count;
                $totalBulanan[$i - 1] += $count;
                $col++;
            }

            $sheet->setCellValue('O' . $row, $jumlahRow);
            $totalSemua += $jumlahRow;
            $row++;
        }

        // Baris Total
        $sheet->mergeCells('A' . $row . ':B' . $row)->setCellValue('A' . $row, 'Total Jumlah');
        $sheet->getStyle('A' . $row . ':B' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); // CENTER

        $col = 'C';
        foreach ($totalBulanan as $t) {
            $sheet->setCellValue($col . $row, $t == 0 ? '-' : $t);
            $col++;
        }
        $sheet->setCellValue('O' . $row, $totalSemua);

        // Tambahkan background abu-abu untuk baris total
        $sheet->getStyle('A' . $row . ':O' . $row)->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D9D9D9'] // abu-abu
            ],
            'font' => ['bold' => true]
        ]);

        // Tanda tangan
        $row += 3;
        $sheet->setCellValue('A' . ($row + 1), 'Mengetahui,');
        $sheet->setCellValue('A' . ($row + 2), 'Ka. Bag WRT');
        $sheet->setCellValue('A' . ($row + 5), 'Sunarto, S.Pd');

        $sheet->setCellValue('M' . ($row + 1), 'Dibuat Oleh,');
        $sheet->setCellValue('M' . ($row + 2), 'Petugas Front Office');
        $sheet->setCellValue('M' . ($row + 5), 'Sugeng Riyadi, A.Md');

        // Styling Header
        $styleHeader = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'A9D08E'] // hijau untuk BULAN
            ]
        ];

        $styleBlue = $styleHeader;
        $styleBlue['fill']['startColor']['rgb'] = 'BDD7EE'; // biru header kiri-kanan

        $sheet->getStyle('A5:B6')->applyFromArray($styleBlue);
        $sheet->getStyle('C5:N5')->applyFromArray($styleHeader);
        $sheet->getStyle('C6:N6')->applyFromArray($styleHeader);
        $sheet->getStyle('O5:O6')->applyFromArray($styleBlue);

        // Border tabel hanya sampai baris total
        $sheet->getStyle('A5:O' . ($row - 3))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // Export
        $writer = new Xlsx($spreadsheet);
        $filename = 'rekap_tamu_' . $tahun . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }


    // tamu internal
    public function tamuInternal()
    {
        $data = TamuInternal::with('tujuanRelasi')->latest()->paginate(10);
        // dd($data);

        return view('admin.internal', ['data' => $data]);
    }

    public function tamuEksternal()
    {
        $data = TamuEksternal::with('tujuanRelasi')->latest()->paginate(10);

        return view('admin.eksternal', ['data' => $data]);
    }


    public function tamuMhs()
    {
        $data = TamuMhs::with('tujuanRelasi')->latest()->paginate(10);

        return view('admin.mahasiswa', ['data' => $data]);
    }


    // function index_latihan()
    // {
    //     return '<h1>Ini halaman buku tamu admin setelah login</h1>';
    // }
}
