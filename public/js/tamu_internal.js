$(document).ready(function () {
    // Jalankan autocomplete hanya saat modal muncul
    $("#tamuInternal").on("shown.bs.modal", function () {
        const $inputNama = $(this).find("#nama");

        // Hindari re-inisialisasi berkali-kali
        if (!$inputNama.data("ui-autocomplete")) {
            $inputNama.autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "http://guestbook.test/ybwsa/pegawai",
                        dataType: "json",
                        data: {
                            nama: request.term,
                        },
                        success: function (data) {
                            // console.log("Data dari API:", data);
                            response(data);
                        },
                        error: function (xhr) {
                            console.error("Gagal mengambil data:", xhr);
                        },
                    });
                },
                minLength: 2,
                select: function (event, ui) {
                    $inputNama.val(ui.item.nama);
                    $("#nip").val(ui.item.nip);
                    $("#unit").val(ui.item.unit);
                    $("#unitHomebase").val(ui.item.unitHB);
                    return false;
                },
            });
        }
    });
});
