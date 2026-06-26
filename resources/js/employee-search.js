document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('employee-search');
    const departmentFilter = document.getElementById('department-filter');
    const statusFilter = document.getElementById('status-filter');
console.log(departmentFilter , statusFilter)
    async function searchEmployees() {
        const params = new URLSearchParams();

        if (searchInput?.value) params.append('search', searchInput.value);
        if (departmentFilter?.value) params.append('department', departmentFilter.value);
        if (statusFilter?.value) params.append('status', statusFilter.value);

        const response = await fetch(`/company-employees-search?${params.toString()}`);

        const html = await response.text();

        document.getElementById('employee-table').innerHTML = html;
    }

    if (searchInput) {
        let timer;

        searchInput.addEventListener('keyup', () => {
            clearTimeout(timer);
            timer = setTimeout(searchEmployees, 500);
        });
    }

    [departmentFilter, statusFilter].forEach(filter => {
        filter?.addEventListener('change', () => {
            console.log('filter changed');
            searchEmployees();
        });
    });

});
