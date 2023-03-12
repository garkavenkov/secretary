<template>

    <ModalForm formId="HouseholdMemberForm" @submitData="saveData" @closeForm="clearFormData" modalClass="modal-lg">

        <div class="row mb-3">
            <div class="col">
                <label  for="memberSurname" class="form-label">Прізвище</label>
                <input  type="text"
                        id="memberSurname"
                        :class="['form-control', hasError('surname') ? 'is-invalid' : '']"
                        v-model="formData.surname" >
                <div id="memberSurnameValidation" class="invalid-feedback">
                    {{ getError('surname') }}
                </div>
            </div>
            <div class="col">
                <label  for="memberName" class="form-label">Ім'я</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="memberName"
                        v-model="formData.name">
                <div id="memberNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
            <div class="col">
                <label  for="memberPatronymic" class="form-label">По батькові</label>
                <input  type="text"
                        :class="['form-control', hasError('patronymic') ? 'is-invalid' : '']"
                        id="memberPatronymic"
                        v-model="formData.patronymic">
                <div id="memberPatronymicValidation" class="invalid-feedback">
                    {{ getError('patronymic') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <label  for="memberSex" class="form-label">Стать</label>
                <input  list="sex"
                        id="memberSex"
                        placeholder="Type to search..."
                        :class="['form-control', hasError('sex') ? 'is-invalid' : '']"
                        v-model="formData.sex">
                <datalist id="sex">
                    <option value="чоловіча" />
                    <option value="жіноча" />
                </datalist>
                <div id="memberSexValidation" class="invalid-feedback">
                    {{ getError('sex') }}
                </div>
            </div>
            <div class="col-md-3">
                <label  for="memberBirthdate" class="form-label">Дата народження</label>
                <input  type="date"
                        :class="['form-control', hasError('birthdate') ? 'is-invalid' : '']"
                        id="memberBirthdate"
                        v-model="formData.birthdate">
                <div id="memberBirthdateValidation" class="invalid-feedback">
                    {{ getError('birthdate') }}
                </div>
            </div>
            <div class="col-md-6">
                <label for="familyRelationshipType" class="form-label">Родинні стосунки</label>
                <select :class="['form-control', hasError('family_relationship_type_id') ? 'is-invalid' : '']"
                        v-model="formData.family_relationship_type_id">
                    <option disabled value="0">Оберить тип родинних стосунків</option>
                    <option :value="relationship.id" v-for="relationship in relationshipTypes" :key="relationship.id">
                        {{relationship.name}}
                    </option>
                </select>
                <div id="familyRelationshipTypeValidation" class="invalid-feedback">
                    {{ getError('family_relationship_type_id') }}
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col">
                <label for="workPlace" class="form-label">Місце роботи залежно від територіального розташування</label>
                <select class="form-select" id="workPlace" aria-label="Default select example" v-model="formData.work_place_id">
                    <option disabled value="0">Оберить місце роботи</option>
                    <option :value="place.id" v-for="place in places" :key="place.id">
                        {{place.name}}
                    </option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="memberEmployment" class="form-label">Відомості про зайнятість / незайнятість</label>
                <textarea class="form-control" id="memberEmployment" rows="2" v-model="formData.employment_information"></textarea>
            </div>
        </div>

    </ModalForm>

</template>

<script>

import { mapGetters } from 'vuex';

import ModalForm        from '../../../components/ui/ModalForm.vue';

import FormValidator    from '../../../mixins/FormValidator';
import SubmitData       from '../../../mixins/SubmitData';

export default {
    name: 'HouseholdMemeberForm',
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
            apiUrl: '/api/v1/household-members',
        }
    },
    methods: {
        clearFormData() {
                this.formData.surname = '';
                this.formData.name = '';
                this.formData.patronymic = '';
                this.formData.sex = '';
                this.formData.birthdate = null;
                this.formData.family_relationship_type_id = 0;
                this.formData.employment_information = '';
                this.formData.work_place_id = 0;

                this.errors = [];
        },
        saveData() {
            if (this.formData.work_place_id == 0) {
                delete this.formData.work_place_id;
            }
            this.submitData();
        },
    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes':'types'}),
        ...mapGetters('WorkPlaces', ['places']),
    },
    components: {
        ModalForm,
    }
}
</script>
