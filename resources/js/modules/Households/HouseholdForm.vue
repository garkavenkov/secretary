<template>

    <ModalForm formId="HouseholdForm" @submitData="saveData" @closeForm="clearFormData" modalClass="modal-lg" :sumbitIsDisabled="!addressIsFilled">
        <div class="row mb-3">
            <div class="col-md-9">
                <label  for="householdSettlement"
                        class="form-label">
                    Населений пункт
                </label>
                <select :class="['form-control', hasError('settlement_id') ? 'is-invalid' : '']"
                        id="householdSettlement"
                        aria-label="Default select example"
                        v-model="formData.settlement_id"
                        :disabled="disabledFields.includes('settlement_id')">
                    <option disabled value="0">Оберить населений пункт</option>
                    <option :value="settlement.id" v-for="settlement in settlements" :key="settlement.id">
                        {{settlement.name}}
                    </option>
                </select>
                <div id="householdSettlementValidation" class="invalid-feedback">
                    {{ getError('settlement_id') }}
                </div>
            </div>
            <div class="col-md-3">
                <label  for="householdNumber" class="form-label">Номер об'єкта</label>
                <input  type="text"
                        :class="['form-control', hasError('number') ? 'is-invalid' : '']"
                        id="householdNumber"
                        v-model="formData.number">
                <div id="householdNumberValidation" class="invalid-feedback">
                    {{ getError('number') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="householdType"
                        class="form-label">
                    Тип об'єкта погосподарського обліку
                </label>
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
        <div class="row">
            <p>
                Місцезнаходження / адреса
            </p>
        </div>
        <div class="row mb-3">
            <div class="col-md-2">
                <label  for="streetType"
                        class="form-label address-label">
                    тип вулиці
                </label>
                <select :class="['form-control', hasError('address') ? 'is-invalid' : '']"
                        id="streetType"
                        name="streetType"
                        v-model="formData.address_street_type">
                    <option value="вул.">вулиця</option>
                    <option value="пр.">проспект</option>
                    <option value="пров.">провулок</option>
                    <option value="пл.">площа</option>
                </select>
            </div>
            <div class="col-md-4">
                <label  for="streetName" class="form-label address-label">вулиця</label>
                <input  type="text"
                        :class="['form-control', hasError('address') ? 'is-invalid' : '']"
                        id="streetName"
                        name="streetName"
                        v-model="formData.address_street_name">
            </div>
            <div class="col-md-2">
                <label  for="houseNumber" class="form-label address-label">будинок</label>
                <input  type="text"
                        :class="['form-control', hasError('address') ? 'is-invalid' : '']"
                        id="houseNumber"
                        v-model="formData.address_house">
            </div>
            <div class="col-md-2">
                <label  for="corpsNumber" class="form-label address-label">корпус</label>
                <input  type="text"
                        :class="['form-control', (hasError('address') && (formData.address_corps !==''))? 'is-invalid' : '']"
                        id="corpsNumber"
                        v-model="formData.address_corps">
            </div>
            <div class="col-md-2">
                <label  for="apartmentNumber" class="form-label address-label">квартира</label>
                <input  type="text"
                        :class="['form-control', (hasError('address') && (formData.address_apartment !== ''))? 'is-invalid' : '']"
                        id="apartmentNumber"
                        v-model="formData.address_apartment">
            </div>
            <div    id="householdAddressValidation"
                    :class="['invalid-feedback', hasError('address') ? 'd-block' : '']">
                {{ getError('address') }}
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
import FormValidator    from '../../mixins/FormValidator';
import SubmitData       from '../../mixins/SubmitData';

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
        'disabledFields': {
            type: Array,
            required: false,
            default: () => []
        }
    },
    data() {
        return {
            apiUrl: '/api/v1/households',
            excludeFiledsFromCreateWatch: [
                'address_street_type',
                'address_street_name',
                'address_house',
                'address_corps',
                'address_apartment'
            ]
        }
    },
    methods: {
        clearFormData() {
            this.formData.settlement_id = 0;
            this.formData.number = '';
            this.formData.household_type_id = 0;

            this.formData.address_street_type = '';
            this.formData.address_street_name = '';
            this.formData.address_house = '';
            this.formData.address_corps = '';
            this.formData.address_apartment = '';

            this.formData.address = '';
            this.formData.special_marks =  '';
            this.formData.additional_data = '';

            this.errors = [];
        },
        saveData() {
            if (this.formData.address_street_type == '' ||
                this.formData.address_street_name == '' ||
                this.formData.address_house == '' ) return;

            let address = '';

            address = this.formData.address_street_type + ',';
            address = address + this.formData.address_street_name + ',';
            address = address + this.formData.address_house + ',';
            address = address + this.formData.address_corps + ',';
            address = address + this.formData.address_apartment;

            this.formData.address = address;
            this.submitData();
        }
    },
    computed: {
        ...mapGetters('Settlements', ['settlements']),
        ...mapGetters('HouseholdTypes', ['householdTypes']),
        addressIsFilled() {
            return  (this.formData.address_street_type !== '') &&
                    (this.formData.address_street_name !== '') &&
                    (this.formData.address_house);
        }
    },
    created() {
        var vm = this;
        this.excludeFiledsFromCreateWatch.forEach(function(f) {
            let field = `formData.${f}`
            vm.$watch(field, function() {
                if (this.errors['address']) delete this.errors['address'];
            });
        });
    },
    components: {
        ModalForm
    }
}
</script>

<style lang="scss" scoped>
.address-label {
    font-size: 0.8rem;
    color: #212529a1;
}
</style>
