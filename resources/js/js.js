// function showToast(message, type = "success") {

import { openModal } from "./modal";



const openButton = document.getElementById('add-employee');
const modal = document.getElementById('invite-modal');
const closeButton = document.getElementById('close-modal');



document.addEventListener('click', function (e) {

    // فتح المودال
    if (e.target.closest('[data-open-modal]')) {
        const id = e.target.closest('[data-open-modal]').dataset.openModal;
        console.log(id)
        openModal(id);
    }

    // إغلاق المودال
    if (e.target.closest('[data-close-modal]')) {
        e.target.closest('.modal').classList.remove('show');
    }

    // إغلاق عند الضغط خارج المحتوى
    if (e.target.classList.contains('modal')) {
        e.target.classList.remove('show');
    }

});
