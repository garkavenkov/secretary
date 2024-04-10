import axios from 'axios';
import crud from '../core/crud';

export const WorkPlaces = {
    namespaced: true,
    state: {
        places: [],
        place: {},
        url: '/api/v1/work-places',
        // url: '',
        entities: 'places',
        entity: 'place'

    },
    getters: {
        places: state => state.places,
        place: state => state.place
    },
    mutations: {
        ...crud.mutations
    },
    actions: {
        ...crud.actions
    }
}


