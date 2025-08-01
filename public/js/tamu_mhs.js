$(document).ready(function () {
    // Jalankan hanya saat modal #tamuMhs dibuka
    $("#tamuMhs").on("shown.bs.modal", function () {
        // Cegah duplikat event klik
        $("#cekNimBtn")
            .off("click")
            .on("click", function () {
                var nim = $("#inputNim").val().trim();

                if (nim === "") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops!",
                        text: "Masukkan NIM terlebih dahulu.",
                        timer: 3000,
                        showConfirmButton: false,
                    });
                    return;
                }

                $.ajax({
                    url: "http://guestbook.test/unissula/mhs",
                    type: "GET",
                    data: { nim: nim },
                    dataType: "json",
                    success: function (response) {
                        if (
                            response &&
                            response.hasil &&
                            response.hasil.length > 0
                        ) {
                            var data = response.hasil[0];

                            console.log("DATA NIM:", data);
                            console.log(
                                "INPUT NAMA ADA?",
                                $("#namaMhs").length
                            ); // log panjang

                            // Isi input otomatis
                            $("#namaMhs").val(data.nama);
                            $("#fakultas").val(data.fakultas);
                            $("#jurusan").val(data.prodi);

                            Swal.fire({
                                icon: "success",
                                title: "Data Ditemukan!",
                                text: "Data mahasiswa berhasil diambil.",
                                timer: 3000,
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Tidak Ditemukan!",
                                text: "Data dengan NIM tersebut tidak ditemukan.",
                                timer: 3000,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Terjadi kesalahan saat menghubungi server.",
                            timer: 3000,
                            showConfirmButton: false,
                        });
                    },
                });
            });
    });
});

$(document).ready(function () {
    const hariIndo = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
    ];
    const bulanIndo = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];

    const now = new Date();
    const hari = hariIndo[now.getDay()];
    const tanggal = now.getDate();
    const bulan = bulanIndo[now.getMonth()];
    const tahun = now.getFullYear();

    const tanggalLengkap = `${hari}, ${tanggal} ${bulan} ${tahun}`;
    $("#tanggal_mhs").val(tanggalLengkap);
});
