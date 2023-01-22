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
                        <TableRow :years="years" field="total_area" rowTitle="<b>Загальна площа житлового будинку/квартири, м<sup>2</sup></b>"></TableRow>
                        <TableRow :years="years" field="total_living_area" rowTitle="Загальна площа житлових приміщень, м<sup>2</sup>"></TableRow>
                        <TableRow :years="years" field="living_area" rowTitle="з неї житлова площа, м<sup>2</sup>" rowTitleClass="ps-5"></TableRow>
                        <TableRow :years="years" field="room_count" rowTitle="Кількість житлових кімнат"></TableRow>
                        <tr>
                            <td :colspan="(years.length+1)"><b>Наявність</b><i>(проставляється "так" або "ні")</i></td>
                        </tr>
                        <TableRow :years="years" field="water_supply" rowTitle="водопроводу" rowTitleClass="ps-5" :fieldValue="true">
                        </TableRow>
                        <TableRow :years="years" field="hot_water_supply" rowTitle="горячого водопостачання" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="sewage" rowTitle="каналізації" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="central_heating" rowTitle="опалення центрального" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="individual_heating" rowTitle="опалення від індивідуальних установок" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="furnace_heating" rowTitle="пічного опалення" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="natural_gas" rowTitle="природного газу" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="liquefied_gas" rowTitle="скрапленого опалення" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="electric_stove" rowTitle="підлогової електричної плити" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <TableRow :years="years" field="total_non_living_area" rowTitle="<b>Загальна площа нежитлових будівель, м<sup>2</sup></b>"></TableRow>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td v-for="year in years" :key="(year.year+'-'+'buttons')">
                                <div  class="d-flex justify-content-around">
                                    <button class="btn btn-sm btn-outline-danger" @click="deleteYear(year.id)">
                                        <span class="mdi mdi-trash-can"></span>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" @click="editYear(year.id)">
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

    <HouseYearForm :formData="formData" :action="action" @refreshData="$store('Households/fetchRecord', household_id)" />

</template>

<script>
import { Modal } from 'bootstrap'
import { computed } from 'vue'

import TableRow from '../../../components/ui/TableRow.vue';
import HouseYearForm from './HouseYearForm.vue';

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
            action: ''
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        newYearData(e) {
            this.modalTitle = 'Додати дані';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            let yearForm = new Modal(document.getElementById('HouseInfoModalForm'))
            if (e.ctrlKey) {
                if (this.years.length > 0) {
                    this.formData = Object.assign({}, this.years[this.years.length-1]);
                    this.formData.year = parseInt(this.formData.year) + 1;
                }
                this.modalTitle = `Додати дані на <b>${this.formData.year}</b> рік`;
            }
            yearForm.show();
        },
        deleteYear(id) {
            axios.delete(`/api/v1/household-houses/${id}`)
                .then(res => {
                    this.$store.dispatch('Households/fetchRecord', this.household_id);
                })
        },
        editYear(id) {
            let _year = this.years.find(y => y.id == id)
            Object.assign(this.formData, _year);

            this.modalSubmitCaption = 'Зберегти';
            this.modalTitle = `Редагувати дані за ${_year.year} рік`;
            this.action = 'update';

            var yearForm = new Modal(document.getElementById('HouseInfoModalForm'))
            yearForm.show()
        },
        // generateCell(field) {
        //     let _html = `
        //             <td v-for="year in years" :key="(year.year+'-'+year['${field}'])" class="table-cell-bordered">
        //                 <template v-if="year['${field}']">
        //                     так
        //                 </template>
        //                 <template v-else>
        //                     ні
        //                 </template>
        //             </td>`;
        //     console.log(_html);
        //     return _html;
        // }
    },
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
