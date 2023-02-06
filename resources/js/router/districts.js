export default [
    {
        path: '/districts',
        name: 'districts',
        component: () => import(/* webpackChunkName: "districts" */'../modules/Districts/Main.vue'),
        meta: {name: 'Райони'}
    },
    {
        path: '/districts/:id',
        name: 'districts.show',
        component: () => import(/* webpackChunkName: "districts" */'../modules/Districts/Show.vue'),
        props: true,
        meta: {name: 'Інформація'}
    },
]
