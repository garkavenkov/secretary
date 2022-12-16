import axios from 'axios';

export const Settlements = {
    namespaced: true,
    state: {
        settlements: [],
        settlement: {}

    },
    getters: {
        settlements: state => state.settlements,
        settlement: state => state.settlement
    },
    mutations: {
        setSettlements: (state, payload) => {
            state.settlements = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/settlements')
                .then(res => {
                    commit('setSettlements', res.data.data);
                });
        }
    }
}


