<script>

import Checkbox from '../../components/ui/Chekbox.vue';
import { Modal } from 'bootstrap'
import TableRow from '../../components/ui/TableRow.vue';
import FormValidator from '../../minixs/FormValidator';

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
    mixins: [FormValidator],
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
            mode: 'create'
        }
    },
    methods: {
        clearFormData() {
                this.formData.year = new Date().getFullYear();
                this.formData.total_area = 0;
                this.formData.total_living_area = 0;
                this.formData.living_area = 0;
                this.formData.room_count = 0;
                this.formData.total_non_living_area = 0;
                this.formData.water_supply = false;
                this.formData.hot_water_supply = false;
                this.formData.sewage = false;
                this.formData.central_heating = false;
                this.formData.individual_heating = false;
                this.formData.furnace_heating = false;
                this.formData.natural_gas = false;
                this.formData.liquefied_gas = false;
                this.formData.electric_stove = false;
        },
        newYearData(e) {
            this.modalTitle = 'Додати дані';
            this.modalSubmitCaption = 'Додати';
            this.mode = 'create';
            var myModal = new Modal(document.getElementById('HouseInfoModalForm'))
            if (e.ctrlKey) {
                if (this.years.length > 0) {
                    this.formData = Object.assign({}, this.years[this.years.length-1]);
                    this.formData.year = parseInt(this.formData.year) + 1;
                }
                this.modalTitle = `Додати дані на <b>${this.formData.year}</b> рік`;
            }
            myModal.show();
        },
        submitData() {

            if (this.mode == 'create') {
                axios.post('/api/v1/household-houses', this.formData)
                    .then(res => {
                        this.$store.dispatch('Households/fetchHousehold', this.household_id);
                        this.clearFormData();
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.mode == 'update') {
                axios.patch(`/api/v1/household-houses/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.$store.dispatch('Households/fetchHousehold', this.household_id);
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        deleteYear(id) {
            axios.delete(`/api/v1/household-houses/${id}`)
                .then(res => {
                    this.$store.dispatch('Households/fetchHousehold', this.household_id);
                })
        },
        editYear(id) {
            let _year = this.years.find(y => y.id == id)
            Object.assign(this.formData, _year);
            this.modalSubmitCaption = 'Зберегти';
            this.modalTitle = `Редагувати дані за ${_year.year} рік`;
            this.mode = 'update';
            var myModal = new Modal(document.getElementById('HouseInfoModalForm'))
            myModal.show()
        },
        generateCell(field) {
            let _html = `
                    <td v-for="year in years" :key="(year.year+'-'+year['${field}'])" class="table-cell-bordered">
                        <template v-if="year['${field}']">
                            так
                        </template>
                        <template v-else>
                            ні
                        </template>
                    </td>`;
            console.log(_html);
            return _html;
        }
    },
    components: {
        Checkbox,
        TableRow
    }
}
</script>

<template>
    <div class="pt-4">
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            +
        </button> -->
        <div class="row">
        </div>
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered1 table-sm">
                    <thead>
                        <tr>
                            <th>
                                <!-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> -->
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
                        <!-- <tr>
                            <td><b>Загальна площа житлового будинку/квартири, м<sup>2</sup></b></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.totalArea)" class="table-cell-bordered">
                                {{year.totalArea}}
                            </td>
                        </tr> -->
                        <!-- <tr>
                            <td>Загальна площа житлових приміщень, м<sup>2</sup></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.totalLivingArea)" class="table-cell-bordered">
                                {{year.totalLivingArea}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="total_living_area" rowTitle="Загальна площа житлових приміщень, м<sup>2</sup>"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">з неї житлова площа, м<sup>2</sup></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.livingArea)" class="table-cell-bordered">
                                {{year.livingArea}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="living_area" rowTitle="з неї житлова площа, м<sup>2</sup>" rowTitleClass="ps-5"></TableRow>
                        <!-- <tr>
                            <td>Кількість житлових кімнат</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.roomCount)" class="table-cell-bordered">
                                {{year.roomCount}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="room_count" rowTitle="Кількість житлових кімнат"></TableRow>
                        <tr>
                            <td :colspan="(years.length+1)"><b>Наявність</b><i>(проставляється "так" або "ні")</i></td>
                        </tr>
                        <!-- <tr>
                            <td class="ps-5">водопроводу</td> -->
                            <!-- <template v-html="generateCell('waterSupply')"></template> -->

                            <!-- {{ generateCell('waterSupply') }} -->
                            <!-- <td v-for="year in years" :key="(year.year+'-'+year['waterSupply'])" class="table-cell-bordered">
                                <template v-if="year['waterSupply']">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td> -->
                        <!-- </tr> -->
                        <TableRow :years="years" field="water_supply" rowTitle="водопроводу" rowTitleClass="ps-5" :fieldValue="true">
                            <!-- <template v-if="year['waterSupply']">
                                так
                            </template>
                            <template v-else>
                                ні
                            </template> -->
                        </TableRow>
                        <!-- <tr>
                            <td class="ps-5">горячого водопостачання</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.hotWaterSupply)" class="table-cell-bordered">
                                <template v-if="year.hotWaterSupply">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="hot_water_supply" rowTitle="горячого водопостачання" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">каналізації</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.sewage)" class="table-cell-bordered">
                                <template v-if="year.sewage">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="sewage" rowTitle="каналізації" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">опалення центрального</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.centralHeating)" class="table-cell-bordered">
                                <template v-if="year.centralHeating">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="central_heating" rowTitle="опалення центрального" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">опалення від індивідуальних установок</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.individualHeating)" class="table-cell-bordered">
                                <template v-if="year.individualHeating">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="individual_heating" rowTitle="опалення від індивідуальних установок" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">пічного опалення</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.furnaceHeating)" class="table-cell-bordered">
                                <template v-if="year.furnaceHeating">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="furnace_heating" rowTitle="пічного опалення" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">природного газу</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.naturalGas)" class="table-cell-bordered">
                                <template v-if="year.naturalGas">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="natural_gas" rowTitle="природного газу" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">скрапленого опалення</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.liquefiedGas)" class="table-cell-bordered">
                                <template v-if="year.liquefiedGas">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="liquefied_gas" rowTitle="скрапленого опалення" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">підлогової електричної плити</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.electricStove)" class="table-cell-bordered">
                                <template v-if="year.electricStove">
                                    так
                                </template>
                                <template v-else>
                                    ні
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="electric_stove" rowTitle="підлогової електричної плити" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td><b>Загальна площа нежитлових будівель, м<sup>2</sup></b></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.totalNonLivingArea)" class="table-cell-bordered">
                                {{year.totalNonLivingArea}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="total_non_living_area" rowTitle="<b>Загальна площа нежитлових будівель, м<sup>2</sup></b>"></TableRow>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td v-for="year in years" :key="(year.year+'-'+'buttons')">
                                <div  class="d-flex justify-content-around">
                                    <button class="btn btn-sm btn-outline-danger" @click="deleteYear(year.id)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" @click="editYear(year.id)">
                                        <i class="bi bi-pencil"></i>
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
    <!-- <div class="modal fade" id="HouseInfoModalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> -->
    <div class="modal fade" id="HouseInfoModalForm" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel" v-html="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clearFormData"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-1 row">
                        <label for="year" class="col-sm-9 col-form-label">Рік</label>
                        <div :class="['col-sm-3', hasError('year') ? 'is-invalid' : '']">
                            <input  type="text"
                                    :class="['form-control', hasError('year') ? 'is-invalid' : '']"
                                    id="year"
                                    v-model="formData.year">
                        </div>
                        <div id="yearValidation" class="invalid-feedback">
                            {{ getError('year') }}
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="totalArea" class="col-sm-9 col-form-label">Загальна площа житлового будинку/квартири, м<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="totalArea" v-model="formData.total_area">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="totalLivingArea" class="col-sm-9 col-form-label">Загальна площа житлових приміщень, м<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="totalLivingArea" v-model="formData.total_living_area">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="livingArea" class="col-sm-9 col-form-label">з неї житлова площа, м<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="livingArea" v-model="formData.living_area">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="roomCount" class="col-sm-9 col-form-label">Кількість житлових кімнат</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="roomCount" v-model="formData.room_count">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="totalNonLivingArea" class="col-sm-9 col-form-label">Загальна площа нежитлових будівель, м<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="totalNonLivingArea" v-model="formData.total_non_living_area">
                        </div>
                    </div>
                    <!-- <div class="row align-items-center">
                        <label for="waterSupply" class="col-sm-9 col-form-label">Наявність водопроводу</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="waterSupply" v-model="formData.waterSupply">
                              <label class="form-check-label text-muted" for="waterSupply" v-if="!formData.waterSupply">ні</label>
                              <label class="form-check-label" for="waterSupply" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="hotWaterSupply" class="col-sm-9 col-form-label">Наявність горячого водопостачання</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="hotWaterSupply" v-model="formData.hotWaterSupply">
                              <label class="form-check-label text-muted" for="hotWaterSupply" v-if="!formData.hotWaterSupply">ні</label>
                              <label class="form-check-label" for="hotWaterSupply" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="sewerage" class="col-sm-9 col-form-label">Наявність каналізації</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="sewerage" v-model="formData.sewerage">
                              <label class="form-check-label text-muted" for="sewerage" v-if="!formData.sewerage">ні</label>
                              <label class="form-check-label" for="sewerage" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="centralHeating" class="col-sm-9 col-form-label">Наявність опалення центрального</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="centralHeating" v-model="formData.centralHeating">
                              <label class="form-check-label text-muted" for="centralHeating" v-if="!formData.centralHeating">ні</label>
                              <label class="form-check-label" for="centralHeating" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="individualHeating" class="col-sm-9 col-form-label">Наявність опалення від індивідуальних установок</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="individualHeating" v-model="formData.individualHeating">
                              <label class="form-check-label text-muted" for="individualHeating" v-if="!formData.individualHeating">ні</label>
                              <label class="form-check-label" for="individualHeating" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="furnaceHeating" class="col-sm-9 col-form-label">Наявність пічного опалення</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="furnaceHeating" v-model="formData.furnaceHeating">
                              <label class="form-check-label text-muted" for="furnaceHeating" v-if="!formData.furnaceHeating">ні</label>
                              <label class="form-check-label" for="furnaceHeating" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="naturalGas" class="col-sm-9 col-form-label">Наявність природного газу</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="naturalGas" v-model="formData.naturalGas">
                              <label class="form-check-label text-muted" for="naturalGas" v-if="!formData.naturalGas">ні</label>
                              <label class="form-check-label" for="naturalGas" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="liquefiedGas" class="col-sm-9 col-form-label">Наявність скрапленого газу</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="liquefiedGas" v-model="formData.liquefiedGas">
                              <label class="form-check-label text-muted" for="liquefiedGas" v-if="!formData.liquefiedGas">ні</label>
                              <label class="form-check-label" for="liquefiedGas" v-else>так</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="electricStove" class="col-sm-9 col-form-label">Наявність підлогової електричної плити</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="electricStove" v-model="formData.electricStove">
                              <label class="form-check-label text-muted" for="electricStove" v-if="!formData.electricStove">ні</label>
                              <label class="form-check-label" for="electricStove" v-else>так</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="p-2">
                        <div class="d-flex justify-content-between mb-3">
                            <Checkbox v-model="formData.water_supply" id="waterSupply" image="/img/water-supply.png" title="Наявність водопроводу" />
                            <Checkbox v-model="formData.hot_water_supply" id="hotWaterSupply" image="/img/hot-water.png" title="Наявність гарячого водопостачання" />
                            <Checkbox v-model="formData.sewage" id="hotWaterSupply" image="/img/sewage.png" title="Наявність каналізації" />
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <Checkbox v-model="formData.central_heating" id="centralHeating" image="/img/central-heating.png" title="Наявність центрального опалення" />
                            <Checkbox v-model="formData.individual_heating" id="individualHeating" image="/img/individual-heating.png" title="Наявність опалення від індивідуальних установок" />
                            <Checkbox v-model="formData.furnace_heating" id="furnaceHeating" image="/img/furnace-heating.png" title="Наявність пічного опалення" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <Checkbox v-model="formData.natural_gas" id="naturalGas" image="/img/natural-gas.png" title="Наявність природного газу" />
                            <Checkbox v-model="formData.liquefied_gas" id="liquefiedGas" image="/img/liquefied-gas.png" title="Наявність скрапленого газу" />
                            <Checkbox v-model="formData.electric_stove" id="electricStove" image="/img/electric-stove.png" title="Наявність підлоговоії електричної плити" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">Відмінити</button>
                    <button type="button" class="btn btn-primary" @click="submitData">{{modalSubmitCaption}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.table tr td:not(:first-child),
.table tr th:not(:first-child) {
    text-align: center;
}
</style>
