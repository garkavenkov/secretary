export default {
    mutations: {
        setFilter(state, payload) {
            for (const [key] of Object.entries(state.filter)) {
                state.filter[key] = payload[key];
            }
        }
    },
    actions: {
        applyFilter: ({commit, dispatch}, payload) => {
            commit('setFilter', payload );
            commit('makeQueryString');
            dispatch('fetchRecords' );
        }
    }
}
