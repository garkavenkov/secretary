import crud         from '../core/crud';
import pagination   from '../core/pagination';
import filter       from '../core/filter';
import queryString  from '../core/queryString';

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
            additionalParams: {},
            isFiltered: false,
        },
        url: '/api/v1/households',
        // url: '',
        entities: 'households',
        entity: 'household',
        pagination: {},
        perPage: 10
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
        pagination: state => state.pagination
    },
    mutations: {
        ...crud.mutations,
        ...filter.mutations,
        ...queryString.mutations
    },
    actions: {
        ...crud.actions,
        ...pagination.actions,
        ...filter.actions,
    }
}
