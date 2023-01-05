import axios from 'axios';
import crud from '../core/crud';

export const FamilyRelationships = {
    namespaced: true,
    state: {
        relationships: [],
        relationship: {},
        url: '/api/v1/family-relationships',
        entities: 'relationships',
        entity: 'relationship'

    },
    getters: {
        relationships: state => state.relationships,
        relationship: state => state.relationship
    },
    mutations: {
        ...crud.mutations
    },
    actions: {
        ...crud.actions
    }
}


