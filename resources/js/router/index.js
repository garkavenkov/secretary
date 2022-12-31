import {createRouter, createWebHashHistory } from 'vue-router';
// import store from '../store';
import Dashboard            from "../modules/Dashboard/Main.vue";
import Regions              from "../modules/Regions/Main.vue";
import Districts            from "../modules/Districts/Main.vue";
import Communities          from "../modules/Communities/Main.vue";
import Relationships        from "../modules/FamilyRelationships/Main.vue";
import WorkPlaces           from "../modules/WorkPlaces/Main.vue";
import HouseholdTypes       from "../modules/HouseholdTypes/Main.vue";
import HouseholdCards       from "../modules/HouseholdCards/Main.vue";
import HouseholdCardsShow   from "../modules/HouseholdCards/Show.vue";
import Settlements          from "../modules/Settlements/Main.vue";

const routes = [
    { path: '/',                        component: Dashboard, meta: {icon: '<i class="bi bi-laptop"></i>'} },
    { path: '/regions',                 component: Regions, meta: {name: 'Регіони'} },
    { path: '/districts',               component: Districts, meta: {name: 'Райони'} },
    { path: '/communities',             component: Communities, meta: {name: 'Громади'} },
    { path: '/family-relationships',    component: Relationships, meta: {name: 'Родинні стосунки'} },
    { path: '/work-places',             component: WorkPlaces, meta: {name: 'Місця роботи'} },
    { path: '/household-types',         component: HouseholdTypes, meta: {name: 'Типи погосподарського обліку'} },
    { path: '/household-cards',         component: HouseholdCards, name: 'HouseholdCards', meta: {name: 'Облікови картки'}},
    { path: '/household-cards/:id',     component: HouseholdCardsShow, name:'HouseholdCardsShow', props: true,  meta: {name: 'Інформація'}},
    { path: '/settlements',             component: Settlements, meta: {name: 'Населенні пункти'}}
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

// router.beforeEach((to, from, next) => {
//     if (to.name === 'HouseholdCardsShow') {
//         store.dispatch('Households/fetchHousehold', to.params.id)
//             .then(res => {
//                 next();
//             })
//     }

//     next();

// });

export default router;
