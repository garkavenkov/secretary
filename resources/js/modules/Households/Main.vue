<template>
 
    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Облікові картки</span>

                <ButtonAdd @click="addCard" title="Додати картку домогосподарства" class="btn-sm btn-primary p-2"/>

                <ButtonRefreshData 
                        @click="$store.dispatch('Households/fetchRecords')"
                        buttonClass="btn-outline-primary p-2 ms-2" />

                <ButtonSelectRecords 
                        v-if="households.length > 0" 
                        :title="inSelectMode ? 'Вимкнути режим відбору записів' : 'Увімкнути режим відбору записів'" 
                        :buttonClass="['position-relative ms-2 p-2', inSelectMode ? 'btn-primary' : 'btn-outline-primary']"
                        :inSelectMode="inSelectMode"
                        :selectedRecordsCount="selectedRecordsCount"
                        @click="toggleSelectMode" />     

                <div class="d-flex gap-2 ms-4" v-if="selectedRecordsCount  > 0">
                    <ButtonExportRecordForm  @click="openExportRecordForm" buttonClass="btn-outline-primary p-2"/>
                </div>

            </div>
                    
            <div>

                <ButtonFilter 
                    :buttonClass="['btn-outline-secondary p-2', isFiltered ? 'active': '' ]"    
                    @click="openFilterForm"                    
                    title="Фільтр облікових карток" />
                    
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    v-if="households.length > 0"
                    :dataTable="households"
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
                            class="show-record">
                            <input  type="checkbox"
                                    class="form-check-input cursor-pointer"
                                    name="selectAll"
                                    id="selectAll"
                                    :indeterminate="isIndeterminate"
                                    :checked="isAllSelected"
                                    @change="toggleSelectAll($event)"/>
                        </th>
                        <th v-else class="show-record"></th>                        
                        <th data-sort-field="number" data-field-type="string" class="sortable">Номер</th>
                        <th>Населений пункт</th>
                        <th data-sort-field="address" data-field-type="string" class="sortable">Місцезнаходження / адреса</th>
                        <th>Голова домогосподарства</th>
                        <th data-sort-field="household_members_count" data-field-type="number" class="sortable">Мешкає</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id"
                            :class="{ 'table-primary': record.selected }">
                        <td class="text-center show-record" v-if="!inSelectMode">

                            <DictionaryShowRecordLink 
                                    routeName="households.show" 
                                    :routeParamId="record.id" 
                                    :mdiIconPath="pathRouterLinkIcon" 
                                    title="Перейти до інформації по домогосподарству" />
                                            
                        </td>
                        <td v-else class="text-center show-record">
                            <input  class="form-check-input cursor-pointer"
                                    type="checkbox"
                                    v-model="record.selected"/>
                        
                        </td>       
                        <td class="text-center">{{record.number}}</td>
                        <td>{{record.settlement}}</td>
                        <td>{{record.short_address}}</td>
                        <td>{{record.household_head}}</td>
                        <td class="text-center">{{record.household_members_count}}</td>
                    </tr>
                </template>
            </DataTable>
            <div v-else class="text-muted text-center p-3">
                Немає даних для відображення.
            </div>
        </div>
    </div>

    <HouseholdForm
            :formData="formData"
            :disabledFields="disabledFields"
            @refreshData="$store.dispatch('Households/fetchRecords')" />


    <HouseholdFilterForm
            @resetFilter="resetFilter"/>

    <ExportRecordForm 
            :records="selectedRecords" 
            :availableFields="availabaleFields" 
            :model="'App\\Models\\Household'" />
    
            
</template>

<script>

import { mapGetters, mapActions }   from 'vuex';
import { Modal }                    from 'bootstrap'
import { computed }                 from 'vue';

import { mdiFolderHomeOutline }     from '@mdi/js';

import ExportDataForm               from '../../mixins/ExportDataForm';

import HouseholdForm                from './HouseholdForm.vue';
import HouseholdFilterForm          from './HouseholdFilterForm.vue';

