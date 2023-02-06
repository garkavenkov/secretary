import crud from '../core/crud';

export const Communities = {
    namespaced: true,
    state: {
        communities: [],
        community: {},
        url: '/api/v1/communities',
        entities: 'communities',
        entity: 'community',
    },
    getters: {
        communities: state => state.communities,
        community: state => state.community
    },
    mutations: {
        ...crud.mutations,
    },
    actions: {
        ...crud.actions
    }
}


