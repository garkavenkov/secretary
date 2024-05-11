<template>

    <!-- <breadcrumbs /> -->

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Члени домогосподарств</span>                

                <ButtonRefreshData 
                        @click="$store.dispatch('HouseholdMembers/fetchRecords')" />

                <ButtonSelectRecords 
                        v-if="members.length > 0" 
                        :title="inSelectMode ? 'Вимкнути режим відбору записів' : 'Увімкнути режим відбору записів'" 
                        :btnClass="[inSelectMode ? 'btn-primary' : 'btn-outline-primary' ]"
                        :inSelectMode="inSelectMode"
                        :selectedRecordsCount="selectedRecordsCount"
                        @click="toggleSelectMode" />

                <div class="d-flex gap-2 ms-4" v-if="selectedRecordsCount  > 0">                                                 

                    <ButtonDocumentGenerationForm 
                        @click="openDocumentsForm" />

                    <ButtonExportRecordForm 
                        @click="openExportRecordForm" />
                    
                </div>
            </div>
            <div>
                
                <ButtonFilter 
                    @click.exact="openFilterForm"
                    @click.ctrl="resetFilter"
                    :isFiltered="filter.isFiltered"
                    title="Фільтр членів домогосподарств"/>

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
                    <!-- @searchInput="searchData" -->
                <template v-slot:header>
                    <tr>
                        <th v-if="inSelectMode" 
                            class="align-middle text-center">
                            <input  type="checkbox"
                                    class="form-check-input cursor-pointer"
                                    name="selectAll"
                                    id="selectAll"
                                    :indeterminate="isIndeterminate"
                                    :checked="isAllSelected"
                                    :title="toggleSelectAllTitle"
                                    @change="toggleSelectAll($event)"/>
                        </th>
                        <th v-else></th>
                        <th data-sort-field="full_name"
                            data-field-type="string"
                            class="sortable">
                            Призвіще ім'я по батькові
                        </th>
                        <th class="text-center">Дата народження</th>
                        <th data-sort-field="full_age"
                            data-field-type="number"
                            class="sortable"
                            style="min-width: 70px;">
                            Вік
                        </th> 
                        <th>Повна адреса</th>
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
                            :class="{ 'table-primary': record.selected }">
                            <!-- @click.ctrl="showDocument(record.id)"> -->
                        <td class="text-center" v-if="!inSelectMode" style="line-height: 24px;">
                            <router-link :to="{name: 'household-member', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td v-else class="text-center" style="line-height: 24px;">                            
                                <input  class="form-check-input cursor-pointer"
                                        type="checkbox"
                                        v-model="record.selected"
                                        @click.shift="selectMultipleRecords({e: $event, id: record.id})"/>
                        </td>                        
                        <td>{{record.full_name}}</td>
                        <td class="text-center">{{record.birthdate_formatted}}</td>
                        <td class="text-center">{{record.full_age}}</td>
                        <td>{{record.full_address}}</td>
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
    <DocumentGenerationForm :records="selectedRecords"/>
    <ExportRecordForm :records="selectedRecords" :availableFields="availabaleFields" :model="'App\\Models\\HouseholdMember'"/>
    

</template>

<script>
import { mapGetters, mapActions }   from 'vuex';
import { Modal }                    from 'bootstrap';
import { computed }                 from 'vue';

import ExportDataForm               from '../../mixins/ExportDataForm';

import DataTable                    from '../../components/ui/DataTable.vue';
import ButtonSelectRecords          from '../../components/ui/Buttons/ButtonSelectRecords.vue';
import ButtonExportRecordForm       from '../../components/ui/Buttons/ButtonExportRecordForm.vue';
import ButtonDocumentGenerationForm from '../../components/ui/Buttons/ButtonDocumentGenerationForm.vue';
import ButtonRefreshData            from '../../components/ui/Buttons/ButtonRefreshData.vue';
// import SvgButton                    from '../../components/ui/Buttons/SvgButton.vue';
import ExportRecordForm             from '../../components/ui/ExportRecordForm.vue';
import ButtonFilter                 from '../../components/ui/Buttons/ButtonFilter.vue';

import MembersFilterForm            from './MembersFilterForm.vue';
import DocumentGenerationForm       from './DocumentGenerationForm.vue';


export default {
    name: 'HouseholdMembersMain',    
    data() {
        return {
            perPageItems : [
                10,
                15,
                20
            ],
            modalTitle: '',
            modalSubmitCaption: '',     
            availabaleFields: {
                id: 'ID',
                full_name: 'Призвіще ім\'я по батькові',
                formatted_birthdate: 'Дата народження',
                full_age: 'Вік',
                full_address: 'Повна адреса',
                household_number: 'Домогосподарство',                
            },   
         
        }
    },
    mixins: [ExportDataForm],
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption)
        }
    },
    methods: {
        ...mapActions('HouseholdMembers', ['toggleSelectAll', 'toggleSelectMode', 'selectMultipleRecords']),
        openFilterForm() {
            this.modalTitle = 'Фільтр членів домогосподарств';
            this.modalSubmitCaption = 'Застосувати';            
            let filterForm = new Modal(document.getElementById(`${this.$options.name}FilterForm`));
            filterForm.show();
        },
        resetFilter() {
            this.filter.settlement_id = 0;
            this.filter.isFiltered = false;
            this.filter.age.selected = false;
            this.filter.age.value = [0,100];
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
        openDocumentsForm() {
            this.modalTitle = 'Генерація документів';
            this.modalSubmitCaption = 'Згенерувати';
            let reportWizardForm = new Modal(document.getElementById('DocumentGenerationForm'));
            reportWizardForm.show();
        },        
    },
    computed: {
        ...mapGetters('HouseholdMembers', [
            'members', 
            'filter', 
            'pagination', 
            'entities', 
            'inSelectMode', 
            'isIndeterminate', 
            'selectedRecords',
            'selectedRecordsCount', 
            'isAllSelected',
            'toggleSelectAllTitle'
        ]),   
    },
    components: {
        DataTable,
        MembersFilterForm,
        ButtonSelectRecords,
        ButtonExportRecordForm,
        ButtonDocumentGenerationForm,
        ButtonRefreshData,
        DocumentGenerationForm,
        ExportRecordForm,
        ButtonFilter
        // SvgButton
    }

}

</script>