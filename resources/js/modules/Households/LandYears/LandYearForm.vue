<template>

    <ModalForm  formId="LandYearForm" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-600">

        <div class="row mb-3">
            <label  for="landYear"
                    class="col-form-label col-md-9">
                Рік
            </label>
            <div :class="['col-md-3',  hasError('year') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control', hasError('year') ? 'is-invalid' : '']"
                        id="landYear"
                        name="landYear"
                        v-model="formData.year" />
            </div>
            <div id="landYearValidation" class="invalid-feedback col-md-12">
                {{ getError('year') }}
            </div>
        </div>
        <div class="row mb-3">
            <label  for="landMaintenance"
                    class="col-form-label col-md-9">
                для будівництва і обслуговування житлового будинку
            </label>
            <div  :class="['col-md-3',  hasError('maintenance') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control col-md-3', hasError('maintenance') ? 'is-invalid' : '']"
                        id="landMaintenance"
                        v-model="formData.maintenance" />
            </div>
            <div id="landMaintenanceValidation" class="invalid-feedback col-md-12">
                {{ getError('maintenance') }}
            </div>
        </div>
        <div class="row mb-3">
            <label  for="landPersonalAgriculture"
                    class="col-form-label col-md-9">
                для ведення особистого селянського господарства
            </label>
            <div :class="['col-md-3',  hasError('personal_agriculture') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control', hasError('personal_agriculture') ? 'is-invalid' : '']"
                        id="landPersonalAgriculture"
                        v-model="formData.personal_agriculture" />
            </div>
            <div id="landPersonalAgricultureValidation" class="invalid-feedback col-md-12">
                {{ getError('personal_agriculture') }}
            </div>
        </div>
        <div    :class="['row mb-3', hasError('commercial_agriculture') ? 'is-invalid' : '']">
            <label  for="landCommercialAgriculture"
                    class="col-form-label col-md-9">
                для ведення товарного сільськогосподарського виробництва
            </label>
            <div :class="['col-md-3',  hasError('commercial_agriculture') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control',  hasError('commercial_agriculture') ? 'is-invalid' : '']"
                        id="landCommercialAgriculture"
                        v-model="formData.commercial_agriculture" />
            </div>
            <div id="landCommercialAgricultureValidation" class="invalid-feedback col-md-12">
                {{ getError('commercial_agriculture') }}
            </div>
        </div>

    </ModalForm>

</template>

<script>

import ModalForm        from '../../../components/ui/ModalForm.vue';
import FormValidator    from '../../../minixs/FormValidator';
import SubmitData       from '../../../minixs/SubmitData';

export default {
    name: 'HouseholdLandYearForm',
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
        }
    },
    data() {
        return {
            apiUrl: '/api/v1/household-lands'
        }
    },
    methods: {
        clearFormData() {
            this.formData.year = '';
            this.formData.maintenance = 0;
            this.formData.personal_agriculture = 0;
            this.formData.commercial_agriculture = 0;

            this.errors = [];
        },
    },
    components: {
        ModalForm
    }
}
</script>

<style lang="scss" scoped>

</style>
