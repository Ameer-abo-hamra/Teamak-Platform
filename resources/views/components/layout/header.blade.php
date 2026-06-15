@props([
    'title',
    'subtitle',
    'searchRoute',
    'logoutRoute'
])

<header class="app-header">

    <div class="left">

        <h2>{{ $title }}</h2>

        <small>{{ $subtitle }}</small>

    </div>

    <div class="center">

        <form
            class="search"
            method="GET"
            action="#"
        >

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="q"
                placeholder="Search..."
            >

        </form>

    </div>

    <div class="right">

        <form
            action="{{ route($logoutRoute) }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="logout-btn"
            >

                Logout

                <i class="fa-solid fa-right-from-bracket"></i>

            </button>

        </form>

    </div>

</header>
