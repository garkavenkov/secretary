<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Облікові картки</span>
                <button class="btn btn-sm btn-primary" @click="addCard">
                    <span class="mdi mdi-plus"></span>
                </button>
                <button class="btn btn-sm btn-outline-primary ms-2" @click="$store.dispatch('Households/fetchRecords')" title="Оновити дані">
                    <span class="mdi mdi-refresh"></span>
                </button>
            </div>
            <div>
                <button :class="['btn btn-sm btn-outline-secondary', filter.isFiltered ? 'active' : '' ]"
                        @click.exact="openFilterForm"
                        @click.ctrl="resetFilter"
                        title="Фільтр облікових карток">
                    <span class="mdi mdi-filter-outline"></span>
                </button>
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
                        <th></th>
                        <th data-sort-field="number" data-field-type="string" class="sortable">Номер</th>
                        <th>Населений пункт</th>
                        <th data-sort-field="address" data-field-type="string" class="sortable">Місцезнаходження / адреса</th>
                        <th>Голова домогосподарства</th>
                        <th data-sort-field="household_members_count" data-field-type="number" class="sortable">Мешкає</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td class="text-center">
                            <router-link :to="{name: 'households.show', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>                            
                        </td>
                        <td class="text-center">{{record.number}}</td>
                        <td>{{record.settlement}}</td>
                        <td>{{record.address}}</td>
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


</template>

<script>

import { mapGetters }       from 'vuex';
import { Modal }            from 'bootstrap'
import { computed }         from 'vue';

import DataTable            from '../../components/ui/DataTable.vue';
import HouseholdForm        from './HouseholdForm.vue';
import HouseholdFilterForm  from './HouseholdFilterForm.vue';

export default {
    name: 'HouseholdCardsMain',
    components: {
        DataTable,
        HouseholdForm,
        HouseholdFilterForm,
    },
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
            fancyModalIsVisible: false
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
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
            // console.log(this.disabledFields);
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
        }
    },
    computed: {
        ...mapGetters('Households', ['households', 'filter', 'pagination']),
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
