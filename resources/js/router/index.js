import {createRouter, createWebHashHistory } from 'vue-router';

import dashboard            from './dashboard';
import settlement_types     from './settlement_types';
import households           from './households';
import regions              from './regions';
import districts            from './districts';
import communities          from './communities';
import settlements          from './settlements';
import councils             from './councils';
import household_types      from './household_types';
import relationship_types   from './relationship_types';
import work_places          from './work_places';
import analitics            from './analitics';

const routes = [
    ...dashboard,
    ...settlement_types,
    ...household_types,
    ...relationship_types,
    ...work_places,
    ...regions,
    ...districts,
    ...communities,
    ...settlements,
    ...councils,
    ...households,
    ...analitics,
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
