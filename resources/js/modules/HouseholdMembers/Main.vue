<template>

    <!-- <breadcrumbs /> -->

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Члени домогосподарств</span>                

                <ButtonRefreshData 
                        @click="$store.dispatch('HouseholdMembers/fetchRecords')"
                        buttonClass="btn-sm btn-outline-primary p-2" />

                <ButtonSelectRecords 
                        v-if="members.length > 0" 
                        :title="inSelectMode ? 'Вимкнути режим відбору записів' : 'Увімкнути режим відбору записів'" 
                        :buttonClass="['position-relative ms-2 p-2 btn btn-sm', inSelectMode ? 'btn-primary' : 'btn-outline-primary']"
                        :inSelectMode="inSelectMode"
                        :selectedRecordsCount="selectedRecordsCount"
                        @click="toggleSelectMode" />                  

                <div class="d-flex gap-2 ms-4" v-if="selectedRecordsCount  > 0">                                                 

                    <ButtonDocumentGenerationForm 
                            @click="openDocumentsForm"
                            buttonClass="btn-sm btn-outline-primary p-2" />

                    <ButtonExportRecordForm  
                            @click="openExportRecordForm" 
                            buttonClass="btn-sm btn-outline-primary p-2" />
                    
                </div>
            </div>
            <div>
                <ButtonFilter 
                    @click="openFilterForm"                    
                    :buttonClass="['btn-sm btn-outline-secondary p-2', isFiltered ? 'active': '' ]"    
                    title="Фільтр членів домогосподарств" />                

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
                            class="align-middle text-center show-record">
                            <input  type="checkbox"
                                    class="form-check-input cursor-pointer"
                                    name="selectAll"
                                    id="selectAll"
                                    :indeterminate="isIndeterminate"
                                    :checked="isAllSelected"
                                    :title="toggleSelectAllTitle"
                                    @change="toggleSelectAll($event)"/>
                        </th>
                        <th v-else class="show-record"></th>
                        <th data-sort-field="full_name"
                            data-field-type="string"
                            class="sortable">
                            Призвіще ім'я по батькові
                        </th>
                        <th class="text-center">Дата народження</th>
                        <th class="text-center" v-if="showDeathDateField">Дата смерті</th>                        
                        <th data-sort-field="full_age"
                            data-field-type="number"
                            class="sortable"
                            style="min-width: 70px;">
                                Вік
                        </th> 
                        <!--<th>Повна адреса</th>-->
                        <th>Населений пункт</th>
                        <th data-sort-field="address"
                            data-field-type="string"
                            class="sortable">
                                Адреса
                        </th>
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
                            :class="{ 'table-primary': record.selected, 'dead-member': record.death_date !== null}">
                        <td class="text-center" v-if="!inSelectMode" style="line-height: 24px;">
                            <router-link :to="{name: 'household-member', params: { id: record.id }}" title="Перейти до інформації по члену домогосподарства">
                                <SvgIcon type="mdi" :path="pathMdiAccountEye" :size="18"/>
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
                        <td class="text-center" v-if="showDeathDateField">{{ record.death_date_formatted }}</td>                        
                        <td class="text-center">{{record.full_age}}</td>
                        <!--<td>{{record.full_address}}</td>-->
                        <td>{{ record.settlement }}</td>
                        <td>{{ record.address }}</td>
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
import SvgIcon                      from '@jamescoyle/vue-icon';
import { mdiAccountEyeOutline }     from '@mdi/js';

import ExportDataForm               from '../../mixins/ExportDataForm';

import ButtonSelectRecords          from '../../components/ui/Buttons/ButtonSelectRecords.vue';
import ButtonExportRecordForm       from '../../components/ui/Buttons/ButtonExportRecordForm.vue';
import ButtonDocumentGenerationForm from '../../components/ui/Buttons/ButtonDocumentGenerationForm.vue';
import ButtonRefreshData            from '../../components/ui/Buttons/ButtonRefreshData.vue';
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
                sex: 'Стать',
                short_address: 'Адреса',
                settlement: 'Населений пункт',
                household_number: 'Номер домогосподарства',                
            },   
           
            pathMdiAccountEye: mdiAccountEyeOutline            
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
            this.filter.isFiltered = true;
            this.filter.age.selected = false;
            this.filter.age.value = [0,100];
            this.filter.additionalParams = {};
            this.filter.status = 'alive';
            this.filter.sex = 'all';
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
            'isFiltered',
            'isIndeterminate', 
            'selectedRecords',
            'selectedRecordsCount', 
            'isAllSelected',
            'toggleSelectAllTitle',
            'url'
        ]),
        showDeathDateField() {
            return (this.url.includes('status=dead') || this.url.includes('status=all')) ? true : false;
            
        }
    },
    components: {
        MembersFilterForm,
        ButtonSelectRecords,
        ButtonExportRecordForm,
        ButtonDocumentGenerationForm,
        ButtonRefreshData,
        DocumentGenerationForm,
        ExportRecordForm,
        ButtonFilter,
        SvgIcon        
    }

}

</script>

<style lang="scss" scoped>

tr.dead-member {
    background-color: #ced4da;
}

</style>