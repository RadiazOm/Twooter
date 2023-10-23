import 'bootstrap';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

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
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });

let element

window.addEventListener('load', init);

function init() {
    try {
        let postContainer = document.getElementById('posts')
        postContainer.addEventListener('click', LikeClickHandler)
    } catch (error) {

    }

}

function LikeClickHandler(e) {
    element = e.target;
    if (element.id !== 'like') {
        return;
    }
    getJSONdata(`http://127.0.0.1:8000/like/toggle/${element.dataset.id}`, likeButtonchange)
}

function getJSONdata(apiUrl, successHandler)
{
    fetch(apiUrl)
        .then((response) => {
            if (!response.ok) {
                throw new Error(response.statusText);
            }
            return response.json();
        })
        .then(successHandler)
        .catch(ajaxErrorHandler);
}

function likeButtonchange(state) {
    if (state[0]) {
        element.classList.add('btn-outline-primary')
        element.classList.remove('btn-primary')
        let text = element.innerHTML.split(' ')
        let number = parseFloat(text[1]);
        element.innerHTML = `Likes: ${number + 1}`
    } else {
        element.classList.add('btn-primary')
        element.classList.remove('btn-outline-primary')
        let text = element.innerHTML.split(' ');
        let number = parseFloat(text[1]);
        element.innerHTML = `Likes: ${number - 1}`
    }
}

function ajaxErrorHandler(e) {
    console.log('Oops something went wrong: ' + e);
}
