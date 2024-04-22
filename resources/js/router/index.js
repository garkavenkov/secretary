import {createRouter, createWebHashHistory } from 'vue-router';
import Page404 from '../components/Page404.vue';


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
import household_members    from './household_members';

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
    ...household_members,    
    {
        path: "/:pathMatch(.*)*", 
        component: Page404, 
        name: 'Page404'
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});


export default router;
