export default [
    {
        path: '/additional-params',
        name: 'additional.params',
        component: () => import(/* webpackChunkName: "additional-params" */'../modules/AdditionalParams/Main.vue'),
    },
    {
        path: '/additional-params/:id',
        name: 'additional.params.show',
        component: () => import(/* webpackChunkName: "additional-params" */'../modules/AdditionalParams/Show.vue'),
        props: true,
    }
];
