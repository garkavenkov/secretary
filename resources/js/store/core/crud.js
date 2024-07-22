import axios from 'axios';

export default {
    mutations: {
        setData: (state, payload) => {
            state[payload.ent] = payload.data;
        }
    },
    actions: {
        fetchRecords: ({commit, state}) =>  {            
            // let url = state.url;
            // console.log(`url: ${url}`);
            // if (state.queryString !== undefined) {
            //     url = `${state.url}${state.queryString}`;                
            // }             
            axios.get(state.url)
                .then(res => {
                    commit('setData', {ent:state.entities, data: res.data.data});
                    if (res.data.meta) {
                        commit('setData', {ent: 'pagination', data: res.data.meta});
                    }
                });
        },
        fetchRecord: ({commit, state}, id) =>  {
            // return new Promise((resolve, reject) => {
            let url = state.baseUrl ? state.baseUrl : state.url;
            axios.get(`${url}/${id}`)
                .then(res => {
                    commit('setData', {ent:state.entity, data: res.data.data});
                })
                .catch(err => {
                    if (err.response.status == 404) {
                        commit('setData', {ent:state.entity, data: {}})
                    }
                });
            // });
        }
    }
}
