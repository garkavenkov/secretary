export default [
    {
        path: '/regions',
        name: 'regions',
        component: () => import(/* webpackChunkName: "regions" */'../modules/Regions/Main.vue'),
        meta: {name: 'Регіони'}
    },
    {
        path: '/regions/:id',
        component: () => import(/* webpackChunkName: "regions" */'../modules/Regions/Show.vue'),
        name: 'regions.show',
        props: true,
        meta: {name: 'Інформація'}
    },
]
