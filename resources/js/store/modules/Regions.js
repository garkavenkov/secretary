import axios from 'axios';

export const Regions = {
    namespaced: true,
    state: {
        regions: [],
        region: {}

    },
    getters: {
        regions: state => state.regions,
        region: state => state.region
    },
    mutations: {
        setRegions: (state, payload) => {
            state.regions = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/regions')
                .then(res => {
                    commit('setRegions', res.data.data);
                });
        }
    }
}


