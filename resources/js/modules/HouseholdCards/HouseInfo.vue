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
            this.modalTitle = '???????????? ????????';
            this.modalSubmitCaption = '????????????';
            this.mode = 'create';
            var myModal = new Modal(document.getElementById('HouseInfoModalForm'))
            if (e.ctrlKey) {
                if (this.years.length > 0) {
                    this.formData = Object.assign({}, this.years[this.years.length-1]);
                    this.formData.year = parseInt(this.formData.year) + 1;
                }
                this.modalTitle = `???????????? ???????? ???? <b>${this.formData.year}</b> ??????`;
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
            this.modalSubmitCaption = '????????????????';
            this.modalTitle = `???????????????????? ???????? ???? ${_year.year} ??????`;
            this.mode = 'update';
            var myModal = new Modal(document.getElementById('HouseInfoModalForm'))
            myModal.show()
        },
        generateCell(field) {
            let _html = `
                    <td v-for="year in years" :key="(year.year+'-'+year['${field}'])" class="table-cell-bordered">
                        <template v-if="year['${field}']">
                            ??????
                        </template>
                        <template v-else>
                            ????
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
                                    ???????????? ??????
                                </button>
                            </th>
                            <th v-for="year in years" :key="year.year">
                                {{year.year}}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <TableRow :years="years" field="total_area" rowTitle="<b>???????????????? ?????????? ?????????????????? ??????????????/????????????????, ??<sup>2</sup></b>"></TableRow>
                        <!-- <tr>
                            <td><b>???????????????? ?????????? ?????????????????? ??????????????/????????????????, ??<sup>2</sup></b></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.totalArea)" class="table-cell-bordered">
                                {{year.totalArea}}
                            </td>
                        </tr> -->
                        <!-- <tr>
                            <td>???????????????? ?????????? ???????????????? ??????????????????, ??<sup>2</sup></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.totalLivingArea)" class="table-cell-bordered">
                                {{year.totalLivingArea}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="total_living_area" rowTitle="???????????????? ?????????? ???????????????? ??????????????????, ??<sup>2</sup>"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">?? ?????? ?????????????? ??????????, ??<sup>2</sup></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.livingArea)" class="table-cell-bordered">
                                {{year.livingArea}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="living_area" rowTitle="?? ?????? ?????????????? ??????????, ??<sup>2</sup>" rowTitleClass="ps-5"></TableRow>
                        <!-- <tr>
                            <td>?????????????????? ???????????????? ????????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.roomCount)" class="table-cell-bordered">
                                {{year.roomCount}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="room_count" rowTitle="?????????????????? ???????????????? ????????????"></TableRow>
                        <tr>
                            <td :colspan="(years.length+1)"><b>??????????????????</b><i>(???????????????????????????? "??????" ?????? "????")</i></td>
                        </tr>
                        <!-- <tr>
                            <td class="ps-5">??????????????????????</td> -->
                            <!-- <template v-html="generateCell('waterSupply')"></template> -->

                            <!-- {{ generateCell('waterSupply') }} -->
                            <!-- <td v-for="year in years" :key="(year.year+'-'+year['waterSupply'])" class="table-cell-bordered">
                                <template v-if="year['waterSupply']">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td> -->
                        <!-- </tr> -->
                        <TableRow :years="years" field="water_supply" rowTitle="??????????????????????" rowTitleClass="ps-5" :fieldValue="true">
                            <!-- <template v-if="year['waterSupply']">
                                ??????
                            </template>
                            <template v-else>
                                ????
                            </template> -->
                        </TableRow>
                        <!-- <tr>
                            <td class="ps-5">???????????????? ????????????????????????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.hotWaterSupply)" class="table-cell-bordered">
                                <template v-if="year.hotWaterSupply">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="hot_water_supply" rowTitle="???????????????? ????????????????????????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">??????????????????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.sewage)" class="table-cell-bordered">
                                <template v-if="year.sewage">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="sewage" rowTitle="??????????????????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">???????????????? ????????????????????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.centralHeating)" class="table-cell-bordered">
                                <template v-if="year.centralHeating">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="central_heating" rowTitle="???????????????? ????????????????????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">???????????????? ?????? ???????????????????????????? ??????????????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.individualHeating)" class="table-cell-bordered">
                                <template v-if="year.individualHeating">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="individual_heating" rowTitle="???????????????? ?????? ???????????????????????????? ??????????????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">?????????????? ????????????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.furnaceHeating)" class="table-cell-bordered">
                                <template v-if="year.furnaceHeating">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="furnace_heating" rowTitle="?????????????? ????????????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">???????????????????? ????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.naturalGas)" class="table-cell-bordered">
                                <template v-if="year.naturalGas">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="natural_gas" rowTitle="???????????????????? ????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">?????????????????????? ????????????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.liquefiedGas)" class="table-cell-bordered">
                                <template v-if="year.liquefiedGas">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="liquefied_gas" rowTitle="?????????????????????? ????????????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td class="ps-5">???????????????????? ?????????????????????? ??????????</td>
                            <td v-for="year in years" :key="(year.year+'-'+year.electricStove)" class="table-cell-bordered">
                                <template v-if="year.electricStove">
                                    ??????
                                </template>
                                <template v-else>
                                    ????
                                </template>
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="electric_stove" rowTitle="???????????????????? ?????????????????????? ??????????" rowTitleClass="ps-5" :fieldValue="true"></TableRow>
                        <!-- <tr>
                            <td><b>???????????????? ?????????? ???????????????????? ????????????????, ??<sup>2</sup></b></td>
                            <td v-for="year in years" :key="(year.year+'-'+year.totalNonLivingArea)" class="table-cell-bordered">
                                {{year.totalNonLivingArea}}
                            </td>
                        </tr> -->
                        <TableRow :years="years" field="total_non_living_area" rowTitle="<b>???????????????? ?????????? ???????????????????? ????????????????, ??<sup>2</sup></b>"></TableRow>
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
                    ??? ?????? <span>02-0022-1</span>
                </div> -->
                <div class="card mb-3">
                    <div class="card-body">
                        <table class="table table-bordered table-sm mb-0">
                            <tbody>
                                <tr>
                                    <td>?????? ????????????????</td>
                                    <td>1972</td>
                                </tr>
                                <tr>
                                    <td>?????????????? ????????</td>
                                    <td>??????????</td>
                                </tr>
                                <tr>
                                    <td>?????????????? ????????????????</td>
                                    <td>??????????</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>?????????????????? ????????????????????</h5>
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
                        <label for="year" class="col-sm-9 col-form-label">??????</label>
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
                        <label for="totalArea" class="col-sm-9 col-form-label">???????????????? ?????????? ?????????????????? ??????????????/????????????????, ??<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="totalArea" v-model="formData.total_area">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="totalLivingArea" class="col-sm-9 col-form-label">???????????????? ?????????? ???????????????? ??????????????????, ??<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="totalLivingArea" v-model="formData.total_living_area">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="livingArea" class="col-sm-9 col-form-label">?? ?????? ?????????????? ??????????, ??<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="livingArea" v-model="formData.living_area">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="roomCount" class="col-sm-9 col-form-label">?????????????????? ???????????????? ????????????</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="roomCount" v-model="formData.room_count">
                        </div>
                    </div>
                    <div class="mb-2 row">
                        <label for="totalNonLivingArea" class="col-sm-9 col-form-label">???????????????? ?????????? ???????????????????? ????????????????, ??<sup>2</sup></label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="totalNonLivingArea" v-model="formData.total_non_living_area">
                        </div>
                    </div>
                    <!-- <div class="row align-items-center">
                        <label for="waterSupply" class="col-sm-9 col-form-label">?????????????????? ??????????????????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="waterSupply" v-model="formData.waterSupply">
                              <label class="form-check-label text-muted" for="waterSupply" v-if="!formData.waterSupply">????</label>
                              <label class="form-check-label" for="waterSupply" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="hotWaterSupply" class="col-sm-9 col-form-label">?????????????????? ???????????????? ????????????????????????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="hotWaterSupply" v-model="formData.hotWaterSupply">
                              <label class="form-check-label text-muted" for="hotWaterSupply" v-if="!formData.hotWaterSupply">????</label>
                              <label class="form-check-label" for="hotWaterSupply" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="sewerage" class="col-sm-9 col-form-label">?????????????????? ??????????????????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="sewerage" v-model="formData.sewerage">
                              <label class="form-check-label text-muted" for="sewerage" v-if="!formData.sewerage">????</label>
                              <label class="form-check-label" for="sewerage" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="centralHeating" class="col-sm-9 col-form-label">?????????????????? ???????????????? ????????????????????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="centralHeating" v-model="formData.centralHeating">
                              <label class="form-check-label text-muted" for="centralHeating" v-if="!formData.centralHeating">????</label>
                              <label class="form-check-label" for="centralHeating" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="individualHeating" class="col-sm-9 col-form-label">?????????????????? ???????????????? ?????? ???????????????????????????? ??????????????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="individualHeating" v-model="formData.individualHeating">
                              <label class="form-check-label text-muted" for="individualHeating" v-if="!formData.individualHeating">????</label>
                              <label class="form-check-label" for="individualHeating" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="furnaceHeating" class="col-sm-9 col-form-label">?????????????????? ?????????????? ????????????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="furnaceHeating" v-model="formData.furnaceHeating">
                              <label class="form-check-label text-muted" for="furnaceHeating" v-if="!formData.furnaceHeating">????</label>
                              <label class="form-check-label" for="furnaceHeating" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="naturalGas" class="col-sm-9 col-form-label">?????????????????? ???????????????????? ????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="naturalGas" v-model="formData.naturalGas">
                              <label class="form-check-label text-muted" for="naturalGas" v-if="!formData.naturalGas">????</label>
                              <label class="form-check-label" for="naturalGas" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="liquefiedGas" class="col-sm-9 col-form-label">?????????????????? ?????????????????????? ????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="liquefiedGas" v-model="formData.liquefiedGas">
                              <label class="form-check-label text-muted" for="liquefiedGas" v-if="!formData.liquefiedGas">????</label>
                              <label class="form-check-label" for="liquefiedGas" v-else>??????</label>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="electricStove" class="col-sm-9 col-form-label">?????????????????? ???????????????????? ?????????????????????? ??????????</label>
                        <div class="col-sm-3">
                            <div class="form-check form-switch d-flex justify-content-between">
                              <input class="form-check-input" type="checkbox" role="switch" id="electricStove" v-model="formData.electricStove">
                              <label class="form-check-label text-muted" for="electricStove" v-if="!formData.electricStove">????</label>
                              <label class="form-check-label" for="electricStove" v-else>??????</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="p-2">
                        <div class="d-flex justify-content-between mb-3">
                            <Checkbox v-model="formData.water_supply" id="waterSupply" image="/img/water-supply.png" title="?????????????????? ??????????????????????" />
                            <Checkbox v-model="formData.hot_water_supply" id="hotWaterSupply" image="/img/hot-water.png" title="?????????????????? ???????????????? ????????????????????????????" />
                            <Checkbox v-model="formData.sewage" id="hotWaterSupply" image="/img/sewage.png" title="?????????????????? ??????????????????????" />
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <Checkbox v-model="formData.central_heating" id="centralHeating" image="/img/central-heating.png" title="?????????????????? ???????????????????????? ????????????????" />
                            <Checkbox v-model="formData.individual_heating" id="individualHeating" image="/img/individual-heating.png" title="?????????????????? ???????????????? ?????? ???????????????????????????? ??????????????????" />
                            <Checkbox v-model="formData.furnace_heating" id="furnaceHeating" image="/img/furnace-heating.png" title="?????????????????? ?????????????? ????????????????" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <Checkbox v-model="formData.natural_gas" id="naturalGas" image="/img/natural-gas.png" title="?????????????????? ???????????????????? ????????" />
                            <Checkbox v-model="formData.liquefied_gas" id="liquefiedGas" image="/img/liquefied-gas.png" title="?????????????????? ?????????????????????? ????????" />
                            <Checkbox v-model="formData.electric_stove" id="electricStove" image="/img/electric-stove.png" title="?????????????????? ?????????????????????? ?????????????????????? ??????????" />
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">??????????????????</button>
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
