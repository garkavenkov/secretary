import HouseholdMain        from '../modules/Households/Main.vue'
import HouseholdShow        from '../modules/Households/Show.vue'
import HouseholdInfo        from '../modules/Households/Info/HouseholdInfo.vue'
import HouseholdHouseYear   from '../modules/Households/HouseYears/HouseYears.vue'
import HouseholdLandYear    from '../modules/Households/LandYears/LandYears.vue'
import HouseholdMembers     from '../modules/Households/Members/HouseholdMembers.vue'

export default [
    {
        path: '/households',
        name: 'households',
        // component: () => import(/* webpackChunkName: 'household-cards' */'../modules/Households/Main.vue'),
        // component: () => import('../modules/Households/Main.vue'),
        component: HouseholdMain,
        meta: {name: 'Облікови картки'}
    },
    {
        path: '/households/:id',
        // component: () => import(/* webpackChunkName: 'household-cards' */'../modules/Households/Show.vue'),
        // component: () => import('../modules/Households/Show.vue'),
        component: HouseholdShow,
        name:'households.show',
        props: true,
        meta: {name: 'Інформація'},
        redirect: {
            name: 'households.show.info'
        },
        children: [
            {
                path: '',
                // component: () => import(/* webpackChunkName: 'household-cards' */'../modules/Households/Info/HouseholdInfo.vue'),
                // component: () => import('../modules/Households/Info/HouseholdInfo.vue'),
                component: HouseholdInfo,
                name: 'households.show.info',
                meta: {name: 'Основна інформація'},
            },
            {
                path: 'members',
                // component: () => import(/* webpackChunkName: 'household-cards' */'../modules/Households/Members/HouseholdMembers.vue'),
                // component: () => import('../modules/Households/Members/HouseholdMembers.vue'),
                component: HouseholdMembers,
                name: 'households.show.members',
                meta: {name: 'Члени родини'},            },
            {
                path: 'houses',
                // component: () => import(/* webpackChunkName: 'household-cards' */'../modules/Households/HouseYears/HouseYears.vue'),
                // component: () => import('../modules/Households/HouseYears/HouseYears.vue'),
                component: HouseholdHouseYear,
                name: 'households.show.house.years',
                meta: {name: 'Будинок - Квартира'},
            },
            {
                path: 'lands',
                // component: () => import(/* webpackChunkName: 'household-cards' */'../modules/Households/LandYears/LandYears.vue'),
                // component: () => import('../modules/Households/LandYears/LandYears.vue'),
                component: HouseholdLandYear,
                name: 'households.show.land.years',
                meta: {name: 'Земля'},
            },
        ],
    },
]
