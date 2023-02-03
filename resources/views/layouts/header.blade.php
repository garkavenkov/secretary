<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid">
        <!-- <div class="logo__wrapper">
            <img src="/img/logo.svg" alt="" class="logo" style="height:48px">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div id="sidebar-toggler">
            <span class="mdi mdi-menu"></span>
        </div>
        <div id="fullscreen-toggler" data-screen="collapse" class="ms-2 d-none d-xl-block" title="Розгорнути на повний екран">
            <span class="mdi mdi-fullscreen"></span>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav m-auto">
                <search-form></search-form>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                <!-- @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a  class="dropdown-item"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="mdi mdi-exit-run me-1"></span>
                                <span>
                                    {{ __('Logout') }}
                                </span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- @endguest -->
            </ul>
        </div>
    </div>
</nav>
