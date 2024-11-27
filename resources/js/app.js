import "./bootstrap";

function updateWaktuRealTime(elementId) {
    function updateTime() {
        const waktuElement = document.getElementById(elementId);
        if (waktuElement) {
            const sekarang = new Date();
            const waktuSekarang = sekarang.toLocaleString("id-ID", {
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
            });
            waktuElement.textContent = waktuSekarang;
        }
    }
    setInterval(updateTime, 1000);
}

window.updateWaktuRealTime = updateWaktuRealTime;
