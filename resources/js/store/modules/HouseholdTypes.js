import axios from 'axios';

export const HouseholdTypes = {
    namespaced: true,
    state: {
        householdTypes: [],
        householdType: {}

    },
    getters: {
        householdTypes: state => state.householdTypes,
        householdType: state => state.householdType
    },
    mutations: {
        setHouseholdTypes: (state, payload) => {
            state.householdTypes = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/household-types')
                .then(res => {
                    commit('setHouseholdTypes', res.data.data);
                });
        }
    }
}


