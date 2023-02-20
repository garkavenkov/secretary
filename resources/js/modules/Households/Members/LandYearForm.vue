<template>

    <ModalForm  formId="LandYearForm"
                :submitCaption="submitCaption"
                :title="title"
                @closeForm="closeForm"
                @submitData="submitData"
                modalContentClass="second-modal">

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
                під забудовою
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
                для ведення <abbr title="особистого селянського господарства">ОСГ</abbr>
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
        <div    :class="['row mb-3', hasError('hay_cutting') ? 'is-invalid' : '']">
            <label  for="landHayCatting"
                    class="col-form-label col-md-9">
                сінокосіння
            </label>
            <div :class="['col-md-3',  hasError('hay_cutting') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control',  hasError('hay_cutting') ? 'is-invalid' : '']"
                        id="landHayCatting"
                        v-model="formData.hay_cutting" />
            </div>
            <div id="landHayCutting" class="invalid-feedback col-md-12">
                {{ getError('hay_cutting') }}
            </div>
        </div>
        <div    :class="['row mb-3', hasError('pastures') ? 'is-invalid' : '']">
            <label  for="landPastures"
                    class="col-form-label col-md-9">
                пасовища
            </label>
            <div :class="['col-md-3',  hasError('pastures') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control',  hasError('pastures') ? 'is-invalid' : '']"
                        id="landPastures"
                        v-model="formData.pastures" />
            </div>
            <div id="landPastures" class="invalid-feedback col-md-12">
                {{ getError('pastures') }}
            </div>
        </div>

        <div    :class="['row mb-3', hasError('land_share') ? 'is-invalid' : '']">
            <label  for="landShare"
                    class="col-form-label col-md-9">
                земельний пай
            </label>
            <div :class="['col-md-3',  hasError('land_share') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control',  hasError('land_share') ? 'is-invalid' : '']"
                        id="landShare"
                        v-model="formData.land_share" />
            </div>
            <div id="landShare" class="invalid-feedback col-md-12">
                {{ getError('land_share') }}
            </div>
        </div>
        <div    :class="['row mb-3', hasError('property_share') ? 'is-invalid' : '']">
            <label  for="landPropertyShare"
                    class="col-form-label col-md-9">
                майновий пай
            </label>
            <div :class="['col-md-3',  hasError('property_share') ? 'is-invalid' : '']">
                <input  type="text"
                        :class="['form-control',  hasError('property_share') ? 'is-invalid' : '']"
                        id="landPropertyShare"
                        v-model="formData.property_share" />
            </div>
            <div id="landShare" class="invalid-feedback col-md-12">
                {{ getError('property_share') }}
            </div>
        </div>


    </ModalForm>

</template>

<script>

import ModalForm        from '../../../components/ui/ModalForm.vue';

import FormValidator    from '../../../minixs/FormValidator';
import SubmitData       from '../../../minixs/SubmitData';

export default {
    name: 'LandYearForm',
    mixins: [FormValidator, SubmitData],
    props: {
        'formData': {
            type: Object,
            required: true
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        },
        'title': {
            type: String,
            required: true
        },
        'submitCaption': {
            type: String,
            required: true
        },
    },
    data() {
        return {
            apiUrl: '/api/v1/household-member-lands'
        }
    },
    methods: {
        closeForm() {
            this.$emit('closeYearForm');
        }
    },
    components: {
        ModalForm
    }
}

</script>
