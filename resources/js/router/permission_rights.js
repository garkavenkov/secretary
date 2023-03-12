export default [
    {
        path: '/permission-rights',
        name: 'permission.rights',
        component: () => import(/* webpackChunkName: "permission-rights" */'../modules/PermissionRights/Main.vue'),
        meta: {name: 'Керування правами дозволу'},
    }
]
