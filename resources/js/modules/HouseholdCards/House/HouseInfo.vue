<template>
    <div class="pt-4">

        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered1 table-sm">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" class="btn btn-sm btn-primary" @click="newYearData($event)">
                                    Додати рік
                                </button>
                            </th>
                            <th v-for="year in years" :key="year.year">
                                {{year.year}}
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
                    <tfoot>
                        <tr>
                            <td></td>
                            <td v-for="year in years" :key="(year.year+'-'+'buttons')">
                                <div  class="d-flex justify-content-around">
                                    <button class="btn btn-sm btn-outline-danger" @click="deleteYear(year)">
                                        <span class="mdi mdi-trash-can"></span>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" @click="editYear(year)">
                                        <span class="mdi mdi-pencil"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-3">
                <!-- <div>
                    № ПГО <span>02-0022-1</span>
                </div> -->
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table table-bordered table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td>Рік побудови</td>
                                    <td>1972</td>
                                </tr>
                                <tr>
                                    <td>Матеріл стін</td>
                                    <td>цегла</td>
                                </tr>
                                <tr>
                                    <td>Матеріл покровлі</td>
                                    <td>шифер</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Додаткова інформація</h5>
                    </div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quas, nobis aliquid porro nulla quaerat excepturi nesciunt? Ea, dolore, reiciendis impedit ipsa quis similique quaerat quo ipsum sapiente doloremque accusantium!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <HouseYearForm  :formData="formData"
                    :action="action"
                    @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

</template>

<script>

import { computed } from 'vue'

import TableRow from '../../../components/ui/TableRow.vue';
import HouseYearForm from './HouseYearForm.vue';

import HouseholdYearsCUD from '../../../minixs/HouseholdYearsCUD';

export default {
    name: 'HouseInfo',
    props: {
        'years': {
            type: Array,
            required: true
        },
        'household_id': {
            type: [String, Number],
            required: true
        }
    },
    mixins: [HouseholdYearsCUD],
    data() {
        return {
            formData: {
                household_id: this.household_id,
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
            modalSubmitCaption: '',
            modalTitle: '',
            action: '',
            yearFormId: 'HouseInfoModalForm',
            apiUrl: '/api/v1/household-houses'
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {},
    components: {
        TableRow,
        HouseYearForm
    }
}
</script>

<style scoped>
.table tr td:not(:first-child),
.table tr th:not(:first-child) {
    text-align: center;
}
</style>
