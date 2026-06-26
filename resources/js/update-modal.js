import { showToast, getCsrfToken } from './app';
import { closeModal } from './modal';

function applyValueToField(modal, name, value) {
    const field = modal.querySelector(`[name="${name}"]`);
    if (!field) return;

    if (field.tagName === 'SELECT') {
        field.value = value ?? '';
        return;
    }

    if (field.type === 'checkbox') {
        field.checked = !!value;
        return;
    }

    field.value = value ?? '';
}

function updateProjectRow(project) {
    const row = document.querySelector(`[data-project-row-id="${project.id}"]`);
    if (!row) return;

    const titleEl = row.querySelector('.right p');
    if (titleEl) titleEl.textContent = project.title;

    const descEl = row.querySelector('.right small');
    if (descEl) descEl.textContent = project.description || '';

    const statusBadge = row.querySelector('.project-status');
    if (statusBadge) {
        statusBadge.textContent = project.project_status || '-';
        statusBadge.className = `project-status ${project.project_status ? `s-${project.project_status.toLowerCase()}` : ''}`;
    }

    const deadlineCell = row.querySelector('.project-deadline');
    if (deadlineCell) {
        deadlineCell.textContent = project.end_date || '-';
    }
}

function updateEmployeeRow(employee) {
    const row = document.querySelector(`[data-employee-row-id="${employee.id}"]`);
    if (!row) return;

    const nameEl = row.querySelector('.right p');
    if (nameEl) {
        nameEl.textContent = `${employee.first_name} ${employee.last_name}`;
    }

    const emailEl = row.querySelector('.right small');
    if (emailEl) {
        emailEl.textContent = employee.email || '';
    }

    const titleCell = row.querySelector('.employee-title');
    if (titleCell) {
        titleCell.textContent = employee.job_title || '-';
    }

    const statusBadge = row.querySelector('.employee-status-badge');
    if (statusBadge) {
        statusBadge.textContent = employee.account_status || '-';
        statusBadge.className = `employee-status-badge ${employee.account_status === 'active' ? 's-active' : 's-in-active'}`;
    }
}

function updateTaskRow(task) {
    const row = document.querySelector(`[data-task-row-id="${task.id}"]`);
    if (!row) return;

    const titleEl = row.querySelector('.right p');
    if (titleEl) {
        titleEl.textContent = task.title;
    }

    const descEl = row.querySelector('.right small');
    if (descEl) {
        descEl.textContent = task.description ? task.description.substring(0, 40) : '';
    }

    const projectCell = row.querySelector('.task-project span');
    if (projectCell) {
        projectCell.textContent = task.project?.title || '-';
    }

    const priorityBadge = row.querySelector('td:nth-child(4) span');
    if (priorityBadge) {
        priorityBadge.textContent = task.priority || '-';
        priorityBadge.className = `p-${task.priority?.toLowerCase() ?? ''}`.trim();
    }

    const statusBadge = row.querySelector('td:nth-child(5) span');
    if (statusBadge) {
        statusBadge.textContent = task.task_status || '-';
        statusBadge.className = `s-${task.task_status?.toLowerCase() ?? ''}`.trim();
    }

    const dueCell = row.querySelector('td:nth-child(6)');
    if (dueCell) {
        dueCell.textContent = task.end_date || '-';
    }
}

// open edit modals that have data-edit-modal and data-url attributes
document.addEventListener('click', async (e) => {
    const btn = e.target.closest('[data-edit-modal]');
    if (!btn) return;

    const modalId = btn.dataset.editModal;
    const url = btn.dataset.url;
    const updateEndpoint = btn.dataset.endpoint;
    const method = btn.dataset.method || 'GET';

    const modal = document.getElementById(modalId);
    if (modal && updateEndpoint) {
        const form = modal.querySelector('.ajax-update');
        if (form) {
            form.dataset.endpoint = updateEndpoint;
        }
    }

    try {
        if (url) {
            const res = await fetch(url, {
                method,
                headers: {
                    Accept: 'application/json',
                },
            });

            if (!res.ok) {
                showToast('Unable to load edit data', 'error');
                return;
            }

            const data = await res.json();
            if (!modal) return;

            Object.keys(data).forEach((key) => {
                applyValueToField(modal, key, data[key]);
            });
            modal.classList.add('show');
            return;
        }

        if (modal) {
            const dataset = btn.dataset;
            Object.keys(dataset).forEach((key) => {
                if (['editModal', 'url', 'method', 'endpoint'].includes(key)) return;
                applyValueToField(modal, key, dataset[key]);
            });
            modal.classList.add('show');
        }
    } catch (err) {
        console.error(err);
        showToast('Failed to load edit data', 'error');
    }
});

// handle ajax submit for any form with class ajax-update and data-endpoint
document.addEventListener('submit', async (e) => {
    const form = e.target.closest('.ajax-update');
    if (!form) return;
    e.preventDefault();

    const endpoint = form.dataset.endpoint;
    if (!endpoint) {
        showToast('No update endpoint configured', 'error');
        return;
    }

    const origMethod = (form.dataset.method || 'POST').toUpperCase();
    const methodInput = form.querySelector('input[name="_method"]');
    const method = methodInput && methodInput.value ? methodInput.value.toUpperCase() : origMethod;

    const payload = Object.fromEntries(new FormData(form).entries());

    try {
        const res = await fetch(endpoint, {
            method,
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify(payload),
        });

        const data = await res.json();
        if (!res.ok) throw data;

        showToast(data.message || 'Updated successfully', data.type || 'success');
        const modal = form.closest('.modal');
        if (modal) {
            closeModal(modal.id);
        }

        if (data.project) {
            updateProjectRow(data.project);
        }

        if (data.employee) {
            updateEmployeeRow(data.employee);
        }

        if (data.task) {
            updateTaskRow(data.task);
        }
    } catch (err) {
        if (err && err.type === 'validation_error') {
            Object.values(err.errors).forEach((messages) => messages.forEach((message) => showToast(message, 'error', 5000)));
        } else {
            showToast(err.message || 'Update failed', err.type || 'error');
        }
    }
});
