export default {
    actions: {
        changePerPage: ({commit, dispatch}, value) => {
            commit('setData', {ent: 'perPage', data: value});
            commit('makeQueryString');
            dispatch('fetchRecords' );
        },
        changePage: ({commit, dispatch}, url) => {
            commit('setData', {ent: 'url', data: url});
            dispatch('fetchRecords');
        },
    }
}
