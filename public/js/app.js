/**
 * SIM-PESERTA — JavaScript Kustom
 * Menangani dismissible alert dan dialog konfirmasi hapus data.
 */

/**
 * Menyembunyikan elemen alert ketika tombol close diklik.
 * Animasi fade-out diterapkan sebelum elemen dihapus dari DOM.
 *
 * @param {HTMLElement} button - Elemen tombol close yang diklik.
 */
function dismissAlert(button) {
    const alert = button.closest('.alert');
    if (!alert) return;

    alert.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
    alert.style.opacity = '0';
    alert.style.transform = 'translateY(-6px)';

    setTimeout(function () {
        if (alert.parentNode) {
            alert.parentNode.removeChild(alert);
        }
    }, 200);
}

/**
 * Menampilkan dialog konfirmasi sebelum menghapus data peserta.
 * Membuat form hapus secara dinamis dan langsung mengirimkannya
 * agar kompatibel di seluruh browser.
 *
 * @param {string} nama      - Nama peserta yang akan dihapus (untuk ditampilkan dalam dialog).
 * @param {string} actionUrl - URL endpoint untuk menghapus data peserta.
 */
function confirmDelete(nama, actionUrl) {
    var pesan = 'Apakah Anda yakin ingin menghapus data peserta "' + nama + '"?\n\nTindakan ini tidak dapat dibatalkan.';

    if (!confirm(pesan)) return;

    var form = document.createElement('form');
    form.method = 'POST';
    form.action = actionUrl;
    form.style.display = 'none';

    var csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrf);

    var method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';
    form.appendChild(method);

    document.body.appendChild(form);
    form.submit();
}

/**
 * Menutup alert secara otomatis setelah 5 detik.
 * Hanya diterapkan pada elemen dengan id "flash-alert".
 */
document.addEventListener('DOMContentLoaded', function () {
    var flashAlert = document.getElementById('flash-alert');
    if (flashAlert) {
        setTimeout(function () {
            var closeBtn = flashAlert.querySelector('.alert-close');
            if (closeBtn) {
                dismissAlert(closeBtn);
            }
        }, 5000);
    }
});
