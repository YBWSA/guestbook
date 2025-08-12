function updateWaktuIndonesia() {
    const hariIndo = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
    ];
    const hariArabLatin = [
        "Ahad", // Minggu
        "Isnaini", // Senin
        "Tsulaatsaai", // Selasa
        "Arbi’aai", // Rabu
        "Khomiis", // Kamis
        "Jumu’ati", // Jumat
        "As-Sabt", // Sabtu
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
    const bulanHijriah = [
        "Muharram",
        "Safar",
        "Rabiul Awwal",
        "Rabiul Akhir",
        "Jumadil Awwal",
        "Jumadil Akhir",
        "Rajab",
        "Sya'ban",
        "Ramadhan",
        "Syawwal",
        "Dzulqa'dah",
        "Dzulhijjah",
    ];

    const now = new Date();
    const hari = hariIndo[now.getDay()];
    const hariArab = hariArabLatin[now.getDay()];
    const tanggal = now.getDate();
    const bulan = bulanIndo[now.getMonth()];
    const tahun = now.getFullYear();

    // Ambil tanggal hijriah
    const hijriParts = new Intl.DateTimeFormat("en-u-ca-islamic-umalqura", {
        day: "numeric",
        month: "numeric",
        year: "numeric",
    }).formatToParts(now);

    let hDay, hMonth, hYear;
    hijriParts.forEach((part) => {
        if (part.type === "day") hDay = part.value;
        if (part.type === "month") hMonth = part.value;
        if (part.type === "year") hYear = part.value.replace(" AH", "");
    });

    const jam = now.getHours().toString().padStart(2, "0");
    const menit = now.getMinutes().toString().padStart(2, "0");

    document.getElementById(
        "tanggal-indonesia"
    ).innerText = `${hari}, ${tanggal} ${bulan} ${tahun} M / ${hariArab}, ${hDay} ${
        bulanHijriah[parseInt(hMonth) - 1]
    } ${hYear} H`;

    document.getElementById("jam-indonesia").innerText = `${jam}:${menit} WIB`;
}

updateWaktuIndonesia();
setInterval(updateWaktuIndonesia, 30000);
