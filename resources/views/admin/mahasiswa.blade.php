@extends('layoutes.main')
@section('content')
    <div class="container-fluid">
        <h2 class="mb-4 mt-4">Tamu Mahasiswa</h2>

        <table class="table table-striped table-bordered" style="border: 2px solid #000;">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Fakultas</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Hari, Tanggal</th>
                    <th scope="col">Tujuan</th>
                    <th scope="col">Keperluan</th>



                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td scope="row">{{ $data->firstItem() + $index }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->fakultas }}</td>
                        <td>{{ $item->jurusan }}</td>
                        <td>{{ $item->hari_tgl }}</td>
                        <td>{{ $item->tujuanRelasi?->nama ?? '-' }}</td>
                        <td>{{ $item->keperluan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- pagination --}}
        <div class="d-flex justify-content-end mt-4">
            {{ $data->links('vendor.pagination.mono') }}

        </div>
    </div>
@endsection
