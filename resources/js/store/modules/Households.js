import axios from 'axios';
import crud from '../core/crud';

export const Households = {
    namespaced: true,
    state: {
        households: [],
        household: {
            info: {}
        },
        url: '/api/v1/households',
        entities: 'households',
        entity: 'household',
    },
    getters: {
        households: state => state.households,
        household: state => state.household,
    },
    mutations: {
        ...crud.mutations,
    },
    actions: {
        ...crud.actions
    }
}
