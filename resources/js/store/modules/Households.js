import crud             from '../core/crud';
import pagination       from '../core/pagination';
import filter           from '../core/filter';
import queryString      from '../core/queryString';
import selectRecords    from '../core/selectRecords';
import sort             from '../core/sort';

export const Households = {
    namespaced: true,
    state: {
        households: [],
        household: {
            // info: {},
            // members: [],
            // houseInfo: [],
            // landInfo: [],
            // familyInfo: []
        },
        houseYears: [],
        landYears: [],
        houseInfo: [],
        filter: {
            settlement_id: 0,
            household_type_id: 0,
            additionalParams: {},
            address: '',
            isFiltered: false,
        },
        baseUrl: '/api/v1/households',
        url: '',
        entities: 'households',
        entity: 'household',
        pagination: {},
        perPage: 10,
        ...selectRecords.state,
        ...sort.state
    },
    getters: {
        households: state => state.households,
        household: state => state.household,
        filter: state => state.filter,
        // info: state => state.household.info,
        members: state => state.household.members,
        household_id: state => state.household.id,
        // houseYears: state => state.household.houseYears,
        houseYears: state => state.houseYears,
        availableHouseYears: state => state.houseYears.map(y => y.year),
        // houseInfo: state => state.household.houseInfo,
        houseInfo: state => state.houseInfo,
        // landYears: state => state.household.landYears,
        landYears: state => state.landYears,
        // availableLandYears: state => state.household.landYears.map(y => y.year).sort((a, b) => b - a),
        availableLandYears: state => state.landYears.map(y => y.year).sort((a, b) => b - a),
        landInfo: state => state.household.landInfo,
        familyInfo: state => state.household.familyInfo,
        pagination: state => state.pagination,
        entities: state => state.entities,
        isFiltered: state => state.filter.isFiltered,
        ...selectRecords.getters,
        ...sort.getters,
    },
    mutations: {
        ...crud.mutations,
        ...filter.mutations,
        ...queryString.mutations,
        ...sort.mutation
    },
    actions: {
        ...crud.actions,
        ...pagination.actions,
        ...filter.actions,
        ...selectRecords.actions,
    }
}
