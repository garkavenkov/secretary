export default [
    {
        path: '/communities',
        name: 'communities',
        component: () => import(/* webpackChunkName: "communitites" */'../modules/Communities/Main.vue'),
        meta: {name: 'Громади'}
    },
    {
        path: '/communities/:id',
        name: 'communities.show',
        component: () => import(/* webpackChunkName: "communitites" */'../modules/Communities/Show.vue'),
        props: true,
        meta: {name: 'Інформація'}
    },
]
