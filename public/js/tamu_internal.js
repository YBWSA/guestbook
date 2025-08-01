// === Reset form tamu internal saat halaman dimuat ===
$(document).ready(function () {
    const savedTanggal = $("#tanggal_internal").val(); // simpan tanggal terlebih dahulu

    // Reset seluruh form
    $("#formTamuInternal")[0].reset();

    // Kembalikan nilai tanggal_internal
    $("#tanggal_internal").val(savedTanggal);

    // Reset dropdown profesi ke default
    $("#bertemu_dengan_internal").val(""); // reset ke "Pilih Profesi"

    // Reset selectize pihak_dituju
    if ($("#pihak_dituju")[0].selectize) {
        const selectizeControl = $("#pihak_dituju")[0].selectize;
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

    const tanggalLengkap = `${hari}, ${tanggal} ${bulan} ${tahun}`;
    $("#tanggal_internal").val(tanggalLengkap);
});

// === Pilih tujuan bertemu dan load Selectize ===
$(document).ready(function () {
    const select = $("#pihak_dituju");
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
