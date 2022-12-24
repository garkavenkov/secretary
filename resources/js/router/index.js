import {createRouter, createWebHashHistory } from 'vue-router';
// import store from '../store';

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
    { path: '/regions',                 component: Regions },
    { path: '/districts',               component: Districts },
    { path: '/communities',             component: Communities },
    { path: '/family-relationships',    component: Relationships },
    { path: '/work-places',             component: WorkPlaces },
    { path: '/household-types',         component: HouseholdTypes },
    { path: '/household-cards',         component: HouseholdCards, name: 'HouseholdCards'},
    { path: '/household-cards/:id',     component: HouseholdCardsShow, name:'HouseholdCardsShow', props: true},
    { path: '/settlements',             component: Settlements}
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
