export default {
    mutations: {
        makeQueryString(state, page) {
            if (state.filter.isFiltered) {
                let conditions = [];
                if (state.filter.settlement_id > 0) {
                    conditions.push(`settlement_id=${state.filter.settlement_id}`);
                }
                if (state.filter.household_type_id > 0) {
                    conditions.push(`household_type_id=${state.filter.household_type_id}`);
                }
                if (state.filter.sex && ( state.filter.sex !== 'all')) {
                    conditions.push(`sex=${state.filter.sex}`);
                }
                if (conditions.length > 0) {
                    state.url = state.baseUrl + `?per_page=${state.perPage}&where=` + conditions.join(';');
                } else {
                    state.url = state.baseUrl + `?per_page=${state.perPage}`;
                }
            } else {
                state.url = state.baseUrl + `?per_page=${state.perPage}`;
            }
            if (page) {
                state.url = state.url + `&page=${page}`;
            }
        }
    }
}
