import { showToast } from "./app";
import { closeModal } from "./modal";
import { getCsrfToken } from "./app";
const form = document.getElementById('create_project');
const tbody = document.getElementById('projects-tbody');
form?.addEventListener('submit', handleInviteSubmit);

async function handleInviteSubmit(event) {
    event.preventDefault();

    const payload = Object.fromEntries(
        new FormData(event.currentTarget).entries()
    );

    try {
        const response = await fetch('project', {
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
        closeModal('create-project-modal')
        addProjectToTable(data.project);
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
function addProjectToTable(project) {

    const row = document.createElement('tr');

    row.innerHTML = `
        <td class="first">
            <div class="left">
                <p>${project.title.charAt(0).toUpperCase()}</p>
            </div>

            <div class="right">
                <p>${project.title}</p>
                <small>${project.description ?? ''}</small>
            </div>
        </td>

        <td class="third">
            <span>${project.department ?? '-'}</span>
        </td>

        <td class="second">
            <span>0%</span>
        </td>

        <td>
            <span class="s-active">
                ${project.status}
            </span>
        </td>

        <td class="second">
            ${project.end_date ?? '-'}
        </td>

        <td class="second">
            ${project.employees_count ?? 0}
        </td>

        <td>
            <span class="update">
                <i class="fa-regular fa-pen-to-square"></i>
            </span>

            <span class="show-row">
                <i class="fa-regular fa-eye"></i>
            </span>
        </td>
    `;

    // إضافة في بداية الجدول
    tbody.prepend(row);
}