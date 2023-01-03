import axios from 'axios';

export const Districts = {
    namespaced: true,
    state: {
        districts: [],
        district: {}

    },
    getters: {
        districts: state => state.districts,
        district: state => state.district
    },
    mutations: {
        setData: (state, payload) => {
            state[payload.ent] = payload.data;
        }
    },
    actions: {
        fetchDistricts: ({commit}) =>  {
            axios.get('/api/v1/districts')
                .then(res => {
                    commit('setData', {ent:'districts', data: res.data.data});
                });
        },
        fetchDistrict: ({commit}, id) =>  {
            axios.get(`/api/v1/districts/${id}`)
                .then(res => {
                    commit('setData', {ent:'district', data: res.data.data});
                });
        }
    }
}


