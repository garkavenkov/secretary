import {createRouter, createWebHashHistory } from 'vue-router';

import store from '../store';

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
import additional_params    from './additional_params';
import reports              from './reports';
import roles                from './roles';
import permissions          from './permissions';
import permission_rights    from './permission_rights';
import users                from './users';
import positions            from './positions';

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
    ...additional_params,
    ...reports,
    ...roles,
    ...permissions,
    ...permission_rights,
    ...users,
    // ...positions
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {

    // if (to.matched[0].name === 'households.show') {
    //     store.dispatch('Households/fetchRecord', to.params.id)
    //         .then(res => {
    //             next();
    //         })
    // } else {

        next();
    // }


});

export default router;
