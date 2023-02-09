export default [
    {
        path: '/additional-params',
        name: 'additional.params',
        component: () => import(/* webpackChunkName: "additional-params" */'../modules/AdditionalParams/Main.vue'),
        meta: {name: 'Додаткові параметри'}
    }
];
