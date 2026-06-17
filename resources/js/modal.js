// modal.js

function getModal(id) {
    return document.getElementById(id);
}

/**
 * Open modal by id
 */
export function openModal(id) {
    const modal = getModal(id);

    if (!modal) return;

    modal.classList.add('show');
}

/**
 * Close modal by id
 */
export function closeModal(id) {
    const modal = getModal(id);
    console.log(modal)
    if (!modal) return;

    modal.classList.remove('show');
}
