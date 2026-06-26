const searchInput = document.getElementById('employee-searchs');
const statusSelect = document.querySelector('select[name="task_status"]');
const prioritySelect = document.querySelector('select[name="priority"]');
const projectSelect = document.querySelector('select[name="project_id"]');
const employeeSelect = document.querySelector('select[name="employee_id"]');

let debounce;

async function loadTasks() {
    try {
        const params = new URLSearchParams({
            search: searchInput?.value || '',
            task_status: statusSelect?.value || '',
            priority: prioritySelect?.value || '',
            project_id: projectSelect?.value || '',
            employee_id: employeeSelect?.value || '',
        });

        const response = await fetch(
            `/company-tasks?${params.toString()}`
        );

        const html = await response.text();
        const tableContainer = document.querySelector('div[id*="table"]');

        if (tableContainer) {
            tableContainer.innerHTML = html;
        }

    } catch (error) {
        console.error('Task search error:', error);
    }
}

if (searchInput) {
    searchInput.addEventListener('keyup', () => {
        clearTimeout(debounce);
        debounce = setTimeout(() => {
            loadTasks();
        }, 300);
    });
}

if (statusSelect) {
    statusSelect.addEventListener('change', () => {
        loadTasks();
    });
}

if (prioritySelect) {
    prioritySelect.addEventListener('change', () => {
        loadTasks();
    });
}

if (projectSelect) {
    projectSelect.addEventListener('change', () => {
        loadTasks();
    });
}

if (employeeSelect) {
    employeeSelect.addEventListener('change', () => {
        loadTasks();
    });
}
