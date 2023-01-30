<template>

    <ModalForm formId="HouseholdMemberForm" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-lg">
        <!-- <div class="modal-body"> -->
                    <!-- <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="memberSurname" placeholder="Прізвище" v-model="formData.surname">
                        <label for="memberSurname">Прізвище</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="memberSurname" placeholder="Ім'я" v-model="formData.name">
                        <label for="memberSurname">Ім'я</label>
                    </div>
                    <div class="form-floating mb-1">
                        <input type="email" class="form-control" id="floatingInput" v-model="formData.patronymic" placeholder="По батькові">
                        <label for="floatingInput">По батькові</label>
                    </div> -->
                    <!-- <div class="mb-1 row">
                        <label for="livingArea" class="col-sm-9 col-form-label">Дата народження</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="livingArea" v-model="formData.birthday">
                        </div>
                    </div> -->
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
                    <!-- <hr> -->
                    <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"
                                    id="work-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#work-tab-pane"
                                    type="button"
                                    role="tab"
                                    aria-controls="work-tab-pane"
                                    aria-selected="true">
                                Робота
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="land-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#land-tab-pane"
                                    type="button"
                                    role="tab"
                                    aria-controls="land-tab-pane"
                                    aria-selected="false">
                                Земля
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="peasant-economy-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#peasant-economy-tab-pane"
                                    type="button"
                                    role="tab"
                                    aria-controls="peasant-economy-tab-pane"
                                    aria-selected="false">
                                Селянське господарство
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="social-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#social-tab-pane"
                                    type="button"
                                    role="tab"
                                    aria-controls="social-tab-pane"
                                    aria-selected="false">
                                Інформація о соціальних виплатах
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="additional-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#additional-tab-pane"
                                    type="button"
                                    role="tab"
                                    aria-controls="additional-tab-pane"
                                    aria-selected="false">
                                Додаткова інформація
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="work-tab-pane" role="tabpanel" aria-labelledby="work-tab" tabindex="0">
                            <div class="mb-2">
                                <label for="exampleFormControlInput1" class="form-label">Місце роботи залежно від територіального розташування</label>
                                <select class="form-select" aria-label="Default select example" v-model="formData.workPlace">
                                    <option disabled value="0">Оберить місце роботи</option>
                                    <option :value="place.id" v-for="place in places" :key="place.id">
                                        {{place.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Відомості про зайнятість / незайнятість</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.employment"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="land-tab-pane" role="tabpanel" aria-labelledby="land-tab" tabindex="0">
                            <div class="row mb-3">
                                <label>Наявність земельної ділянки</label>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">у власності</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.surname">
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">взято в оренду</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.name">
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">знадо в оренду</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.patronymic">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="peasant-economy-tab-pane" role="tabpanel" aria-labelledby="peasant-economy-tab" tabindex="0">
                            <div class="row">
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">у власності</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.surname">
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">взято в оренду</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.name">
                                </div>
                                <div class="col">
                                    <label for="exampleFormControlInput1" class="form-label">знадо в оренду</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.patronymic">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="social-tab-pane" role="tabpanel" aria-labelledby="social-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Відомості про пенсію, інвалідність, отримання соціальної допомоги</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.employment"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="additional-tab-pane" role="tabpanel" aria-labelledby="additional-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Додаткова інформація</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.additional"></textarea>
                            </div>
                        </div>
                    </div> -->

                    <!-- <hr>
                    <div class="mb-2">
                        <label for="exampleFormControlInput1" class="form-label">Місце роботи залежно від територіального розташування</label>
                        <select class="form-select" aria-label="Default select example" v-model="formData.workPlace">
                            <option disabled value="0">Оберить місце роботи</option>
                            <option :value="place.id" v-for="place in places" :key="place.id">
                                {{place.name}}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Відомості про зайнятість / незайнятість</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="formData.employment"></textarea>
                    </div> -->
                    <!-- <hr>
                    <div class="row mb-3">
                        <label>Наявність земельної ділянки</label>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">у власності</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.surname">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">взято в оренду</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.name">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-label">знадо в оренду</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.patronymic">
                        </div>
                    </div> -->
                    <!-- <div class="form-floating">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" v-model="formData.familyRelationship">
                            <option disabled value="0">Оберить тип родинних стосунків</option>
                            <option :value="relationship.id" v-for="relationship in relationships" :key="relationship.id">
                                {{relationship.name}}
                            </option>
                        </select>
                        <label for="floatingSelect">Родинні стосунки</label>
                    </div> -->
                <!-- </div> -->
    </ModalForm>


                <!-- <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-danger" @click="deleteMember(formData.id)">Видалити</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">Відмінити</button>
                        <button type="button" class="btn btn-primary" @click="submitData">{{modalSubmitCaption}}</button>
                    </div>
                </div> -->

</template>

<script>

import { mapGetters } from 'vuex';

import ModalForm from '../../../components/ui/ModalForm.vue';
import FormValidator from '../../../minixs/FormValidator';

export default {
    name: 'HouseholdMemeberForm',
    mixins: [FormValidator],
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
        submitData() {
            if (this.formData.work_place_id == 0) {
                delete this.formData.work_place_id;
            }
            axios.post('/api/v1/household-members', this.formData)
                .then(res => {
                    // this.$store.dispatch('Households/fetchHousehold', this.household_id);
                    this.clearFormData();
                    this.$emit('refreshData');
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
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
