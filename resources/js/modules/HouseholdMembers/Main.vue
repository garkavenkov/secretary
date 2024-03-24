<template>

    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Члени домогосподарств</span>
                <button class="btn btn-sm btn-outline-primary ms-2" @click="$store.dispatch('HouseholdMembers/fetchRecords')" title="Оновити дані">
                    <span class="mdi mdi-refresh"></span>
                </button>
            </div>
            <div>
                <button :class="['btn btn-sm btn-outline-secondary', filter.isFiltered ? 'active' : '' ]"
                        @click.exact="openFilterForm"
                        @click.ctrl="resetFilter"
                        title="Фільтр членів домогосподарств">
                    <span class="mdi mdi-filter-outline"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    v-if="members.length > 0"
                    :dataTable="members"
                    :perPageItems="perPageItems"
                    :externalPagination="pagination"
                    :dataFields="dataFields"
                    tableHeaderClass="table-dark"
                    tableClass="table-bordered"
                    sortByDefaultField="id"
                    @pageChanged="pageChanged"
                    @perPageChanged="perPageChanged">
                <!-- <template v-slot:header>
                    <tr>
                        <th></th>
                        <th data-sort-field="full_name"
                            data-field-type="string"
                            class="sortable">
                            Призвіще ім'я по батькові
                        </th>
                        <th class="text-center">Дата народження</th>
                        <th>Адреса</th>
                        <th data-sort-field="household_number"
                            data-field-type="string"
                            class="sortable">
                            Домогосподарство
                        </th>
                    </tr>
                </template> -->
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td class="text-center">
                            <router-link :to="{name: 'household.members.show', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{record.full_name}}</td>
                        <td class="text-center">{{record.birthdate_formatted}}</td>
                        <td>{{record.address}}</td>
                        <td class="text-center">
                            <router-link :to="{name: 'households.show.info', params: { id: record.household_id }}" style="text-decoration: none;">
                                {{record.household_number}}
                            </router-link>
                        </td>
                    </tr>
                </template>
            </DataTable>
            <div v-else class="text-muted text-center p-3">
                Немає даних для відображення.
            </div>
        </div>
    </div>

    <MembersFilterForm  @resetFilter="resetFilter"/>

</template>

<script>
import { mapGetters }       from 'vuex';
import { Modal }            from 'bootstrap'

import DataTable            from '../../components/ui/DataTable.vue';
import MembersFilterForm    from './MembersFilterForm.vue';

export default {
    name: 'HouseholdMembersMain',
    data() {
        return {
            perPageItems : [
                10,
                15,
                20
            ],
            dataFields: [
                {
                    name: 'link',
                    caption: ''
                },
                {
                    name: 'full_name',
                    caption: 'Призвіще ім\'я по батькові',
                    class: 'sortable',
                    sortable: true,
                },
                {
                    name: 'birthdate_formatted',
                    caption: 'Дата народження',
                    class: 'text-center',
                },
                {
                    name: 'address',
                    caption: 'Адреса',
                },
                {
                    name: 'household_number',
                    caption: 'Домогосподарство',
                    class: 'sortable',
                    sortable: true,
                },
            ],
        }
    },
    provide() {
        return {
            modalTitle: 'Фільтр членів домогосподарств',
            modalSubmitCaption: 'Застосувати',
        }
    },
    methods: {
        openFilterForm() {
            let filterForm = new Modal(document.getElementById('MembersFilterForm'));
            filterForm.show();
        },
        resetFilter() {
            this.filter.settlement_id = 0;
            this.filter.isFiltered = false;
            this.filter.additionalParams = {};
            this.$store.dispatch('HouseholdMembers/applyFilter', this.filter);
        },
        perPageChanged(value) {
            this.$store.dispatch('HouseholdMembers/changePerPage', value)
        },
        pageChanged(page) {
            this.$store.dispatch('HouseholdMembers/changePage', page)
        },
        searchData(row, searchText) {
            return row['full_name'].includes(searchText) || row['household_number'].includes(searchText);
        }
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['members', 'filter', 'pagination']),
    },
    components: {
        DataTable,
        MembersFilterForm
    }

}

</script>
