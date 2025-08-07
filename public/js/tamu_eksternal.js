// === Reset form tamu eksternal saat halaman dimuat ===
$(document).ready(function () {
    const savedTanggal = $("#tanggal_eksternal").val(); // simpan tanggal terlebih dahulu

    // Reset seluruh form
    $("#formTamuEksternal")[0].reset();

    // Kembalikan nilai tanggal_eksternal
    $("#tanggal_eksternal").val(savedTanggal);

    // Reset dropdown profesi ke default
    $("#bertemu_dengan_eksternal").val(""); // reset ke "Pilih Profesi"

    // Reset selectize pihak_dituju
    if ($("#pihak_dituju_eksternal")[0].selectize) {
        const selectizeControl = $("#pihak_dituju_eksternal")[0].selectize;
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

// set otomatis tanggal jam hari ini
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

    // Format tampil: Senin, 5 Agustus 2025
    const tanggalLengkap = `${hari}, ${tanggal} ${bulan} ${tahun}`;
    // console.log("Tanggal tampil:", tanggalLengkap); // Debug

    // Tampilkan ke pengguna
    $("#tanggal_eksternal_display").val(tanggalLengkap);

    // Format untuk backend: 2025-08-05
    const bulanStr = (now.getMonth() + 1).toString().padStart(2, "0");
    const tanggalStr = tanggal.toString().padStart(2, "0");
    const tanggalForBackend = `${tahun}-${bulanStr}-${tanggalStr}`;
    $("#tanggal_eksternal").val(tanggalForBackend);
});

// === Pilih tujuan bertemu dan load Selectize ===
$(document).ready(function () {
    const select = $("#pihak_dituju_eksternal");
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

    $("#bertemu_dengan_eksternal").on("change", function () {
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

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(document).ready(function () {
    $("#formTamuEksternal").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);
        let url = "http://guestbook.test/tamu-eksternal";

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
                $("#tamuEksternal").modal("hide");

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

// no_hp maksimal 12 digit
$(document).ready(function () {
    $("#no_hp").on("input", function () {
        // Ambil nilai saat ini
        let val = $(this).val();

        // Hapus semua karakter non-angka
        val = val.replace(/\D/g, "");

        // Potong jadi maksimal 12 digit
        if (val.length > 12) {
            val = val.substring(0, 12);
        }

        // Set kembali ke input
        $(this).val(val);
    });
});
