// function showToast(message, type = "success") {

import { openModal } from "./modal";

//     const container = document.getElementById("toast-container");

//     const toast = document.createElement("div");

//     toast.classList.add("toast");
//     toast.classList.add(`toast-${type}`);

//     toast.textContent = message;

//     container.appendChild(toast);

//     setTimeout(() => {
//         toast.remove();
//     }, 5000);
// }


const openButton = document.getElementById('add-employee');
const modal = document.getElementById('invite-modal');
const closeButton = document.getElementById('close-modal');

if (openButton) {
    openButton.addEventListener('click', () => {
   
        openModal('invite-modal');

    });
}