import DataTable                    from '../../components/ui/DataTable.vue';
import ExportRecordForm             from '../../components/ui/ExportRecordForm.vue';
import ButtonSelectRecords          from '../../components/ui/Buttons/ButtonSelectRecords.vue';
import ButtonExportRecordForm       from '../../components/ui/Buttons/ButtonExportRecordForm.vue';
import ButtonRefreshData            from '../../components/ui/Buttons/ButtonRefreshData.vue';
import ButtonFilter                 from '../../components/ui/Buttons/ButtonFilter.vue';
import DictionaryShowRecordLink     from '../../components/ui/DictionaryShowRecordLink.vue';

export default {
    name: 'HouseholdsMain',
    components: {
        DataTable,
        HouseholdForm,
        HouseholdFilterForm,
        ExportRecordForm,         
        ButtonSelectRecords,
        ButtonExportRecordForm,
        ButtonRefreshData,
        ButtonFilter,
        DictionaryShowRecordLink
    },
    mixins: [ExportDataForm],
    data() {
        return {
            perPageItems : [
                10,
                15,
                20
            ],
            formData: {
                settlement_id: 0,
                household_type_id: 0,
                number: '',
                address_street_type: '',
                address_street_name: '',
                address_house: '',
                address_corps: '',
                address_apartment: '',
                special_marks: '',
                additional_data: ''
            },
            disabledFields: [],
            modalTitle: '',
            modalSubmitCaption: '',
            fancyModalIsVisible: false,
            
            availabaleFields: {
                id: 'ID',
                short_address: 'Місцезнаходження / адреса',
                settlement_name: 'Населений пункт',
                household_head: 'Голова домогосподарства',                
                household_number: 'Домогосподарство',                
            },   
            pathRouterLinkIcon: mdiFolderHomeOutline,
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        ...mapActions('Households', ['toggleSelectAll', 'toggleSelectMode', 'selectMultipleRecords']),
        addCard() {
            this.modalTitle = 'Нова облікова картка';
            this.modalSubmitCaption = 'Додати';

            if (this.filter.isFiltered) {
                if (this.filter.settlement_id > 0) {
                    this.formData.settlement_id     = this.filter.settlement_id;
                    this.disabledFields.push('settlement_id');
                } else {
                    this.disabledFields = this.disabledFields.filter(f => f !== 'settlement_id');
                }

                if (this.filter.household_type_id > 0) {
                    this.formData.household_type_id     = this.filter.household_type_id;
                    this.disabledFields.push('household_type_id');
                } else {
                    this.disabledFields = this.disabledFields.filter(f => f !== 'household_type_id');
                }
            } else {
                this.disabledFields = [];
            }            
            let householdForm = new Modal(document.getElementById('HouseholdForm'));
            householdForm.show();
        },
        openFilterForm() {
            this.modalTitle = 'Фільтр облікових карт';
            this.modalSubmitCaption = 'Застосувати';

            let filterForm = new Modal(document.getElementById('HouseholdFilterForm'));
            filterForm.show();
        },
        resetFilter() {
            this.filter.settlement_id = 0;
            this.filter.household_type_id = 0;
            this.filter.additionalParams = {};
            this.filter.address = '';
            this.filter.isFiltered = false;
            this.$store.dispatch('Households/applyFilter', this.filter);
        },
        perPageChanged(value) {
            this.$store.dispatch('Households/changePerPage', value)
        },
        pageChanged(page) {
            this.$store.dispatch('Households/changePage', page)
        },
        searchData(row, searchText) {
            return  row['address'].includes(searchText) ||
                    row['number'].includes(searchText) ||
                    row['household_head'].includes(searchText);
        },
        sortData(a, b, criteria) {
            // console.log('sortData from Main component');
            console.log(a,b, criteria);
        },
    },
    computed: {
        ...mapGetters('Households', [            
            'households',
            'filter', 
            'pagination', 
            'entities', 
            'isFiltered',
            'inSelectMode', 
            'isIndeterminate', 
            'selectedRecords',
            'selectedRecordsCount', 
            'isAllSelected',
            'toggleSelectAllTitle'
        ]),           
    }
}
</script>


<style lang="scss" scoped>
.settlement {
    display: flex;
    padding: 0.5rem 1rem;
    border: 1px solid #eee;
    border-radius: 0.2rem;
    flex-direction: column;

    .settlement-name {
        font-size: 1.1rem
    }

    .cards-count {
        text-align: end;
        color: var(--bs-gray-600);
    }
}

</style>
