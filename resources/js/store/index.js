import { createStore } from 'vuex'

import { Regions }                  from './modules/Regions';
import { Districts }                from './modules/Districts';
import { FamilyRelationshipTypes }  from './modules/FamilyRelationshipTypes';
import { HouseholdTypes }           from './modules/HouseholdTypes';
import { WorkPlaces }               from './modules/WorkPlaces';
import { SettlementTypes }          from './modules/SettlementTypes';
import { Settlements }              from './modules/Settlements';
import { Households }               from './modules/Households';
import { Communities }              from './modules/Communities';
import { Councils }                 from './modules/Councils';
import { CouncilTypes }             from './modules/CouncilTypes';
import { HouseholdMembers }         from './modules/HouseholdMembers';

export default createStore({
    modules: {
        Regions,
        Districts,
        FamilyRelationshipTypes,
        HouseholdTypes,
        WorkPlaces,
        Settlements,
        SettlementTypes,
        Households,
        Communities,
        Councils,
        CouncilTypes,
        HouseholdMembers
    }
});


