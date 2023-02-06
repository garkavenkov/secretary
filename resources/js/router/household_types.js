export default [
    {
        path: '/household-types',
        name: 'household.types',
        component: () => import(/* webpackChunkName: "household-types" */'../modules/HouseholdTypes/Main.vue'),
        meta: {name: 'Типи погосподарського обліку'}
    },
]
