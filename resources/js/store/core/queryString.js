export default {
    state: {
        queryString: ''
    },
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

                if (state.filter.hasOwnProperty('additionalParams') && (Object.keys(state.filter.additionalParams).length > 0)) {                
                    let params = Object.keys(state.filter.additionalParams).filter(p => {                 
                        return state.filter.additionalParams[p];
                    });
                 
                    if (params.length > 0) {
                        conditions.push(`additional_params=${params.join(',')}`);
                    }                    
                }
             
                if (state.filter.hasOwnProperty('age') && state.filter.age.selected) {                    
                    conditions.push('age=' + state.filter.age.values.join(','));                    
                }

                if (state.filter.hasOwnProperty('address') && state.filter.address !== '') {
                    conditions.push('address=' + state.filter.address);
                }

                if (state.filter.hasOwnProperty('status')) { //&& state.filter.status !== 'alive') {
                    conditions.push(`status=${state.filter.status}`);
                }
                
                if (conditions.length > 0) {
                    // state.queryString = `?per_page=${state.perPage}&where=` + conditions.join(';');                 
                    state.url = `${state.baseUrl}?per_page=${state.perPage}&where=` + conditions.join(';');                 
                }  else {
                    // Fiter was reseted;
                    state.filter.isFiltered = false;
                    // state.queryString = `?per_page=${state.perPage}`;
                    state.url =  `${state.baseUrl}?per_page=${state.perPage}`;
                }            

            } else {                
                // state.queryString = `?per_page=${state.perPage}`;
                state.url =  `${state.baseUrl}?per_page=${state.perPage}`;
            }

            if (page) {                
                state.queryString = `&page=${page}`;
            }            
        }
    }
}
