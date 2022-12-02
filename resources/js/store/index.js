import { createStore } from 'vuex'

import { Regions }                from './modules/Regions';
import { Districts }              from './modules/Districts';
import { FamilyRelationships }    from './modules/FamilyRelationships';
import { HouseholdTypes }         from './modules/HouseholdTypes';

export default createStore({
    modules: {
        Regions,
        Districts,
        FamilyRelationships,
        HouseholdTypes
    }
});


