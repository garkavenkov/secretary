<template>

<div class="row">
    <div class="col-md-5 border-end">
        <div class="row mb-3">
            <div class="col">
                <label  for="memberSurname" class="form-label">Прізвище</label>
                <input  type="text"
                        id="memberSurname"
                        :class="['form-control', hasError('surname') ? 'is-invalid' : '']"
                        v-model="formData.surname"
                        :disabled="!isInEditMode">
                <div id="memberSurnameValidation" class="invalid-feedback">
                    {{ getError('surname') }}
                </div>
            </div>
            <!-- <div class="col">
                <label  for="memberName" class="form-label">Ім'я</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="memberName"
                        v-model="formData.name"
                        :disabled="!isInEditMode">
                <div id="memberNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
            <div class="col">
                <label  for="memberPatronymic" class="form-label">По батькові</label>
                <input  type="text"
                        :class="['form-control', hasError('patronymic') ? 'is-invalid' : '']"
                        id="memberPatronymic"
                        v-model="formData.patronymic"
                        :disabled="!isInEditMode">
                <div id="memberPatronymicValidation" class="invalid-feedback">
                    {{ getError('patronymic') }}
                </div>
            </div> -->
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="memberName" class="form-label">Ім'я</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="memberName"
                        v-model="formData.name"
                        :disabled="!isInEditMode">
                <div id="memberNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
            <div class="col">
                <label  for="memberPatronymic" class="form-label">По батькові</label>
                <input  type="text"
                        :class="['form-control', hasError('patronymic') ? 'is-invalid' : '']"
                        id="memberPatronymic"
                        v-model="formData.patronymic"
                        :disabled="!isInEditMode">
                <div id="memberPatronymicValidation" class="invalid-feedback">
                    {{ getError('patronymic') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="memberBirthdate" class="form-label">Дата народження</label>
                <input  type="date"
                        :class="['form-control', hasError('birthdate') ? 'is-invalid' : '']"
                        id="memberBirthdate"
                        v-model="formData.birthdate"
                        :disabled="!isInEditMode">
                <div id="memberBirthdayValidation" class="invalid-feedback">
                    {{ getError('birthdate') }}
                </div>
            </div>
            <div class="col">
                <label  for="memberSex" class="form-label">Стать</label>
                <input  list="sex"
                        id="memberSex"
                        placeholder="Type to search..."
                        :class="['form-control', hasError('sex') ? 'is-invalid' : '']"
                        v-model="formData.sex"
                        :disabled="!isInEditMode">
                <datalist id="sex">
                    <option value="чоловіча" />
                    <option value="жіноча" />
                </datalist>
                <div id="memberSexValidation" class="invalid-feedback">
                    {{ getError('sex') }}
                </div>
            </div>
            <!-- <div class="col">
                <label for="familyRelationshipType" class="form-label">Родинні стосунки</label>
                <select :class="['form-control', hasError('family_relationship_type_id') ? 'is-invalid' : '']"
                        aria-label="Default select example"
                        v-model="formData.family_relationship_type_id"
                        :disabled="!isInEditMode">
                    <option disabled value="0">Оберить тип родинних стосунків</option>
                    <option :value="relationship.id" v-for="relationship in relationshipTypes" :key="relationship.id">
                        {{relationship.name}}
                    </option>
                </select>
                <div id="familyRelationshipTypeValidation" class="invalid-feedback">
                    {{ getError('family_relationship_type_id') }}
                </div>
            </div> -->
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="familyRelationshipType" class="form-label">Родинні стосунки</label>
                <select :class="['form-control', hasError('family_relationship_type_id') ? 'is-invalid' : '']"
                        aria-label="Default select example"
                        v-model="formData.family_relationship_type_id"
                        id="familyRelationshipType"
                        :disabled="!isInEditMode">
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
        <div class="row mb-3">
            <div class="col">
                <label  for="memberDeathDate" class="form-label">Дата смерті</label>
                <input  type="date"
                        id="memberDeathDate"
                        :class="['form-control', hasError('death_date') ? 'is-invalid' : '']"
                        v-model="formData.death_date"
                        :disabled="!isInEditMode">
                <div id="memberDeathDateValidation" class="invalid-feedback">
                    {{ getError('death_date') }}
                </div>
            </div>
            <div class="col">
                <label  for="memberDeathNumber" class="form-label">Номер свідоцтва</label>
                <input  type="text"
                        id="memberDeathNumber"
                        :class="['form-control', hasError('death_register_number') ? 'is-invalid' : '']"
                        v-model="formData.death_register_number"
                        :disabled="!isInEditMode">
                <div id="memberDeathNumberValidation" class="invalid-feedback">
                    {{ getError('death_register_number') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="memberDeathRegisterOffice" class="form-label">Орган</label>
                <input  type="text"
                        id="memberDeathRegisterOffice"
                        :class="['form-control', hasError('death_register_office') ? 'is-invalid' : '']"
                        v-model="formData.death_register_office"
                        :disabled="!isInEditMode">
                <div id="memberDeathPlaceValidation" class="invalid-feedback">
                    {{ getError('death_register_office') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <!-- <div class="row mb-3">
            <div class="col-md-9">
                <label  for="memberAddress" class="form-label">Адреса</label>
                <input  type="text"
                        class="form-control"
                        id="memberAddress"
                        v-model="formData.address"
                        disabled>
            </div>
            <div class="col-md-3">
                <label  for="memberHouseholdNumber" class="form-label">№ домогосподарства</label>
                <input  type="text"
                        class="form-control"
                        id="memberHouseholdNumber"
                        v-model="formData.household_number"
                        disabled>
            </div>
        </div> -->
        <div class="row mb-3">
            <div class="col">
                <label for="workPlace" class="form-label">Місце роботи залежно від територіального розташування</label>
                <select
                        :class="['form-select', hasError('work_place_id') ? 'is-invalid' : '']"
                        v-model="formData.work_place_id"
                        :disabled="!isInEditMode"
                        id="workPlace">
                    <option disabled value="0">Оберить місце роботи</option>
                    <option :value="place.id" v-for="place in places" :key="place.id">
                        {{place.name}}
                    </option>
                </select>
                <div id="workPlaceValidation" class="invalid-feedback">
                    {{ getError('work_place_id') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="employmentInformation" class="form-label">Відомості про зайнятість / незайнятість</label>
                <textarea
                        :class="['form-control', hasError('employment_information') ? 'is-invalid' : '']"
                        id="employmentInformation"
                        rows="2"
                        v-model="formData.employment_information"
                        :disabled="isEmploymentInformationDisabled">
                </textarea>
                <div id="employmentInformationValidation" class="invalid-feedback">
                    {{ getError('employment_information') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="socialInformation" class="form-label">Відомості про пенсію, інвалідність, отримання соціальної допомоги</label>
                <textarea
                        :class="['form-control', hasError('social_information') ? 'is-invalid' : '']"
                        id="socialInformation"
                        rows="2"
                        v-model="formData.social_information"
                        :disabled="!isInEditMode">
                </textarea>
                <div id="socialInformationValidation" class="invalid-feedback">
                    {{ getError('social_information') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="additionalInformation" class="form-label">Додаткова інформація</label>
                <textarea
                        :class="['form-control', hasError('additional_information') ? 'is-invalid' : '']"
                        id="additionalInformation"
                        rows="2"
                        v-model="formData.additional_information"
                        :disabled="!isInEditMode">
                </textarea>
                <div id="additionalInformationValidation" class="invalid-feedback">
                    {{ getError('additional_information') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="d-flex justify-content-between">
        <div>
            <button v-if="!isInEditMode"
                    class="btn btn-sm btn-outline-danger"
                    title="Видалити члена домогосподарства"
                    @click="deleteData">
                <span class="mdi mdi-trash-can-outline"></span>
                Видалити
            </button>
        </div>
        <div>
            <button v-if="!isInEditMode"
                    class="btn btn-sm btn-outline-secondary"
                    title="Редагувати дані"
                    @click="editData">
                <span class="mdi mdi-pencil"></span>
                Редагувати
            </button>
            <button v-if="isInEditMode"
                    class="btn btn-sm btn-outline-secondary"
                    title="Відмінити редагування"
                    @click="cancelEdit">
                <!-- <span class="mdi mdi-check-all"></span> -->
                Відмінити
            </button>
            <button v-if="isInEditMode"
                    class="btn btn-sm btn-outline-primary ms-3"
                    title="Зберегти дані"
                    @click="saveData">
                <span class="mdi mdi-check-all"></span>
                Зберегти
            </button>
        </div>
    </div>
</div>

</template>

<script>

import { mapGetters }   from 'vuex';

import FormValidator    from '../../../mixins/FormValidator';

export default {
    name: 'MemberMainInfoTab',
    mixins: [FormValidator],
    // props: {
    //     'formData': {
    //         type: Object,
    //         required: true,
    //     },
    // },
    emits: ['refreshData'],
    data() {
        return {
            isInEditMode: false,
            _formData: {},
            // formData:{} // JSON.parse(JSON.stringify(this.info)),
        }
    },
    methods: {
        editData() {
            this.isInEditMode = true;
            this._formData = JSON.parse(JSON.stringify(this.formData));

        },
        cancelEdit() {
            this.isInEditMode = false;
            this.errors = [];
            this._formData = {};
            // this.formData = Object.assign({}, this.info);
            this.$store.dispatch('HouseholdMembers/fetchRecord', this.memberId);
            // this.$emit('refreshData');
        },
        saveData() {
            let data = Object.assign({}, this.formData);
            if (data.work_place_id == 0) {
                delete data.work_place_id;
            }
            axios.patch(`/api/v1/household-members/${this.formData.id}`, data)
                .then(res => {
                    this.$toast(res.data.message);
                    this.$emit('refreshData');
                    this.$store.dispatch('Households/fetchRecord', this.formData.household_id);
                })
                .catch(err => {
                    this.errors = err.response?.data.errors;
                })
        },
        deleteData() {
            this.$confirmDelete('Ви дійсно бажаєти видалити інформацію о члені домогосподарства')
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`/api/v1/household-members/${this.formData.id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.$router.push({name: 'households.show.members', params: {id: this.formData.household_id}});
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити члена домогосподарства', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        }


    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes': 'types'}),
        ...mapGetters('WorkPlaces', ['places']),
        // ...mapGetters('HouseholdMembers', {formData: 'info', memberId: 'memberId'}),
        ...mapGetters('HouseholdMembers', {formData: 'member', memberId: 'memberId'}),
        isEmploymentInformationDisabled() {
            // console.log('Something happened');
            // this.$nextTick(() => {
                if (this.isInEditMode) {
                    if (this.formData.work_place_id > 0) {
                        return false;
                    }
                }
            // })
            return true;
        },
        readyForSave() {
            return JSON.stringify(this.formData) !== JSON.stringify(this._formData);
        },
        // deathDateIsSetted() {
        //     console.log('Death date was changed');
        //     if (this.isInEditMode) {
        //         if (this.formData.death_date === null) {
        //             return false;
        //         }
        //         return true;
        //     }
        //     return false;
        // }
    },
    created() {
        // this.formData = Object.assign({}, this.info);
    },
    watch: {
        'formData.death_date' (newVal) {
            if (newVal == "") {
                this.formData.death_date = null;
                this.formData.death_register_number = '';
                if (this.errors['death_register_number'])
                    delete this.errors['death_register_number'];

                this.formData.death_register_office = '';
                if (this.errors['death_register_office'])
                    delete this.errors['death_register_office'];
            }
        },
        'formData.work_place_id' (newVal) {
            if (newVal) console.log('WorkPlace  has been changed');
        }
    }
}

</script>
