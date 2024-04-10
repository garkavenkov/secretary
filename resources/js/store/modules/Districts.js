import crud from '../core/crud';

export const Districts = {
    namespaced: true,
    state: {
        districts: [],
        district: {},
        url: '/api/v1/districts',
        // url: '',
        entities: 'districts',
        entity: 'district',
    },
    getters: {
        districts: state => state.districts,
        district: state => state.district
    },
    mutations: {
        ...crud.mutations,
    },
    actions: {
        ...crud.actions
    }
}


