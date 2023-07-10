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
        redirect: {
            name: 'household.members.show.info'
        },
        children: [
            {
                path: '',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/MainInfo.vue'),
                name: 'household.members.show.info',
                meta: {name: 'Головна інформація'},
            },
            {
                path: 'lands',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/LandYears.vue'),
                name: 'household.members.show.lands',
                meta: {name: 'Земля'},
            },
            {
                path: 'movements',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/Movements.vue'),
                name: 'household.members.show.movements',
                meta: {name: 'Реєстрація / Переміщення'},
            },
            {
                path: 'additional-data',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/AdditionalParams.vue'),
                name: 'household.members.show.additional-data',
                meta: {name: 'Додаткові дані'},
            },
        ],
    },
]
