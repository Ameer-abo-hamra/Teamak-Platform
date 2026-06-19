const searchInput = document.getElementById('employee-search');

async function searchEmployees() {

    const response = await fetch(
        `/employees/search?search=${searchInput.value}`
    );

    const html = await response.text();

    document.getElementById(
        'employee-table'
    ).innerHTML = html;
}

let timer;

searchInput.addEventListener('keyup', () => {

    clearTimeout(timer);

    timer = setTimeout(() => {

        searchEmployees();

    }, 500);

});
