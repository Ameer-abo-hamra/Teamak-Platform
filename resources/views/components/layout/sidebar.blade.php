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
                    @php
                        $routePattern = $item['route'];
                        $isActive = false;

                        // Check exact route or parent routes
                        if (request()->routeIs($routePattern)) {
                            $isActive = true;
                        } elseif ($routePattern === 'company.employee.index' && request()->routeIs('company.employee.*')) {
                            $isActive = true;
                        } elseif ($routePattern === 'company.projects.index' && request()->routeIs(['project.*', 'company.projects.*'])) {
                            $isActive = true;
                        } elseif ($routePattern === 'company.tasks' && request()->routeIs(['task.*', 'company.tasks*'])) {
                            $isActive = true;
                        }
                    @endphp
                    <li class="{{ $isActive ? 'active' : '' }}">

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
