import axios from 'axios';
import crud from '../core/crud';

export const Households = {
    namespaced: true,
    state: {
        households: [],
        household: {
            info: {}
        },
        filter: {
            settlement_id: 0,
            household_type_id: 0,
            isFiltered: false,
        },
        baseUrl: '/api/v1/households',
        url: '',
        entities: 'households',
        entity: 'household',
    },
    getters: {
        households: state => state.households,
        household: state => state.household,
        filter: state => state.filter
    },
    mutations: {
        ...crud.mutations,
        setFilter(state, payload) {
            for (const [key] of Object.entries(state.filter)) {
                state.filter[key] = payload[key];
            }
        },
        makeQueryString(state) {
            if (state.filter.isFiltered) {
                let conditions = [];
                if (state.filter.settlement_id > 0) {
                    conditions.push(`settlement_id=${state.filter.settlement_id}`);
                }
                if (state.filter.household_type_id > 0) {
                    conditions.push(`household_type_id=${state.filter.household_type_id}`);
                }
                state.url = state.baseUrl + '?where=' + conditions.join(';');
            } else {
                state.url = state.baseUrl;
            }
        }
    },
    actions: {
        fetchRecords: crud.actions.fetchRecords,
        applyFilter: ({commit, dispatch}, payload) => {
            commit('setFilter', payload );
            commit('makeQueryString');
            dispatch('fetchRecords' );
        },
        fetchRecord: ({commit, state}, id) =>  {
            axios.get(`${state.baseUrl}/${id}`)
                .then(res => {
                    commit('setData', {ent:state.entity, data: res.data.data});
                });
        }
    }
}
