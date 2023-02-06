export default [
    {
        path: '/work-places',
        name: 'work.places',
        component: () => import(/* webpackChunkName: "work-places" */'../modules/WorkPlaces/Main.vue'),
        meta: {name: 'Місця роботи'}
    },
]
