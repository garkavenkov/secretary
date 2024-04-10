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
            // console.log(`url: ${url}`);
            axios.get(state.url)
                .then(res => {
                    commit('setData', {ent:state.entities, data: res.data.data});
                    if (res.data.meta) {
                        commit('setData', {ent: 'pagination', data: res.data.meta});
                    }
                });
        },
        fetchRecord: ({commit, state}, id) =>  {
            axios.get(`${state.baseUrl}/${id}`)
                .then(res => {
                    commit('setData', {ent:state.entity, data: res.data.data});
                });
        }
    }
}
