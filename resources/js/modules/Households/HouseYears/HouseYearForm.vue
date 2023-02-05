<template>

    <ModalForm formId="HouseInfoModalForm" @submitData="submitData" @closeForm="clearFormData">

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
            <div :class="['col-sm-3', hasError('total_area') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control', hasError('total_area') ? 'is-invalid' : '']"
                        id="totalArea"
                        v-model="formData.total_area">
            </div>
            <div id="totalAreaValidation" class="invalid-feedback">
                {{ getError('total_area') }}
            </div>
        </div>

        <div class="mb-1 row">
            <label for="totalLivingArea" class="col-sm-9 col-form-label">Загальна площа житлових приміщень, м<sup>2</sup></label>
            <div :class="['col-sm-3', hasError('total_living_area') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control', hasError('total_living_area') ? 'is-invalid' : '']"
                        id="totalLivingArea"
                        v-model="formData.total_living_area">
            </div>
            <div id="totalLivingAreaValidation" class="invalid-feedback">
                {{ getError('total_living_area') }}
            </div>
        </div>
        <div class="mb-1 row">
            <label for="livingArea" class="col-sm-9 col-form-label">з неї житлова площа, м<sup>2</sup></label>
            <div :class="['col-sm-3', hasError('living_area') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control', hasError('living_area') ? 'is-invalid' : '']"
                        id="livingArea"
                        v-model="formData.living_area">
            </div>
            <div id="livingAreaValidation" class="invalid-feedback">
                {{ getError('living_area') }}
            </div>
        </div>
        <div class="mb-1 row">
            <label for="roomCount" class="col-sm-9 col-form-label">Кількість житлових кімнат</label>
            <div :class="['col-sm-3', hasError('room_count') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control', hasError('room_count') ? 'is-invalid' : '']"
                        id="roomCount"
                        v-model="formData.room_count">
            </div>
            <div id="roomCountValidation" class="invalid-feedback">
                {{ getError('room_count') }}
            </div>
        </div>
        <div class="mb-2 row">
            <label for="totalNonLivingArea" class="col-sm-9 col-form-label">Загальна площа нежитлових будівель, м<sup>2</sup></label>
            <div :class="['col-sm-3', hasError('total_non_living_area') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control', hasError('total_non_living_area') ? 'is-invalid' : '']"
                        id="totalNonLivingArea"
                        v-model="formData.total_non_living_area">
            </div>
            <div id="totalNonLivingAreaValidation" class="invalid-feedback">
                {{ getError('total_non_living_area') }}
            </div>
        </div>
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


    </ModalForm>

</template>

<script>

import Checkbox         from '../../../components/ui/Chekbox.vue';
import ModalForm        from '../../../components/ui/ModalForm.vue';

import FormValidator    from '../../../minixs/FormValidator';
import SubmitData       from '../../../minixs/SubmitData';

export default {
    name: 'HouseholdHouseYearForm',
    mixins: [FormValidator, SubmitData],
    props: {
        'formData': {
            type: Object,
            required: true,
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        },
        'disabledFields': {
            type: Array,
            required: false,
            default: () => []
        }
    },
    data() {
        return {
            apiUrl: '/api/v1/household-houses'
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

            this.errors = [];
        },
    },
    components: {
        ModalForm,
        Checkbox,
    }
}
</script>
