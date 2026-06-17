// function showToast(message, type = "success") {

import { openModal } from "./modal";



const openButton = document.getElementById('add-employee');
const modal = document.getElementById('invite-modal');
const closeButton = document.getElementById('close-modal');

if (openButton) {
    openButton.addEventListener('click', () => {

        openModal('invite-modal');

    });
}



