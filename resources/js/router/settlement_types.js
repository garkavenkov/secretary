export default [
    {
        path: '/settlement-types',
        name: 'settlement.types',
        component: () => import(/* webpackChunkName: "settlement-types" */'../modules/SettlementTypes/Main.vue'),
        meta: {name: 'Типи населеного пункту'}
    },
]
