import axios from 'axios';

export const WorkPlaces = {
    namespaced: true,
    state: {
        places: [],
        place: {}

    },
    getters: {
        places: state => state.places,
        place: state => state.place
    },
    mutations: {
        setPlaces: (state, payload) => {
            state.places = payload;
        }
    },
    actions: {
        fetchData: ({commit}) =>  {
            axios.get('/api/v1/work-places')
                .then(res => {
                    commit('setPlaces', res.data.data);
                });
        }
    }
}


