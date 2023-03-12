export default [
    {
        path: '/permissions',
        name: 'permissions',
        component: () => import(/* webpackChunkName: "permissions" */'../modules/Permissions/Main.vue'),
        meta: {name: 'Дозволи'}
    },
    {
        path: '/permissions/:id',
        name: 'permissions.show',
        component: () => import(/* webpackChunkName: "permissions" */'../modules/Permissions/Show.vue'),
        meta: {name: 'Інформація'},
        props: true
    }
]
