<template>

    <!-- <breadcrumbs /> -->

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Члени домогосподарств</span>
                <button class="btn btn-sm btn-outline-primary ms-2" @click="$store.dispatch('HouseholdMembers/fetchRecords')" title="Оновити дані">
                    <span class="mdi mdi-refresh"></span>
                </button>
                <ButtonSelectRecords 
                        v-if="members.length > 0" 
                        title="Множиний відбір" 
                        :btnClass="[inSelectMode ? 'btn-primary' : 'btn-outline-primary' ]"
                        :selectedRecordsCount="selectedRecordsCount"
                        @toggleSelectMode="toggleSelectMode" />     
                <button type="button"
                        class="btn btn-sm btn-outline-info ms-3"
                        title="Додаткові параметри"
                        @click="() => {}"
                        v-if="selectedRecordsCount  > 0">
                    <span class="mdi mdi-tag-multiple"></span>
                </button>
                <button type="button"
                        class="btn btn-sm btn-outline-info ms-2"
                        title="Формування звіту"
                        @click="() => {}"
                        v-if="selectedRecordsCount  > 0">                    
                    <span class="mdi mdi-file-document-arrow-right-outline"></span>
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
                    tableHeaderClass="table-dark"
                    tableClass="table-bordered"
                    sortByDefaultField="id"
                    @pageChanged="pageChanged"
                    @perPageChanged="perPageChanged">
                <template v-slot:header>
                    <tr>
                        <th v-if="inSelectMode" 
                            class="align-middle text-center">
                            <input  type="checkbox"
                                    class="form-check-input cursor-pointer"
                                    name="selectAll"
                                    id="selectAll"
                                    :checked="isAllSelected"
                                    @change="toggleSelectAll($event)"/>
                        </th>
                        <th v-else></th>
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
                </template>

                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id"
                            :class="{ 'table-primary': record.selected }"
                            @click.ctrl="showDocument(record.id)">
                        <td class="text-center" v-if="!inSelectMode" style="line-height: 24px;">
                            <router-link :to="{name: 'household-member', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td v-else class="text-center" style="line-height: 24px;">                            
                                <input  class="form-check-input cursor-pointer"
                                        type="checkbox"
                                        v-model="record.selected"/>                            
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

import SelectRecords        from '../../mixins/SelectRecords';

import DataTable            from '../../components/ui/DataTable.vue';
import MembersFilterForm    from './MembersFilterForm.vue';
import ButtonSelectRecords  from '../../components/ui/ButtonSelectRecords.vue';

export default {
    name: 'HouseholdMembersMain',
    mixins: [SelectRecords],
    data() {
        return {
            perPageItems : [
                10,
                15,
                20
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
            // let filterForm = new Modal(document.getElementById('MembersFilterForm'));
            let filterForm = new Modal(document.getElementById(`${this.$options.name}FilterForm`));
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
        },
        showDocument(id) {
            this.$router.push({name: 'household-member', params: { id: id }});
        },       
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['members', 'filter', 'pagination', 'entities']),        
    },
    components: {
        DataTable,
        MembersFilterForm,
        ButtonSelectRecords
    }

}

</script>