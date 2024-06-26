import crud from '../core/crud';

export const Councils = {
    namespaced: true,
    state: {
        councils: [],
        council: {},
        url: '/api/v1/councils',
        // url: '',
        entities: 'councils',
        entity: 'council',

    },
    getters: {
        councils: state => state.councils,
        council: state => state.council
    },
    mutations: {
        ...crud.mutations,
    },
    actions: {
        ...crud.actions
    }
}


