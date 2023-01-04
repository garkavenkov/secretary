import {createRouter, createWebHashHistory } from 'vue-router';
// import store from '../store';
import Dashboard            from "../modules/Dashboard/Main.vue";
import Regions              from "../modules/Regions/Main.vue";
import RegionsShow          from "../modules/Regions/Show.vue";
import Districts            from "../modules/Districts/Main.vue";
import DistrictsShow        from "../modules/Districts/Show.vue";
import Communities          from "../modules/Communities/Main.vue";
import CommunitiesShow      from "../modules/Communities/Show.vue";
import Relationships        from "../modules/FamilyRelationships/Main.vue";
import WorkPlaces           from "../modules/WorkPlaces/Main.vue";
import HouseholdTypes       from "../modules/HouseholdTypes/Main.vue";
import HouseholdCards       from "../modules/HouseholdCards/Main.vue";
import HouseholdCardsShow   from "../modules/HouseholdCards/Show.vue";
import Settlements          from "../modules/Settlements/Main.vue";
import SettlementsShow      from "../modules/Settlements/Show.vue";
import SettlementTypes      from "../modules/SettlementTypes/Main.vue";
import Councils             from "../modules/Councils/Main.vue";
import CouncilsShow         from "../modules/Councils/Show.vue";

const routes = [
    { path: '/',                        component: Dashboard, meta: {icon: '<i class="bi bi-laptop"></i>'} },
    { path: '/regions',                 component: Regions, meta: {name: 'Регіони'} },
    { path: '/regions/:id',             component: RegionsShow, name: 'RegionsShow', props: true, meta: {name: 'Інформація'} },
    { path: '/districts',               component: Districts, meta: {name: 'Райони'} },
    { path: '/districts/:id',           component: DistrictsShow, name: 'DistrictsShow', props: true, meta: {name: 'Інформація'} },
    { path: '/communities',             component: Communities, meta: {name: 'Громади'} },
    { path: '/communities/:id',         component: CommunitiesShow, name: 'CommunitiesShow', props: true, meta: {name: 'Інформація'} },
    { path: '/family-relationships',    component: Relationships, meta: {name: 'Родинні стосунки'} },
    { path: '/work-places',             component: WorkPlaces, meta: {name: 'Місця роботи'} },
    { path: '/household-types',         component: HouseholdTypes, meta: {name: 'Типи погосподарського обліку'} },
    { path: '/household-cards',         component: HouseholdCards, name: 'HouseholdCards', meta: {name: 'Облікови картки'}},
    { path: '/household-cards/:id',     component: HouseholdCardsShow, name:'HouseholdCardsShow', props: true,  meta: {name: 'Інформація'}},
    { path: '/settlements',             component: Settlements, meta: {name: 'Населенні пункти'}},
    { path: '/settlements/:id',         component: SettlementsShow, name: 'SettlementsShow', props: true, meta: {name: 'Інформація'}},
    { path: '/councils',                component: Councils, meta: {name: 'Міські / сільські ради'}},
    { path: '/councils/:id',            component: CouncilsShow, name: 'CouncilsShow', props: true, meta: {name: 'Інформація'}},
    { path: '/settlement-types',        component: SettlementTypes, meta: {name: 'Типи населеного пункту'}},
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
