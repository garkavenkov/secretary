import axios from 'axios';
import crud from '../core/crud';

export const HouseholdMembers = {
    namespaced: true,
    state: {
        members: [],
        member: {
            // info: {},
            // movemets: [],
            // additionalParams: [],
            // landYears: [],
        },
        filter: {
            settlement_id: 0,
            sex: 'all',
            isFiltered: false,
        },
        baseUrl: '/api/v1/household-members',
        url: '',
        entities: 'members',
        entity: 'member',
    },
    getters: {
        members: state => state.members,
        member: state => state.member,
        memberId: state => state.member.id,
        filter: state => state.filter,
        // info: state => Object.assign({}, state.member.info),
        // members: state => state.household.members,
        // household_id: state => state.household.id,
        // houseYears: state => state.household.houseYears,
        // availableHouseYears: state => state.household.houseYears.map(y => y.year),
        // houseInfo: state => state.household.houseInfo,
        // landYears: state => state.member.landYears,
        // availableLandYears: state => state.household.landYears.map(y => y.year).sort((a, b) => b - a),
        // landInfo: state => state.household.landInfo,
        // familyInfo: state => state.household.familyInfo,
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
                if (state.filter.sex !== 'all') {
                    conditions.push(`sex=${state.filter.sex}`);
                    // if (state.filter.sex == 'men') {
                    //     conditions.push('sex="чоловіча"');
                    // } else if (state.filter.sex == 'women') {
                    //     conditions.push('sex="жіноча"');
                    // }
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
