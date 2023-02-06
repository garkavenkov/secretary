export default [
    {
        path: '/settlements',
        name: 'settlements',
        component: () => import(/* webpackChunkName: "settlements" */'../modules/Settlements/Main.vue'),
        meta: {name: 'Населенні пункти'}
    },
    {
        path: '/settlements/:id',
        name: 'settlements.show',
        component: () => import(/* webpackChunkName: "settlements" */'../modules/Settlements/Show.vue'),
        props: true,
        meta: {name: 'Інформація'}
    },
]
