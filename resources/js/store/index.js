import { createStore } from 'vuex'

import { Regions }              from './modules/Regions';
import { Districts }            from './modules/Districts';
import { FamilyRelationships }  from './modules/FamilyRelationships';
import { HouseholdTypes }       from './modules/HouseholdTypes';
import { WorkPlaces }           from './modules/WorkPlaces';
import { Settlements }          from './modules/Settlements';
import { Households }           from './modules/Households';
import { Communities }          from './modules/Communities';
import { Councils }             from './modules/Councils';
import { CouncilTypes }         from './modules/CouncilTypes';

export default createStore({
    modules: {
        Regions,
        Districts,
        FamilyRelationships,
        HouseholdTypes,
        WorkPlaces,
        Settlements,
        Households,
        Communities,
        Councils,
        CouncilTypes
    }
});


