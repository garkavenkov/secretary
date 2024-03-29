export default [
    {
        path: '/household-members',
        name: 'HouseholdMembers',
        component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Main.vue'),
        meta: {name: 'Члени домогосподарств'}
    },
    {
        path: '/household-members/:id',
        component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Show.vue'),
        name:'HouseholdMember',
        props: true,
        meta: {name: 'Інформація'},
        redirect: {
            name: 'HouseholdMember.info'
        },
        children: [
            {
                path: '',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/MainInfo.vue'),
                name: 'HouseholdMember.info',
                meta: {name: 'Головна інформація'},
            },
            {
                path: 'lands',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/LandYears.vue'),
                name: 'HouseholdMember.lands',
                meta: {name: 'Земля'},
            },
            {
                path: 'movements',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/Movements.vue'),
                name: 'HouseholdMember.movements',
                meta: {name: 'Реєстрація / Переміщення'},
            },           
            {
                path: 'additional-data',
                component: () => import(/* webpackChunkName: "household-members" */'../modules/HouseholdMembers/Tabs/AdditionalParams.vue'),
                name: 'HouseholdMember.additional-data',
                meta: {name: 'Додаткові дані'},
            },
        ],
    },
]
