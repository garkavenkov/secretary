import axios from 'axios';

export const Councils = {
    namespaced: true,
    state: {
        councils: [],
        council: {}

    },
    getters: {
        councils: state => state.councils,
        council: state => state.council
    },
    mutations: {
        setCouncils: (state, payload) => {
            state.councils = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/councils')
                .then(res => {
                    commit('setCouncils', res.data.data);
                });
        }
    }
}


