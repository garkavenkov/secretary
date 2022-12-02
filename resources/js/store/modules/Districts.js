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
        setDistricts: (state, payload) => {
            state.districts = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/districts')
                .then(res => {
                    commit('setDistricts', res.data.data);
                });
        }
    }
}


