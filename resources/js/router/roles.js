export default [
    {
        path: '/roles',
        name: 'roles',
        component: () => import(/* webpackChunkName: "roles" */'../modules/Roles/Main.vue'),
        meta: {name: 'Ролі'}
    },
    {
        path: '/roles/:id',
        name: 'roles.show',
        component: () => import(/* webpackChunkName: "roles" */'../modules/Roles/Show.vue'),
        meta: {name: 'Інформація'},
        props: true
    },
]
