export default [
    {
        path: '/households',
        name: 'households',
        component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/Main.vue'),
        meta: {name: 'Облікови картки'}
    },
    {
        path: '/households/:id',
        component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/Show.vue'),
        name:'households.show',
        props: true,
        meta: {name: 'Інформація'},
        redirect: {
            name: 'households.show.info'
        },
        children: [
            {
                path: '',
                component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/Info/HouseholdInfo.vue'),
                name: 'households.show.info',
                meta: {name: 'Основна інформація'},
            },
            {
                path: 'members',
                component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/Members/HouseholdMembers.vue'),
                name: 'households.show.members',
                meta: {name: 'Члени родини'},
                // redirect: {
                //     name: 'households.show.members'
                // },
                // Block for DELETE ?!?!?!?!
                children: [
                    // {
                    //     path: '',
                    //     component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/Members/HouseholdMembers.vue'),
                    //     name: 'households.show.members.main',
                    //     meta: {name: 'Члени родини'},
                    // },
                    {
                        path: ':memberId',
                        component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/Members/HouseholdMemberInfo.vue'),
                        name: 'households.show.members.info',
                        meta: {name: 'Інформація'},
                        props: true
                    },
                ]
                // Block for DELETE ?!?!?!?!
            },
            {
                path: 'houses',
                component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/HouseYears/HouseYears.vue'),
                name: 'households.show.house.years',
                meta: {name: 'Будинок - Квартира'},
            },
            {
                path: 'lands',
                component: () => import(/* webpackChunkName: "household-cards" */'../modules/Households/LandYears/LandYears.vue'),
                name: 'households.show.land.years',
                meta: {name: 'Земля'},
            },
        ],
    },
]
