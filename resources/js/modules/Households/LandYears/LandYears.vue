<template>
    <div class="pt-4">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-sm table-bordered table-years">
                    <thead>
                        <tr>
                            <th>
                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary btn-transparent"
                                        @click="newYearData">
                                    <span class="mdi mdi-plus-thick"></span>
                                    Додати рік
                                </button>
                            </th>
                            <th v-for="year in years"
                                :key="year.year">
                                {{year.year}}
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light btn-transparent"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                            title="Операції з даними за рік">
                                        <span class="mdi mdi-cog"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" @click="editYear(year)">
                                                <span class="mdi mdi-pencil text-warning me-2"></span>
                                                Редагувати дані
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" @click="deleteYear(year)">
                                                <span class="mdi mdi-trash-can text-danger me-2"></span>
                                                Видалити дані
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <TableRow   :years="years"
                                    field="total"
                                    rowTitle="<b>Площа земельних ділянок - усього</b>" />
                        <!-- <TableRow :years="years" field="purpose" rowTitle="з неї за цільовим призначенням <i>(відповідно до документів)</i>" /> -->
                        <tr>
                            <td :colspan="(years.length+1)">з неї за цільовим призначенням <i>(відповідно до документів):</i></td>
                        </tr>
                        <TableRow   :years="years"
                                    field="maintenance"
                                    rowTitle="для будівництва і обслуговування житлового будинку"
                                    rowTitleClass="ps-3"/>
                        <TableRow   :years="years"
                                    field="personal_agriculture"
                                    rowTitle="для ведення особистого селянського господарства"
                                    rowTitleClass="ps-3"/>
                        <TableRow   :years="years"
                                    field="commercial_agriculture"
                                    rowTitle="для ведення товарного сільськогосподарського виробництва"
                                    rowTitleClass="ps-3"/>
                        <!-- <TableRow :years="years" field="arable" rowTitle="рілля" rowTitleClass="ps-5" />
                        <TableRow :years="years" field="perennial_plantations" rowTitle="багаторічні насадження" rowTitleClass="ps-5" />
                        <TableRow :years="years" field="pastures" rowTitle="сіножатні, пасовища" rowTitleClass="ps-5" /> -->
                        <!-- <tr>
                            <td :colspan="(years.length+1)"><b>Наявність</b><i>(проставляється "так" або "ні")</i></td>
                        </tr> -->
                        <!-- <TableRow :years="years" field="water_supply" rowTitle="водопроводу" rowTitleClass="ps-5" :fieldValue="true">
                        <TableRow :years="years" field="hot_water_supply" rowTitle="горячого водопостачання" rowTitleClass="ps-5" :fieldValue="true"></TableRow> -->
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0">
                    <div class="card-header thin-header align-items-center">
                        <h6>Додаткова інформація</h6>
                        <button class="btn btn-sm btn-light btn-transparent"
                                @click="openLandAdditionalDataForm">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                    </div>
                    <div class="card-body" v-if="info && (info.length > 0)">
                        <template v-if="landInfo('land_additional_data') !== ''">
                            {{ landInfo('land_additional_data') }}
                        </template>
                        <template v-else>
                            <div class="text-center" style="color: var(--bs-gray-600);">інформація відсутня</div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <LandYearForm
            :formData="yearData"
            :action="action"
            @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

    <LandAdditionalDataForm
            :formData="additionalData"
            @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

</template>

<script>

import { computed }         from 'vue';
import { mapGetters }       from 'vuex';
import { Modal }            from 'bootstrap';

import TableRow                 from '../../../components/ui/TableRow.vue';
import LandYearForm             from './LandYearForm.vue';
import LandAdditionalDataForm   from './LandAdditionalDataForm.vue';

import NumberFormat         from '../../../minixs/NumberFormat';
import HouseholdYearsCUD    from '../../../minixs/HouseholdYearsCUD';

export default {
    name: 'HouseholdLandYears',
    mixins: [NumberFormat, HouseholdYearsCUD],
    data() {
        return {
            yearData: {
                household_id: null,
                year:new Date().getFullYear(),
                maintenance: 0,
                personal_agriculture: 0,
                commercial_agriculture: 0
            },
            additionalData: {
                household_id: null,
                land_additional_data: '',
            },
            modalTitle: '',
            modalSubmitCaption: '',
            action: '',
            yearFormId: 'LandYearForm',
            apiUrl: '/api/v1/household-lands'
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        openLandAdditionalDataForm() {
            this.modalTitle = 'Додаткова інформація';
            this.modalSubmitCaption = 'Зберегти'

            this.additionalData.household_id = this.household_id;
            this.additionalData.land_additional_data = this.landInfo('land_additional_data');

            var additionalDataForm = new Modal(document.getElementById('LandAdditionalDataForm'))
            additionalDataForm.show()
        },
        landInfo(param) {
            let additionalParam = this.info.find(i => i.code == param)
            return additionalParam.value ? additionalParam.value : '';
        }
    },
    computed: {
        ...mapGetters('Households', {'years':'landYears', 'household_id': 'household_id', 'info': 'landInfo'})
    },
    components: {
        TableRow,
        LandYearForm,
        LandAdditionalDataForm
    }
}
</script>
