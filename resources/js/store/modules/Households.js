import axios from 'axios';
import crud from '../core/crud';

export const Households = {
    namespaced: true,
    state: {
        households: [],
        household: {
            info: {},
            members: [],
            houseYears: [],
            houseInfo: [],
            landYears: [],
            landInfo: [],
            familyInfo: []
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
        filter: state => state.filter,
        info: state => state.household.info,
        members: state => state.household.members,
        household_id: state => state.household.id,
        houseYears: state => state.household.houseYears,
        availableHouseYears: state => state.household.houseYears.map(y => y.year),
        houseInfo: state => state.household.houseInfo,
        landYears: state => state.household.landYears,
        availableLandYears: state => state.household.landYears.map(y => y.year).sort((a, b) => b - a),
        landInfo: state => state.household.landInfo,
        familyInfo: state => state.household.familyInfo,
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
