import crud from '../core/crud';

export const Regions = {
    namespaced: true,
    state: {
        regions: [],
        region: {},        
        url: '/api/v1/regions',
        entities: 'regions',
        entity: 'region',

    },
    getters: {
        regions: state => state.regions,
        region: state => state.region
    },
    mutations: {
        ...crud.mutations,
    },
    actions: {
        ...crud.actions
    }
}


