<!DOCTYPE html>
<html>

<head>
    <title>Buku Tamu Digital YBWSA</title>
    <meta name="theme-name" content="mono" />

    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="{{ asset('css/myCustom.css') }}" />
    <link href="images/favicon.ico" rel="shortcut icon" />

    <!-- jQuery UI CSS (gunakan salah satu saja) -->
    <link rel="stylesheet" href="plugins/jquery/jquery-ui.min.css">
    <link rel="stylesheet" href="plugins/jquery/jquery-ui.css">
</head>

<body>
    <div class="wrapper d-flex flex-column justify-content-between min-vh-100">

        {{-- Header Info --}}
        <div class="d-flex flex-column justify-content-center align-items-center text-center mt-3">
            <!-- Gambar -->
            <img src="{{ asset('images/bukutamu/logoybwsa.png') }}" alt="Logo YBWSA" class="mt-2 img-fluid"
                style="max-width: 85px;">
            <!-- Teks utama -->
            <h1 class="mt-3 mb-3">Buku Tamu Digital YBWSA</h1>
            <!-- Tanggal -->
            <h2>Senin, 24 Juni 2025</h2>
            <!-- Jam -->
            <h3>13:45</h3>
        </div>

        {{-- modal open --}}
        @include('tamu.modals.open_modal')

        {{-- isi modal --}}
        @include('tamu.modals.modal_internal')
        @include('tamu.modals.modal_eksternal')
        @include('tamu.modals.modal_mhs')

        {{-- Informasi Tambahan --}}
        <div class="text-center mt-4">
            <p class="text-muted">Belum ada tamu/kunjungan hari ini.</p>
        </div>

        {{-- Footer --}}
        <footer class="text-center py-3">
            <small class="text-muted">YBWSA © {{ date('Y') }}</small>
        </footer>

    </div>

    <!-- Scripts (urutan sangat penting!) -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- jQuery UI -->
    <script src="plugins/jquery/jquery-ui.min.js"></script>

    <!-- Bootstrap Bundle -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Quill Editor -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Custom & App Scripts -->
    <script src="js/mono.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/tamu_internal.js"></script>
</body>

</html>
