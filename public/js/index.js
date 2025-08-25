$(document).ready(function () {
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

    let bulanSekarang = bulanIndo[new Date().getMonth()];
    $(".bulan-indo").text(bulanSekarang);
});

$(document).ready(function () {
    var tahun = new Date().getFullYear();
    $("#tahunSekarang").text(tahun);
});

$(document).ready(function () {
    $.ajax({
        url: "http://guestbook.test/statistik",
        method: "GET",
        dataType: "json",
        success: function (data) {
            console.log(data);

            var options = {
                series: [
                    {
                        name: "Tamu Mahasiswa",
                        data: data.mhs,
                    },
                    {
                        name: "Tamu Internal",
                        data: data.internal,
                    },
                    {
                        name: "Tamu Eksternal",
                        data: data.eksternal,
                    },
                ],
                chart: {
                    type: "bar",
                    height: 350,
                },
                legend: {
                    position: "top",
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "55%",
                        borderRadius: 5,
                        borderRadiusApplication: "end",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "Mei",
                        "Jun",
                        "Jul",
                        "Agu",
                        "Sep",
                        "Okt",
                        "Nov",
                        "Des",
                    ],
                },
                yaxis: {
                    title: {
                        text: "Jumlah Tamu",
                    },
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + " tamu";
                        },
                    },
                },
            };

            var chart = new ApexCharts(
                document.querySelector("#chart"),
                options
            );
            chart.render();
        },
        error: function (xhr, status, error) {
            console.error("Gagal load data statistik:", error);
        },
    });
});
