import axios from 'axios';

export const CouncilTypes = {
    namespaced: true,
    state: {
        councilTypes: [],
        councilType: {}

    },
    getters: {
        councilTypes: state => state.councilTypes,
        councilType: state => state.councilType
    },
    mutations: {
        setCouncilTypes: (state, payload) => {
            state.councilTypes = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/council-types')
                .then(res => {
                    commit('setCouncilTypes', res.data.data);
                });
        }
    }
}


