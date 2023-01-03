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
        setData: (state, payload) => {
            state[payload.ent] = payload.data;
        }
    },
    actions: {
        fetchRegions: ({commit}) =>  {
            axios.get('/api/v1/regions')
                .then(res => {
                    commit('setData', {ent:'regions', data: res.data.data});
                });
        },
        fetchRegion: ({commit}, id) =>  {
            axios.get(`/api/v1/regions/${id}`)
                .then(res => {
                    commit('setData', {ent:'region', data: res.data.data});
                });
        }
    }
}


