import crud from '../core/crud';

export const Settlements = {
    namespaced: true,
    state: {
        settlements: [],
        settlement: {},
        url: '/api/v1/settlements',
        // url: '',
        entities: 'settlements',
        entity: 'settlement',

    },
    getters: {
        settlements: state => state.settlements,
        settlement: state => state.settlement
    },
    mutations: {
        ...crud.mutations,
    },
    actions: {
        ...crud.actions
    }
}


