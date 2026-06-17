@props(['title', 'items' => []])

<aside class="app-side">

    <div class="aside-header">

        <p>{{ $slot }}</p>

    </div>

    <div class="aside-body">

        <div class="aside-body-header">
            <h3>{{ $title }}</h3>
        </div>

        <div class="aside-body-body">

            <ul>

                @foreach ($items as $item)
                    <li class="{{ request()->routeIs($item['route']) ? 'active' : '' }}">

                        <i class="{{ $item['icon'] }}"></i>

                        <a href=" {{ route($item['route']) }}">
                            {{ $item['label'] }}
                        </a>

                    </li>
                @endforeach

            </ul>

        </div>

    </div>

</aside>
