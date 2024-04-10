import axios from 'axios';
import crud from '../core/crud';

export const SettlementTypes = {
    namespaced: true,
    state: {
        settlementTypes: [],
        settlementType: {},
        url: '/api/v1/settlement-types',
        // url: '',
        entities: 'settlementTypes',
        entity: 'settlementType',

    },
    getters: {
        settlementTypes: state => state.settlementTypes,
        settlementType: state => state.settlementType
    },
    mutations: {
        ...crud.mutations,
    },
    actions: {
        ...crud.actions
    }

}


