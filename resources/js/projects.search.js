const searchInput = document.getElementById('projects-search');

const filterButtons =
    document.querySelectorAll('.filters button');

let selectedStatus = '';

let debounce;
async function loadProjects() {

    try {

        const response = await fetch(

            `/company/projects/search?search=${encodeURIComponent(
                searchInput.value
            )}&status=${selectedStatus}`

        );

        const html = await response.text();

        document.getElementById(
            'projects-table'
        ).innerHTML = html;

    } catch (error) {

        console.error(error);

    }

}
if (searchInput) {
    searchInput.addEventListener('keyup', () => {

        clearTimeout(debounce);

        debounce = setTimeout(() => {

            loadProjects();
            console.log('dsd')

        }, 300);

    });
}

filterButtons.forEach(button => {

    button.addEventListener('click', () => {

        filterButtons.forEach(btn =>
            btn.classList.remove('active')
        );

        button.classList.add('active');

        selectedStatus =
            button.dataset.status;

        loadProjects();

    });



});
