export default {
    state: {
        sortedByFields: {}
    },
    getters: {
        sortedByFields: state => state.sortedByFields,
    },
    mutation: {
        setSortedBy(state, payload) {
            state.sortedByFields = payload;
        }
    }
}