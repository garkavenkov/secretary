import axios from 'axios';

export const Communities = {
    namespaced: true,
    state: {
        communities: [],
        community: {}

    },
    getters: {
        communities: state => state.communities,
        community: state => state.community
    },
    mutations: {
        setCommunities: (state, payload) => {
            state.communities = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/communities')
                .then(res => {
                    commit('setCommunities', res.data.data);
                });
        }
    }
}


