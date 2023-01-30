import crud from '../core/crud';

export const FamilyRelationshipTypes = {
    namespaced: true,
    state: {
        relationships: [],
        relationship: {},
        url: '/api/v1/family-relationship-types',
        entities: 'types',
        entity: 'type'

    },
    getters: {
        types: state => state.types,
        type: state => state.type
    },
    mutations: {
        ...crud.mutations
    },
    actions: {
        ...crud.actions
    }
}


