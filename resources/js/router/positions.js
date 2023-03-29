export default [
    {
        path: '/positions',
        name: 'positions',
        component: () => import(/* webpackChunkName: "positions" */'../modules/Positions/Main.vue'),
        meta: {name: 'Посади'}},
    {
        path: '/positions/:id',
        name: 'positions.show',
        component: () => import(/* webpackChunkName: "positions" */'../modules/Positions/Show.vue'),
        meta: {name: 'Інформація'}
    },
]
