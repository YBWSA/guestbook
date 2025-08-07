// === Reset form tamu mhs saat halaman dimuat ===
$(document).ready(function () {
    const savedTanggal = $("#tanggal_mhs").val(); // simpan tanggal terlebih dahulu

    // Reset seluruh form
    $("#formTamuMhs")[0].reset();

    // Kembalikan nilai tanggal_mhs
    $("#tanggal_mhs").val(savedTanggal);

    // Reset dropdown profesi ke default
    $("#bertemu_dengan_mhs").val(""); // reset ke "Pilih Profesi"

    // Reset selectize pihak_dituju
    if ($("#pihak_dituju_mhs")[0].selectize) {
        const selectizeControl = $("#pihak_dituju_mhs")[0].selectize;
        selectizeControl.clear(true);
        selectizeControl.clearOptions();
        selectizeControl.clearOptionGroups();
        selectizeControl.addOption({
            id: "",
            text: "Pilih Pihak yang Dituju",
            unit: "",
        });
        selectizeControl.refreshOptions(false);
    }
});

// cari data dengan nim
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
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    return;
                }

                // Tampilkan loading sebelum AJAX diproses
                Swal.fire({
                    title: "Sedang Mencari Data...",
                    text: "Mohon tunggu sebentar.",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    url: "http://guestbook.test/unissula/mhs",
                    type: "GET",
                    data: { nim: nim },
                    dataType: "json",
                    success: function (response) {
                        Swal.close(); // Tutup loading swal

                        if (
                            response &&
                            response.hasil &&
                            response.hasil.length > 0
                        ) {
                            var data = response.hasil[0];

                            // console.log("DATA NIM:", data);
                            // console.log(
                            //     "INPUT NAMA ADA?",
                            //     $("#namaMhs").length
                            // );

                            // Isi input otomatis
                            $("#namaMhs").val(data.nama);
                            $("#fakultas").val(data.fakultas);
                            $("#jurusan").val(data.prodi);

                            Swal.fire({
                                icon: "success",
                                title: "Data Ditemukan!",
                                text: "Data mahasiswa berhasil diambil.",
                                timer: 1500,
                                showConfirmButton: false,
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Tidak Ditemukan!",
                                text: "Data dengan NIM tersebut tidak ditemukan.",
                                timer: 1500,
                                showConfirmButton: false,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.close(); // Tutup loading swal
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

// otomatis tanggal hari, bulan hari ini
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

    // Format tampil (contoh: Senin, 5 Agustus 2025)
    const tanggalLengkap = `${hari}, ${tanggal} ${bulan} ${tahun}`;
    $("#tanggal_mhs_display").val(tanggalLengkap);

    // Format valid untuk backend (contoh: 2025-08-05)
    const bulanStr = (now.getMonth() + 1).toString().padStart(2, "0");
    const tanggalStr = tanggal.toString().padStart(2, "0");
    const tanggalForBackend = `${tahun}-${bulanStr}-${tanggalStr}`;
    $("#tanggal_mhs").val(tanggalForBackend);
});

// === Pilih tujuan bertemu dan load Selectize ===
$(document).ready(function () {
    const select = $("#pihak_dituju_mhs");
    const selectizeInstance = select.selectize({
        create: false,
        sortField: "text",
        optgroupField: "unit",
        labelField: "text",
        valueField: "id",
        searchField: "text",
        onInitialize: function () {
            this.$control.addClass("form-control");
        },
    });

    const selectizeControl = selectizeInstance[0].selectize;

    $("#bertemu_dengan_mhs").on("change", function () {
        const profesi = $(this).val();

        selectizeControl.clear(true);
        selectizeControl.clearOptionGroups();
        selectizeControl.addOption({
            id: "",
            text: "Memuat data...",
            unit: "",
        });
        selectizeControl.refreshOptions();

        $.ajax({
            url: "http://guestbook.test/tamu/get-tujuan",
            type: "GET",
            data: { profesi: profesi },
            success: function (res) {
                selectizeControl.clearOptions();
                selectizeControl.clearOptionGroups();

                res.forEach(function (group) {
                    const groupId = group.unit
                        .toLowerCase()
                        .replace(/\s+/g, "-");
                    selectizeControl.addOptionGroup(groupId, {
                        label: group.unit.toUpperCase(),
                    });

                    group.data.forEach(function (item) {
                        selectizeControl.addOption({
                            id: item.id,
                            text: item.text,
                            unit: groupId,
                        });
                    });
                });

                selectizeControl.refreshOptions(false);
            },
            error: function () {
                selectizeControl.clearOptions();
                selectizeControl.addOption({
                    id: "",
                    text: "Gagal memuat data",
                    unit: "",
                });
                selectizeControl.refreshOptions(false);
            },
        });
    });
});

// data tamu post

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $("#formTamuMhs").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);
        let url = "http://guestbook.test/tamu-mhs";

        // Hapus error sebelumnya
        form.find(".is-invalid").removeClass("is-invalid");
        form.find(".invalid-feedback").remove();

        $.ajax({
            url: url,
            method: "POST",
            data: form.serialize(),
            success: function (res) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message,
                    timer: 2000,
                    showConfirmButton: false,
                });

                form.trigger("reset");
                $("#tamuMhs").modal("hide");

                // ✅ Menjadi ini:
                if (typeof updateCountToday === "function") {
                    updateCountToday();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let input = form.find(`[name="${key}"]`);
                        input.addClass("is-invalid");
                        input.after(
                            `<div class="invalid-feedback">${value[0]}</div>`
                        );
                    });

                    Swal.fire({
                        icon: "error",
                        title: "Validasi Gagal",
                        text: "Silakan periksa kembali data yang diinput.",
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Terjadi kesalahan pada server.",
                    });
                }
            },
        });
    });
});
