import crud             from '../core/crud';
import pagination       from '../core/pagination';
import filter           from '../core/filter';
import queryString      from '../core/queryString';
import selectRecords    from '../core/selectRecords';
import sort             from '../core/sort';

export const HouseholdMembers = {
    namespaced: true,
    state: {        
        members: [],
        member: {},
        filter: {
            settlement_id: 0,
            sex: 'all',
            additionalParams: {},            
            age: {selected: false, values: [0,0]},
            status: 'alive',
            isFiltered: false,
        },        
        baseUrl: '/api/v1/household-members',
        url: '',
        entities: 'members',
        entity: 'member',
        pagination: {},
        perPage: 10,
        ...selectRecords.state,
        ...sort.state,
    },
    getters: {
        members: state => state.members,
        member: state => state.member,
        memberId: state => state.member.id,
        filter: state => state.filter,
        additionalParams: state => state.additionalParams,
        pagination: state => state.pagination,
        relatives: state => state.member.relatives,
        entities: state => state.entities,
        isFiltered: state => state.filter.isFiltered,
        url: state => state.url,
        ...selectRecords.getters,
        ...sort.getters,
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
        ...filter.mutations,
        ...queryString.mutations,
        ...sort.mutation,
    },
    actions: {
        ...crud.actions,
        ...pagination.actions,
        ...filter.actions,
        ...selectRecords.actions,
        searchData({state}, searchText) {
            console.log(`Vuex HouseholdMembers:searchData whith searched text: ${searchText}`);
            // state.members.filter(row => {
            //     return row['full_name'].includes(searchText) || row['household_number'].includes(searchText);
            // })
        },
    }
}
