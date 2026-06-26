import { showToast } from "./app";
import { closeModal } from "./modal";
import { getCsrfToken } from "./app";
const form = document.getElementById('create_task');

form?.addEventListener('submit', handleInviteSubmit);

async function handleInviteSubmit(event) {
    event.preventDefault();

    const payload = Object.fromEntries(
        new FormData(event.currentTarget).entries()
    );

    try {
        const response = await fetch('/task', {
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

        showToast(data.message, data.type || 'success');
        closeModal('create-task-modal')

    } catch (error) {
        if (error.type === 'validation_error') {
            Object.values(error.errors).forEach(messages => {
                messages.forEach(msg => {
                    showToast(msg, 'error', 5000);
                });
            });
        } else
            showToast(
                error.message || 'Unexpected error',
                error.type || 'error'
            );
    }
}
