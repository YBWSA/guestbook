window.updateCountToday = function () {
    // console.log('Update count dijalankan');
    fetch("http://guestbook.test/tamu/count-today")
        .then((res) => res.json())
        .then((data) => {
            const countEl = document.getElementById("count-today");

            if (data.total > 0) {
                countEl.textContent = `Jumlah total kunjungan hari ini: ${data.total}`;
                countEl.className = "text-white text-outline";
            } else {
                countEl.textContent = "Tidak ada kunjungan hari ini.";
                countEl.className = "text-white text-outline";
            }
        })
        .catch((error) => {
            document.getElementById("count-today").textContent =
                "Gagal memuat data.";
            console.error("Error:", error);
        });
};

// Panggil saat halaman dimuat
updateCountToday();

// hit api alquran, hadist arbain, hadist buluguhul maram, dan perawi.
const sources = [
    {
        name: "ayat",
        fetch: async () => {
            try {
                const res = await fetch(
                    "https://api.myquran.com/v2/quran/ayat/random"
                );
                const data = await res.json();

                const ayat = data.data.ayat.text; // Teks terjemahan ayat
                const surat = data.data.info.surat.nama.id; // Nama surat dalam bahasa Indonesia
                const nomorSurat = data.data.info.surat.id; // Nomor surat
                const nomorAyat = data.data.ayat.ayah; // Nomor ayat

                return `${ayat} - (Qs. ${surat} [${nomorSurat}]:${nomorAyat})`;
            } catch (error) {
                console.error("Gagal fetch ayat:", error);
                return "Gagal memuat ayat Al-Qur'an.";
            }
        },
    },
];

let index = 0;
const marqueeElement = document.getElementById("marquee-ayat");

async function updateMarquee() {
    marqueeElement.style.opacity = 0;

    const content = await sources[index].fetch();

    // Reset marquee: hilangkan isinya dulu
    marqueeElement.textContent = "";

    // Force reflow untuk memastikan marquee benar-benar reset
    void marqueeElement.offsetWidth;

    // Set konten baru
    marqueeElement.textContent = content;

    // Fade in
    setTimeout(() => {
        marqueeElement.style.opacity = 1;
    }, 200);

    index = (index + 1) % sources.length;
}

// Jalankan pertama kali saat halaman dimuat
updateMarquee();

// Ganti konten setiap 10 menit
setInterval(updateMarquee, 10 * 60 * 1000);

// jadwal sholat
async function tampilkanJadwalSholatBerikutnya() {
    const lokasiId = 1433; // KOTA SEMARANG
    const now = new Date();

    // Format ke YYYY/MM/DD untuk URL
    const tahun = now.getFullYear();
    const bulan = String(now.getMonth() + 1).padStart(2, "0");
    const tanggal = String(now.getDate()).padStart(2, "0");

    const url = `https://api.myquran.com/v2/sholat/jadwal/${lokasiId}/${tahun}/${bulan}/${tanggal}`;

    try {
        const res = await fetch(url);
        const json = await res.json();
        const jadwal = json.data.jadwal;

        const waktuSholat = {
            Imsak: jadwal.imsak,
            Subuh: jadwal.subuh,
            Terbit: jadwal.terbit,
            Dhuha: jadwal.dhuha,
            Dzuhur: jadwal.dzuhur,
            Ashar: jadwal.ashar,
            Maghrib: jadwal.maghrib,
            Isya: jadwal.isya,
        };

        const sekarang = now.getHours() * 60 + now.getMinutes(); // waktu sekarang dalam menit

        let sholatBerikutnya = null;

        for (const [nama, waktu] of Object.entries(waktuSholat)) {
            const [jam, menit] = waktu.split(":").map(Number);
            const waktuMenit = jam * 60 + menit;

            if (waktuMenit > sekarang) {
                sholatBerikutnya = { nama, waktu };
                break;
            }
        }

        const elemen = document.getElementById("jadwal-sholat");

        if (sholatBerikutnya) {
            elemen.textContent = `🕋 Jadwal Sholat ${sholatBerikutnya.nama} Hari Ini: ${sholatBerikutnya.waktu} WIB`;
        } else {
            // Ambil jadwal besok kalau semua waktu hari ini sudah lewat
            const besok = new Date(now);
            besok.setDate(now.getDate() + 1);
            const tahunBesok = besok.getFullYear();
            const bulanBesok = String(besok.getMonth() + 1).padStart(2, "0");
            const tanggalBesok = String(besok.getDate()).padStart(2, "0");

            const urlBesok = `https://api.myquran.com/v2/sholat/jadwal/${lokasiId}/${tahunBesok}/${bulanBesok}/${tanggalBesok}`;

            const resBesok = await fetch(urlBesok);
            const jsonBesok = await resBesok.json();
            const jadwalBesok = jsonBesok.data.jadwal;

            elemen.textContent = `🕋 Jadwal Sholat Imsak Besok: ${jadwalBesok.imsak} WIB`;
        }
    } catch (err) {
        console.error("Gagal memuat jadwal sholat:", err);
        document.getElementById("jadwal-sholat").textContent =
            "🕋 Gagal memuat jadwal sholat.";
    }
}

// Jalankan saat halaman dimuat
tampilkanJadwalSholatBerikutnya();
