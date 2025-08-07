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
