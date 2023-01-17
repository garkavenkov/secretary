@extends('layouts.app')

@section('content')

    <sidebar-menu></sidebar-menu>

    <div class="content__wrapper">
        @include('layouts.header')
        <div class="main-content">
            <router-view></router-view>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Toggle sidebar panel
            let sidebarToggler = document.querySelector('#sidebar-toggler');
            let sidebar = document.querySelector('.sidebar-menu');
            // let header = document.querySelector('.main-header');
            let content = document.querySelector('.content__wrapper');

            sidebarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('shrinked');
                // header.classList.toggle('expand');
                content.classList.toggle('expand');
            });

            // ----------------------------------------------------------------------------------------
            // Toggle Items with submenu.
            let submenuList = document.querySelectorAll('ul.sidebar-menu__wrapper li.has-submenu');
            function submenuListClickHandler() {
                if (!sidebar.classList.contains('shrinked')) {
                    var currentExpandedItem = document.querySelector('ul.sidebar-menu__wrapper li.has-submenu.expanded');
                    if (currentExpandedItem && currentExpandedItem != this) {
                        currentExpandedItem.classList.toggle('expanded');
                    }
                    this.classList.toggle('expanded');
                }
            }
            submenuList.forEach((item) => item.addEventListener('click', submenuListClickHandler));
            // ----------------------------------------------------------------------------
            // Toggle items with submenu, when clicked on item without submenu
            let list = document.querySelectorAll('ul.sidebar-menu__wrapper li:not(.has-submenu)');
            function listClickHandler() {
                submenuList.forEach((item) => item.classList.remove('expanded'));
            }
            list.forEach((item) => item.addEventListener('click', listClickHandler));
            // ------------------------------------------------------------------------------


            // ------------------------------------------------------------------------------
            // Fullscreen toggle
            let scrnToggler = document.querySelector('#fullscreen-toggler');
            let scrn = document.documentElement;
            scrnToggler.addEventListener('click', function(event) {
                if (scrnToggler.dataset.screen == 'collapse') {
                    if (scrn.requestFullscreen) {
                        scrn.requestFullscreen();
                        scrnToggler.dataset.screen = 'expand'
                        scrnToggler.firstChild.classList.remove('mdi-fullscreen');
                        scrnToggler.firstChild.classList.add('mdi-fullscreen-exit');
                        scrnToggler.setAttribute('title', 'Відновити розмір');
                        // Shrink sidebar menu
                        if (event.ctrlKey) {
                            sidebar.classList.add('shrinked');
                            content.classList.add('expand');
                        }
                    }
                } else  if (scrnToggler.dataset.screen == 'expand') {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                    scrnToggler.dataset.screen = 'collapse';
                    scrnToggler.firstChild.classList.add('mdi-fullscreen');
                    scrnToggler.firstChild.classList.remove('mdi-fullscreen-exit');
                    scrnToggler.setAttribute('title', 'Розгорнути на повний екран');
                }
            })
        });

    </script>
@endpush
