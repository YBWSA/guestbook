// === Reset form tamu internal saat halaman dimuat ===
$(document).ready(function () {
    const savedTanggal = $("#tanggal_internal").val(); // simpan tanggal terlebih dahulu

    // Reset seluruh form
    $("#formTamuInternal")[0].reset();

    // Kembalikan nilai tanggal_internal
    $("#tanggal_internal").val(savedTanggal);

    // Reset dropdown profesi ke default
    $("#bertemu_dengan_internal").val(""); // reset ke "Pilih Profesi"

    // Reset selectize pihak_dituju_internal
    if ($("#pihak_dituju_internal")[0].selectize) {
        const selectizeControl = $("#pihak_dituju_internal")[0].selectize;
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

// === Autocomplete nama ===
$(document).ready(function () {
    $("#tamuInternal").on("shown.bs.modal", function () {
        const $inputNama = $(this).find("#nama");
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

// === Tanggal otomatis (Hari, Tanggal) ===
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
    $("#tanggal_internal_display").val(tanggalLengkap);

    // Format valid untuk backend (contoh: 2025-08-05)
    const bulanStr = (now.getMonth() + 1).toString().padStart(2, "0");
    const tanggalStr = tanggal.toString().padStart(2, "0");
    const tanggalForBackend = `${tahun}-${bulanStr}-${tanggalStr}`;
    $("#tanggal_internal").val(tanggalForBackend);
});

// === Pilih tujuan bertemu dan load Selectize ===
$(document).ready(function () {
    const select = $("#pihak_dituju_internal");
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

    $("#bertemu_dengan_internal").on("change", function () {
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
    $("#formTamuInternal").on("submit", function (e) {
        e.preventDefault();

        let form = $(this);
        let url = "http://guestbook.test/tamu-internal";

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
                $("#tamuInternal").modal("hide");
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
