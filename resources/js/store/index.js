import { createStore } from 'vuex'

import { Regions }                from './modules/Regions';
import { Districts }              from './modules/Districts';
import { FamilyRelationships }    from './modules/FamilyRelationships';
import { HouseholdTypes }         from './modules/HouseholdTypes';
import { WorkPlaces }             from './modules/WorkPlaces';
import { Settlements }            from './modules/Settlements';

export default createStore({
    modules: {
        Regions,
        Districts,
        FamilyRelationships,
        HouseholdTypes,
        WorkPlaces,
        Settlements
    }
});


