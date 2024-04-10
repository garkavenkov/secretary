import crud from '../core/crud';

export const HouseholdTypes = {
    namespaced: true,
    state: {
        householdTypes: [],
        householdType: {},
        url: '/api/v1/household-types',
        // url: '',
        entities: 'householdTypes',
        entity: 'householdType'

    },
    getters: {
        householdTypes: state => state.householdTypes,
        householdType: state => state.householdType
    },
    mutations: {
        ...crud.mutations
    },
    actions: {
        ...crud.actions
    }
}


