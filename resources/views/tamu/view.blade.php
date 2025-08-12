<!DOCTYPE html>
<html>

<head>
    <title>Buku Tamu Digital YBWSA</title>
    <meta name="theme-name" content="mono" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="{{ asset('css/myCustom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/view.css') }}" />

    <link href="images/favicon.ico" rel="shortcut icon" />

    <!-- jQuery UI CSS (gunakan salah satu saja) -->
    <link rel="stylesheet" href="plugins/jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="plugins/jquery/jquery-ui.css">
    <link rel="stylesheet" href="plugins/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" href="css/selectize.bootstrap5.css">


</head>

<body>
    <!-- ===== Ayat/Hadis Harian + Jadwal Sholat (1 baris dengan separator) ===== -->
    <div
        style="width: 100%; background-color: rgba(0,0,0,0.6); padding: 8px 0; position: fixed; top: 0; z-index: 1000;">
        <div style="display: flex; align-items: center; gap: 10px; overflow: hidden;">
            <!-- Jadwal Sholat Dummy -->
            <div id="jadwal-sholat" style="white-space: nowrap; color: white; font-size: 16px; font-weight: 500;"
                class="text-outline px-3">
                🕋 Memuat jadwal sholat...
            </div>

            <!-- Garis pemisah vertikal -->
            <div style="height: 24px; width: 2px; background-color: black;"></div>

            <!--  Hadis/Ayat -->
            <marquee id="marquee-ayat" behavior="scroll" direction="left" scrollamount="5"
                style="color: white; font-size: 18px; font-weight: 500; transition: opacity 0.5s ease;"
                class="text-outline flex-grow-1">
                Memuat konten...
            </marquee>
        </div>
    </div>



    <div class="wrapper d-flex flex-column justify-content-between min-vh-100" style="padding-top: 45px;">

        {{-- Header Info --}}
        <div class="d-flex flex-column justify-content-center align-items-center text-center mt-3">
            <!-- Gambar -->
            <img src="{{ asset('images/bukutamu/logoybwsa.png') }}" alt="Logo YBWSA" class="mt-2 img-fluid"
                style="max-width: 85px;">
            <!-- Teks utama -->
            <h1 class="mt-3 mb-3">Buku Tamu Digital YBWSA</h1>
            <!-- Tanggal -->
            <h2 id="tanggal-indonesia"></h2>
            <!-- Jam -->
            <h3 id="jam-indonesia"></h3>


        </div>

        {{-- modal open --}}
        @include('tamu.modals.open_modal')

        {{-- isi modal --}}
        @include('tamu.modals.modal_internal')
        @include('tamu.modals.modal_eksternal')
        @include('tamu.modals.modal_mhs')



        {{-- Informasi Tambahan --}}
        <div class="text-center">
            <div class="text-white text-outline" id="count-wrapper">
                <p id="count-today" style="font-size: 30px">Memuat jumlah kunjungan...</p>
            </div>
        </div>


        {{-- Footer --}}
        <footer class="text-center py-3">
            <p class="text-white text-outline">YBWSA © {{ date('Y') }}</p>
        </footer>
    </div>

    <!-- Scripts (urutan sangat penting!) -->
    <script src="js/waktu.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery/jquery-ui.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="plugins/sweetalert/sweetalert2.min.js"></script>
    <script src="js/view.js"></script>
    <script src="js/tamu_internal.js"></script>
    <script src="js/tamu_eksternal.js"></script>
    <script src="js/tamu_mhs.js"></script>
    <script src="js/selectize.js"></script>
</body>

</html>
