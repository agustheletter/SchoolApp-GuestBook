// Loading Function
function showLoading() {
    const loading = document.getElementById('loadingOverlay');
    loading.classList.remove('opacity-0', 'pointer-events-none');
    loading.classList.add('opacity-100', 'pointer-events-auto');
}

function hideLoading() {
    const loading = document.getElementById('loadingOverlay');
    loading.classList.remove('opacity-100', 'pointer-events-auto');
    loading.classList.add('opacity-0', 'pointer-events-none');
}

// Deteksi ketika halaman dimuat ulang dari cache browser (Back button)
window.addEventListener('pageshow', function (event) {
    const isBack = event.persisted || performance.getEntriesByType("navigation")[0]?.type === "back_forward";
    if (isBack) {
        // Tampilkan loader dulu biar smooth
        showLoading();

        // Delay 300ms–800ms, baru hide
        setTimeout(() => {
            hideLoading();
        }, 800); // 0.8 detik
    }
});

// Munculkan loading saat klik link (kecuali target="_blank" atau javascript:void)
document.addEventListener("DOMContentLoaded", () => {
    // Fallback: Sembunyikan loading saat DOM siap
    hideLoading();

    // FORM SUBMIT
    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
        form.addEventListener("submit", () => {
            showLoading();
        });
    });

    // LINK CLICK
    const links = document.querySelectorAll("a[href]:not([target='_blank'])");
    links.forEach(link => {
        link.addEventListener("click", function(e) {
            const href = this.getAttribute("href");

            if (href.startsWith("#") || href.startsWith("javascript:")) return;

            e.preventDefault(); // Stop dulu

            showLoading();

            setTimeout(() => {
                window.location.href = href; // Pindah halaman setelah loading muncul
            }, 150); // Delay 150ms
        });
    });
});

// Hilangkan loader setelah semua konten dimuat
window.addEventListener('load', () => {
    setTimeout(() => {
        hideLoading();
    }, 800); // delay lebih lama di refresh (misal 800ms)
});
