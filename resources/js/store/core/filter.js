export default {
    mutations: {
        setFilter(state, payload) {            
            // let params = payload.additionalParams;
            // delete payload.additionalParams;
            // console.log(params, payload) ;
            // return
            for (const [key] of Object.entries(state.filter)) {
                state.filter[key] = payload[key];
            }            
            // for (const [key] of Object.entries(state.additionalParams)) {
            //     state.additionalParams[key]
            // }
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
