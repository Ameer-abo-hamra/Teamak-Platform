import { showToast } from "./app";
import { closeModal } from "./modal";

const form = document.getElementById('invite-form');

form?.addEventListener('submit', handleInviteSubmit);

async function handleInviteSubmit(event) {
    event.preventDefault();

    const payload = Object.fromEntries(
        new FormData(event.currentTarget).entries()
    );

    try {
        const response = await fetch('/invitations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify(payload),
        });

        const data = await response.json();

        if (!response.ok) {
            throw data;
        }
        form.reset();
        // ✅ SUCCESS TOAST
        showToast(data.message, data.type || 'success');
        closeModal('invite-modal')

    } catch (error) {
        // ❌ ERROR TOAST
        showToast(
            error.message || 'Unexpected error',
            error.type || 'error'
        );
    }
}
function getCsrfToken() { return document.querySelector('meta[name="csrf-token"]')?.content; }
