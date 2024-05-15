<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid">

        <div id="sidebar-toggler">            
            <!-- shrink sidebar menu -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <title>Стиснути меню</title>
                <path d="M21,15.61L19.59,17L14.58,12L19.59,7L21,8.39L17.44,12L21,15.61M3,6H16V8H3V6M3,13V11H13V13H3M3,18V16H16V18H3Z" />
            </svg>
            <!-- expand menu -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <title>Розгорнути меню</title>
                <path d="M3 6H13V8H3V6M3 16H13V18H3V16M3 11H15V13H3V11M16 7L14.58 8.39L18.14 12L14.58 15.61L16 17L21 12L16 7Z" />
            </svg>
            
        </div>
        <div id="fullscreen-toggler" data-screen="collapse" class="ms-2 d-none d-xl-block" title="Розгорнути на повний екран">
            <!-- expand  icon-->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5,5H10V7H7V10H5V5M14,5H19V10H17V7H14V5M17,14H19V19H14V17H17V14M10,17V19H5V14H7V17H10Z" /></svg>
            <!-- collapse icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14,14H19V16H16V19H14V14M5,14H10V19H8V16H5V14M8,5H10V10H5V8H8V5M19,8V10H14V5H16V8H19Z" /></svg>        
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
                                <!-- <span class="mdi mdi-exit-run me-1"></span> -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" style="width: 18px;">                                    
                                    <path d="M17 7L15.59 8.41L18.17 11H8V13H18.17L15.59 15.58L17 17L22 12M4 5H12V3H4C2.9 3 2 3.9 2 5V19C2 20.1 2.9 21 4 21H12V19H4V5Z" /></svg>
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
