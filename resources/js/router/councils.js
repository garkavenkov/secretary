export default [
    {
        path: '/councils',
        name: 'councils',
        component: () => import(/* webpackChunkName: "councils" */'../modules/Councils/Main.vue'),
        meta: {name: 'Міські / сільські ради'}},
    {
        path: '/councils/:id',
        name: 'councils.show',
        component: () => import(/* webpackChunkName: "councils" */'../modules/Councils/Show.vue'),
        props: true, meta: {name: 'Інформація'}
    },
]
