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

    const now = new Date(); // waktu lokal otomatis
    const hari = hariIndo[now.getDay()];
    const tanggal = now.getDate();
    const bulan = bulanIndo[now.getMonth()];
    const tahun = now.getFullYear();

    const jam = now.getHours().toString().padStart(2, "0");
    const menit = now.getMinutes().toString().padStart(2, "0");

    document.getElementById(
        "tanggal-indonesia"
    ).innerText = `${hari}, ${tanggal} ${bulan} ${tahun}`;
    document.getElementById("jam-indonesia").innerText = `${jam}:${menit}`;
}

// Jalankan saat halaman dimuat
updateWaktuIndonesia();

// Update setiap 30 detik
setInterval(updateWaktuIndonesia, 30000);
