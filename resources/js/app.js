import './bootstrap';
import './js.js';
import './employee-invitation.js'
export function showToast(message, type = 'success') {
    const colors = {
        success: '#16a34a',
        error: '#dc2626',
        warning: '#f59e0b',
        info: '#2563eb',
    };

    const toast = document.createElement('div');

    toast.innerText = message;

    toast.style.background = colors[type] || '#2563eb';
    toast.style.color = 'white';
    toast.style.padding = '12px 16px';
    toast.style.marginTop = '10px';
    toast.style.borderRadius = '8px';
    toast.style.minWidth = '220px';
    toast.style.boxShadow = '0 4px 10px rgba(0,0,0,0.2)';
    toast.style.fontFamily = 'Arial';
    toast.style.transition = '0.3s';

    document.getElementById('toast-container').appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 3000);
}



document.addEventListener('click', function (e) {
    const closeBtn = e.target.closest('[data-close-modal]');
    // console.log(closeBtn)
    if (!closeBtn) return;

    const modal = closeBtn.closest('.modal');

    modal?.classList.remove('show');
});
