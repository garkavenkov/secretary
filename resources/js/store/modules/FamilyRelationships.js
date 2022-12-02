import axios from 'axios';

export const FamilyRelationships = {
    namespaced: true,
    state: {
        relationships: [],
        relationship: {}

    },
    getters: {
        relationships: state => state.relationships,
        relationship: state => state.relationship
    },
    mutations: {
        setRelationships: (state, payload) => {
            state.relationships = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/family-relationships')
                .then(res => {
                    commit('setRelationships', res.data.data);
                });
        }
    }
}


