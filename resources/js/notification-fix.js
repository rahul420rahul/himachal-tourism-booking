document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.querySelectorAll('.notification-popup, [x-show], [role="dialog"]').forEach(el => {
            el.style.display = 'none';
            el.classList.remove('show');
        });
        if (window.Alpine) {
            window.Alpine.store('notifications', { open: false });
        }
    }, 10);
});
