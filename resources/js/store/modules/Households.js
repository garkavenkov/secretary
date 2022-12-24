import axios from 'axios';

export const Households = {
    namespaced: true,
    state: {
        households: [],
        household: {
            info: {}
        }
    },
    getters: {
        households: state => state.households,
        household: state => state.household,
    },
    mutations: {
        setHouseholds(state, payload) {
            state.households = payload
        },
        setHousehold(state, payload) {
            state.household = payload
        },
    },
    actions: {
        fetchHouseholds({commit}) {
            axios.get('/api/v1/households')
                .then(res => {
                    commit('setHouseholds', res.data.data)
                })
        },
        fetchHousehold({commit}, id) {
            axios.get(`/api/v1/households/${id}`)
                .then(res => {
                    commit('setHousehold', res.data.data)
                })
        }
    }
}
