import axios from 'axios';

export default {
    mutations: {
        setData: (state, payload) => {
            state[payload.ent] = payload.data;
        }
    },
    actions: {
        fetchRecords: ({commit, state}) =>  {
            axios.get(state.url)
                .then(res => {
                    commit('setData', {ent:state.entities, data: res.data.data});
                });
        },
        fetchRecord: ({commit, state}, id) =>  {
            axios.get(`${state.url}/${id}`)
                .then(res => {
                    commit('setData', {ent:state.entity, data: res.data.data});
                });
        }
    }
}
