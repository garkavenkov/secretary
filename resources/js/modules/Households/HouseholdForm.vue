<template>

    <ModalForm formId="HouseholdForm" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-lg">
        <div class="row mb-3">
            <div class="col">
                <label for="householdType" class="form-label">Населений пункт</label>
                <select :class="['form-control', hasError('settlement_id') ? 'is-invalid' : '']"
                        id="householdType"
                        aria-label="Default select example"
                        v-model="formData.settlement_id">
                    <option disabled value="0">Оберить населений пункт</option>
                    <option :value="settlement.id" v-for="settlement in settlements" :key="settlement.id">
                        {{settlement.name}}
                    </option>
                </select>
                <div id="householdTypeValidation" class="invalid-feedback">
                    {{ getError('settlement_id') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="householdType" class="form-label">Тип об'єкта погосподарського обліку</label>
                <select :class="['form-control', hasError('household_type_id') ? 'is-invalid' : '']"
                        id="householdType"
                        aria-label="Default select example"
                        v-model="formData.household_type_id">
                    <option disabled value="0">Оберить тип об'єкта</option>
                    <option :value="householdType.id" v-for="householdType in householdTypes" :key="householdType.id">
                        {{householdType.name}}
                    </option>
                </select>
                <div id="householdTypeValidation" class="invalid-feedback">
                    {{ getError('household_type_id') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="householdAddress" class="form-label">Місцезнаходження / адреса</label>
                <textarea
                        :class="['form-control', hasError('address') ? 'is-invalid' : '']"
                        id="householdAddress"
                        rows="2"
                        v-model="formData.address">
                </textarea>
                <div id="householdAddressValidation" class="invalid-feedback">
                    {{ getError('address') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="householdSpecialMarks" class="form-label">Спеціальні відмітки</label>
                <textarea
                        :class="['form-control', hasError('special_marks') ? 'is-invalid' : '']"
                        id="householdSpecialMarks"
                        rows="2"
                        v-model="formData.special_marks">
                </textarea>
                <div id="householdSpecialMarksValidation" class="invalid-feedback">
                    {{ getError('special_marks') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="householdAdditionalData" class="form-label">Додаткові відомості</label>
                <textarea
                        :class="['form-control', hasError('additional_data') ? 'is-invalid' : '']"
                        id="householdAdditionalData"
                        rows="2"
                        v-model="formData.additional_data">
                </textarea>
                <div id="householdAdditionalDataValidation" class="invalid-feedback">
                    {{ getError('additional_data') }}
                </div>
            </div>
        </div>


    </ModalForm>


</template>

<script>
import { mapGetters }   from 'vuex';
import FormValidator    from '../../minixs/FormValidator';
import SubmitData       from '../../minixs/SubmitData';

import ModalForm        from '../../components/ui/ModalForm.vue';

export default {
    name: 'HouseholdForm',
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
    },
    data() {
        return {
            apiUrl: '/api/v1/households',
        }
    },
    methods: {
        clearFormData() {
            this.formData.settlement_id = 0;
            this.formData.household_type_id = 0;
            this.formData.address = '';
            this.formData.special_marks =  '';
            this.formData.additional_data = '';
        }
    },
    computed: {
        ...mapGetters('Settlements', ['settlements']),
        ...mapGetters('HouseholdTypes', ['householdTypes'])
    },
    components: {
        ModalForm
    }
}
</script>
