export default [
    {
        path: '/users',
        name: 'users',
        component: () => import(/* webpackChunkName: "users" */'../modules/Users/Main.vue'),
        meta: {name: 'Користувачі'}
    },
    {
        path: '/users/:id',
        name: 'users.profile',
        component: () => import(/* webpackChunkName: "users" */'../modules/Users/Show.vue'),
        props: true,
        meta: {name: 'Профіль'}
    },
]
