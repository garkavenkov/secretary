export default [
    {
        path: '/household-members',
        name: 'household.members',
        component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Main.vue'),
        meta: {name: 'Члени домогосподарств'}
    },
    {
        path: '/household-members/:id',
        component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Show.vue'),
        name:'household.members.show',
        props: true,
        meta: {name: 'Інформація'},

    },
]
