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
                                        @click="newYearData($event)">
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
                                    field="total_area"
                                    rowTitle="<b>Загальна площа житлового будинку/квартири, м<sup>2</sup></b>" />

                        <TableRow   :years="years"
                                    field="total_living_area"
                                    rowTitle="Загальна площа житлових приміщень, м<sup>2</sup>" />

                        <TableRow   :years="years"
                                    field="living_area"
                                    rowTitle="з неї житлова площа, м<sup>2</sup>"
                                    rowTitleClass="ps-5" />

                        <TableRow   :years="years"
                                    field="room_count"
                                    rowTitle="Кількість житлових кімнат" />
                        <tr>
                            <td :colspan="(years.length+1)"><b>Наявність</b><i>(проставляється "так" або "ні")</i></td>
                        </tr>

                        <TableRow   :years="years"
                                    field="water_supply"
                                    rowTitle="водопроводу"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="hot_water_supply"
                                    rowTitle="горячого водопостачання"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="sewage"
                                    rowTitle="каналізації"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="central_heating"
                                    rowTitle="опалення центрального"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="individual_heating"
                                    rowTitle="опалення від індивідуальних установок"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="furnace_heating"
                                    rowTitle="пічного опалення"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="natural_gas"
                                    rowTitle="природного газу"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="liquefied_gas"
                                    rowTitle="скрапленого опалення"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="electric_stove"
                                    rowTitle="підлогової електричної плити"
                                    rowTitleClass="ps-5"
                                    :fieldValue="true" />

                        <TableRow   :years="years"
                                    field="total_non_living_area"
                                    rowTitle="<b>Загальна площа нежитлових будівель, м<sup>2</sup></b>" />
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <!-- <div>
                    № ПГО <span>02-0022-1</span>
                </div> -->
                <div class="card rounded-0 mb-4">
                    <div class="card-header thin-header align-items-center">
                        <h6>Інформація по будинку</h6>
                        <button class="btn btn-sm btn-light btn-transparent"
                                @click="openHouseInfoForm">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm mb-0" id="houseInfo">
                            <tbody v-if="info && (info.length > 0)">
                                <tr>
                                    <td>Рік побудови</td>
                                    <td v-if="houseInfo('house_year_of_construction') !== ''">
                                        {{ houseInfo('house_year_of_construction') }}
                                    </td>
                                    <td v-else style="color: var(--bs-gray-600);">
                                        не вказано
                                    </td>
                                </tr>
                                <tr>
                                    <td>Матеріал стін</td>
                                    <td v-if="houseInfo('house_material_walls') !== ''">
                                        {{ houseInfo('house_material_walls') }}
                                    </td>
                                    <td v-else style="color: var(--bs-gray-600);">
                                        не вказано
                                    </td>
                                </tr>
                                <tr>
                                    <td>Матеріал даху</td>
                                    <td v-if="houseInfo('house_material_roof') !== ''">
                                        {{ houseInfo('house_material_roof') }}
                                    </td>
                                    <td v-else style="color: var(--bs-gray-600);">
                                        не вказано
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card rounded-0">
                    <div class="card-header thin-header align-items-center">
                        <h6>Додаткова інформація</h6>
                        <button class="btn btn-sm btn-light btn-transparent"
                                @click="openHouseAdditionalDataForm">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                    </div>
                    <div class="card-body" v-if="info && (info.length > 0)">
                        <template v-if="houseInfo('house_additional_data') !== ''">
                            {{ houseInfo('house_additional_data') }}
                        </template>
                        <template v-else>
                            <div class="text-center" style="color: var(--bs-gray-600);">інформація відсутня</div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <HouseYearForm  :formData="yearData"
                    :action="action"
                    @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

    <HouseInfoForm  :formData="infoData"
                    @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

    <HouseAdditionalDataForm
                    :formData="additionalData"
                    @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

</template>

<script>

import { computed }             from 'vue'
import { mapGetters }           from 'vuex';
import { Modal }                from 'bootstrap';

import HouseYearForm            from './HouseYearForm.vue';
import HouseInfoForm            from './HouseInfoForm.vue';
import HouseAdditionalDataForm  from './HouseAdditionalDataForm.vue';

import TableRow                 from '../../../components/ui/TableRow.vue';
import HouseholdYearsCUD        from '../../../mixins/HouseholdYearsCUD';

export default {
    name: 'HouseholdHouseYears',
    mixins: [HouseholdYearsCUD],
    data() {
        return {
            yearData: {
                household_id: null,
                year: new Date().getFullYear(),
                total_area: 0,
                total_living_area: 0,
                living_area: 0,
                room_count: 0,
                total_non_living_area: 0,
                water_supply: false,
                hot_water_supply: false,
                sewage: false,
                central_heating: false,
                individual_heating: false,
                furnace_heating: false,
                natural_gas: false,
                liquefied_gas: false,
                electric_stove: false,
            },
            infoData: {
                household_id: null,
                house_year_of_construction: '',
                house_material_walls: '',
                house_material_roof: ''
            },
            additionalData: {
                household_id: null,
                house_additional_data: '',
            },
            modalSubmitCaption: '',
            modalTitle: '',
            action: '',
            yearFormId: 'HouseInfoModalForm',
            apiUrl: '/api/v1/household-houses',
            houseInfoIsEditable: false,
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        startHouseInfoEdit() {
            this.houseInfoIsEditable = true;
        },
        cancelHouseInfoEdit() {
            this.houseInfoIsEditable = false;
        },
        openHouseInfoForm() {
            this.modalTitle = 'Інформація по будинку';
            this.modalSubmitCaption = 'Зберегти'

            this.infoData.household_id                  = this.household_id;
            this.infoData.house_year_of_construction    = this.houseInfo('house_year_of_construction');
            this.infoData.house_material_walls          = this.houseInfo('house_material_walls');
            this.infoData.house_material_roof           = this.houseInfo('house_material_roof');

            var infoForm = new Modal(document.getElementById('HouseInfoForm'))
            infoForm.show()
        },
        openHouseAdditionalDataForm() {
            this.modalTitle = 'Додаткова інформація';
            this.modalSubmitCaption = 'Зберегти'

            this.additionalData.household_id = this.household_id;
            this.additionalData.house_additional_data = this.houseInfo('house_additional_data');

            var additionalDataForm = new Modal(document.getElementById('HouseAdditionalDataForm'))
            additionalDataForm.show()
        },
        houseInfo(param) {
            let additionalParam = this.info.find(i => i.code == param)
            return additionalParam.value ? additionalParam.value : '';
        }
    },
    computed: {
        ...mapGetters('Households', {'years':'houseYears', 'household_id': 'household_id', 'info': 'houseInfo'})
    },
    components: {
        TableRow,
        HouseYearForm,
        HouseInfoForm,
        HouseAdditionalDataForm
    }
}
</script>

<style lang="scss" scoped>
#houseInfo tr td:last-of-type {
    text-align: center;
}
</style>
