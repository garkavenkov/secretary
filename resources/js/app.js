/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});


import SideBarMenu  from './components/SideBarMenu.vue';
import Breadcrumbs  from './components/ui/Breadcrumbs.vue';
import SearchForm   from './components/ui/SearchForm.vue'
// import Page404      from './components/404.vue';

app.component('sidebar-menu', SideBarMenu);
app.component('breadcrumbs', Breadcrumbs);
app.component('search-form', SearchForm);
// app.component('Page404', Page404);

app.config.unwrapInjectedRef = true;

// console.log(navigator.userAgent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */


import router from './router';
import store from './store';




app.config.globalProperties.$axios = axios;

import Swal from 'sweetalert2';

app.config.globalProperties.$confirmDelete = function(title, msg = '', icon = 'question') {
    return  new Swal({
                title: title,
                icon: icon,
                html: msg,
                showCancelButton: true,
                cancelButtonText: 'Відмінити',
                confirmButtonText: 'Видалити',
                confirmButtonColor: '#d33',
                focusCancel: true,
                // reverseButtons: true,
                customClass: {
                    title: 'swal-dialog-title',
                    actions: 'justify-content-around w-100',
                }
            });
}

app.config.globalProperties.$toast = function(msg, icon = 'success') {
    return  new Swal({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                html:msg,
                icon: icon,
            });
}

app.config.globalProperties.$errorMessage = function(title,error,button = 'ОК') {
    return  new Swal({
                title: title,
                html:error,
                icon: 'error',
                confirmButtonText: button,
                customClass: {
                    title: 'swal-dialog-title',
                    htmlContainer: 'swal-dialog-body'
                }
            });
}



app.use(router);
app.use(store);

app.mount('#app');
