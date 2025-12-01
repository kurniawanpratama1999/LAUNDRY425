@php
    $menus = Auth::user()->level->menus;
@endphp

<nav id="nav" class="navbar navbar-expand-lg bg-white fixed-top shadow">
    <div class="container-fluid">
        {{-- BRAND --}}
        <a class="navbar-brand" href="#">Laundry</a>

        {{-- TOGGLE --}}
        <button class="border-0 bg-transparent d-lg-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- CANVAS --}}
        <div class="offcanvas offcanvas-lg offcanvas-end" tabindex="-1" id="navbarOffcanvasLg"
            aria-labelledby="navbarOffcanvasLgLabel">

            {{-- CANVAS BODY --}}
            <div class="offcanvas-body">

                {{-- CANVAS BODY MENU --}}
                <ul class="navbar-nav justify-content-end flex-grow-1 column-gap-3">

                    {{-- CANVAS BODY DROPDOWN 1 --}}
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            aria-expanded="false">
                            Master
                        </button>

                        <ul class="dropdown-menu">
                            @foreach ($menus as $menu)
                                @if ($menu->master === 'true' && $menu->master !== 'hidden')
                                    <li><a class="dropdown-item text-capitalize"
                                            href="{{ $menu->link }}">{{ $menu->name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>

                    @foreach ($menus as $menu)
                        @if ($menu->master === 'false' && $menu->master !== 'hidden')
                            <li class="nav-item">
                                <a href="{{ $menu->link }}" class="nav-link text-capitalize">{{ $menu->name }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- CANVAS LIST 5 --}}
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
