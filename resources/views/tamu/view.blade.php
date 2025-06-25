<!DOCTYPE html>
<html>

<head>
    <title>Buku Tamu Digital YBWSA</title>
    <meta name="theme-name" content="mono" />

    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="css/style.css" />
    <link href="images/favicon.ico" rel="shortcut icon" />
    <link rel="stylesheet" href="css/myCustom.css" />


</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center  text-center">
        <!-- Gambar -->
        <img src="{{ asset('images/bukutamu/logoybwsa.png') }}" alt="Logo YBWSA" class="mt-2 img-fluid"
            style="max-width: 85px;">


        <!-- Teks utama -->
        <h1 class="mt-3">Buku Tamu Digital YBWSA</h1>
        <!-- Tanggal -->
        <h2>Senin, 24 Juni 2025</h2>
        <!-- Jam -->
        <h3>13:45:30</h3>
    </div>




    {{-- modal open --}}
    @include('tamu.modals.open_modal')


    {{-- isi modal --}}
    @include('tamu.modals.modal_internal')
    @include('tamu.modals.modal_eksternal')
    @include('tamu.modals.modal_mhs')



</body>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="js/mono.js"></script>
<script src="js/custom.js"></script>
</body>

</html>
