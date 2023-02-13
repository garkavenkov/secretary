export default [
    {
        path: '/reports-manager',
        name: 'reports.manager',
        component: () => import(/* webpackChunkName: "reports-manager" */'../modules/Reports/Main.vue'),
        meta: {name: 'Менеджер звітів'}
    },
    {
        path: '/reports-manager/:id',
        name: 'reports.manager.show',
        component: () => import(/* webpackChunkName: "reports-manager" */'../modules/Reports/Show.vue'),
        props: true,
        meta: {name: 'Інформація'},
    }
]
