// import _ from 'lodash';
// window._ = _;

import 'bootstrap';



/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

// import Swal from 'sweetalert2';
// window.Swal = Swal;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// import router from './router';

import Swal from 'sweetalert2';
window.axios.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        if ([401,419].includes(error.response.status)) {
            Swal.fire({
                    title: 'Сеанс закінчився',
                    html: 'Необхідно авторизуватися в системі.<br>Бажаєте, щоб вас переспрямували на сторінку авторизації?',
                    type: "warning",
                    // showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Авторизація",
                    closeOnConfirm: true
                })
                .then(res => {
                    if (res.isConfirmed)  window.location = '/login';
                })
        }
        if (error.response.status == 403) {
            Swal.fire({
                html:error.response.data.message,
                icon:'error',
            });
        }
        // if (error.response.status == 404) {
        //     Swal.fire({
        //         html:error.response.data.message,
        //         icon:'error',
        //     });
        // }
        // if (error.response.status == 404) {
        //     router.push({name: 'Page404'});
        //     return;
        // }
        if (error.response.status == 500) {
            // console.log(error);
            let errorMsg = ''
            if (error.response.request.responseType === 'arraybuffer' && error.response.data.toString() === '[object ArrayBuffer]' ) {
                errorMsg = JSON.parse(Buffer.from(error.response.data).toString('utf8')).message;
                // console.log(errorMsg);
            } else {
                errorMsg = error.response.data.message;
            }

            Swal.fire({
                html: errorMsg,
                icon: 'error',
            });
        }
        return Promise.reject(error);
    }
);

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.MIX_PUSHER_APP_KEY,
//     wsHost: import.meta.env.MIX_PUSHER_HOST ?? `ws-${import.meta.env.MIX_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.MIX_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.MIX_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.MIX_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
