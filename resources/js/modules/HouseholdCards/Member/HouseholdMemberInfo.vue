<template>

    <ModalForm formId="HouseholdMemberInfo" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-fullscreen" :showFooter="false">
        <template v-slot:modalHeader>
            <button class="btn btn-sm btn-light ms-3" title="Редагувати" @click="isInEditMode = true" v-if="!isInEditMode" >
                <!-- <i class="bi bi-pencil"></i> -->
                <!-- <span class="mdi mdi-pencil"></span> -->
                <span class="mdi mdi-account-edit"></span>
            </button>
            <button class="btn btn-sm btn-outline-secondary ms-3" title="Відмінити редагування" @click="cancelEdit" v-else>
                <!-- <i class="bi bi-x-lg"></i> -->
                <span class="mdi mdi-account-cancel"></span>
            </button>
            <button class="btn btn-sm btn-outline-success ms-3" title="Зберегти редагування" v-if="isInEditMode" @click="submitData" :disabled="!readyForSave">
                <!-- <i class="bi bi-save2"></i> -->
                <span class="mdi mdi-account-check-outline"></span>
            </button>
        </template>
        <!-- <div class="row"> -->
            <div class="col-10 mx-auto h-100">
                <div class="row h-100">
                    <div class="col-4 border-end">
                        <div class="mb-3">
                            <label  for="memberSurname" class="form-label">Прізвище</label>
                            <input  type="text"
                                    id="memberSurname"
                                    :class="['form-control', hasError('surname') ? 'is-invalid' : '']"
                                    v-model="_form.surname"
                                    :disabled="!isInEditMode">
                            <div id="memberSurnameValidation" class="invalid-feedback">
                                {{ getError('surname') }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label  for="memberName" class="form-label">Ім'я</label>
                                <input  type="text"
                                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                                        id="memberName"
                                        v-model="_form.name"
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
                                        v-model="_form.patronymic"
                                        :disabled="!isInEditMode">
                                <div id="memberPatronymicValidation" class="invalid-feedback">
                                    {{ getError('patronymic') }}
                                </div>
                            </div>
                        </div>
                        <!-- <div class="mb-3">
                        </div> -->
                        <div class="row mb-3">
                            <div class="col">
                                <label  for="memberBirthday" class="form-label">Дата народження</label>
                                <input  type="date"
                                        :class="['form-control', hasError('birthday') ? 'is-invalid' : '']"
                                        id="memberBirthday"
                                        v-model="_form.birthday"
                                        :disabled="!isInEditMode">
                                <div id="memberBirthdayValidation" class="invalid-feedback">
                                    {{ getError('birthday') }}
                                </div>
                            </div>
                            <div class="col">
                                <label  for="memberSex" class="form-label">Стать</label>
                                <input  list="sex"
                                        id="memberSex"
                                        placeholder="Type to search..."
                                        :class="['form-control', hasError('sex') ? 'is-invalid' : '']"
                                        v-model="_form.sex"
                                        :disabled="!isInEditMode">
                                <datalist id="sex">
                                    <option value="чоловіча" />
                                    <option value="жіноча" />
                                </datalist>
                                <div id="memberSexValidation" class="invalid-feedback">
                                    {{ getError('sex') }}
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="familyRelationship" class="form-label">Родинні стосунки</label>
                                <select :class="['form-control', hasError('family_relationship_id') ? 'is-invalid' : '']"
                                        aria-label="Default select example"
                                        v-model="_form.family_relationship_id"
                                        :disabled="!isInEditMode">
                                    <option disabled value="0">Оберить тип родинних стосунків</option>
                                    <option :value="relationship.id" v-for="relationship in relationships" :key="relationship.id">
                                        {{relationship.name}}
                                    </option>
                                </select>
                                <div id="familyRelationshipValidation" class="invalid-feedback">
                                    {{ getError('family_relationship_id') }}
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
                                        v-model="_form.social_information"
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
                                        v-model="_form.additional_information"
                                        :disabled="!isInEditMode">
                                </textarea>
                                <div id="additionalInformationValidation" class="invalid-feedback">
                                    {{ getError('additional_information') }}
                                </div>
                            </div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Місце роботи залежно від територіального розташування</label>
                            <select class="form-select" aria-label="Default select example" v-model="_form.workPlace">
                                <option disabled value="0">Оберить місце роботи</option>
                                <option :value="place.id" v-for="place in places" :key="place.id">
                                    {{place.name}}
                                </option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlTextarea1" class="form-label">Відомості про зайнятість / незайнятість</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="_form.employment"></textarea>
                        </div> -->
                       <div class="row">
                            <div class="col">
                                <label  for="memberDeathDate" class="form-label">Дата смерті</label>
                                <input  type="date"
                                        id="memberDeathDate"
                                        :class="['form-control', hasError('death_date') ? 'is-invalid' : '']"
                                        v-model="_form.death_date"
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
                                        v-model="_form.death_register_number"
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
                                       v-model="_form.death_register_office"
                                       :disabled="!isInEditMode">
                               <div id="memberDeathPlaceValidation" class="invalid-feedback">
                                   {{ getError('death_register_office') }}
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="col-8">
                    <!-- <div class="col"> -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <!-- <li class="nav-item" role="presentation">
                                <button class="nav-link active"
                                        id="main-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#main-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="main-tab-pane"
                                        aria-selected="true">
                                    Головна
                                </button>
                            </li> -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active"
                                        id="work-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#work-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="work-tab-pane"
                                        aria-selected="true">
                                    <span class="mdi mdi-account-hard-hat-outline me-1"></span>
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
                                    <span class="mdi mdi-land-fields me-1"></span>
                                    Земля
                                </button>
                            </li>
                            <!-- <li class="nav-item" role="presentation">
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
                            </li> -->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link"
                                        id="movement-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#movement-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="movement-tab-pane"
                                        aria-selected="false">
                                    <span class="mdi mdi-transit-transfer me-1"></span>
                                    Реєстрація / Переміщення
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content p-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="work-tab-pane" role="tabpanel" aria-labelledby="work-tab" tabindex="0">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="workPlace" class="form-label">Місце роботи залежно від територіального розташування</label>
                                        <select
                                                :class="['form-select', hasError('work_place_id') ? 'is-invalid' : '']"
                                                v-model="_form.work_place_id"
                                                :disabled="!isInEditMode">
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
                                                v-model="_form.employment_information"
                                                :disabled="isEmploymentInformationDisabled">
                                        </textarea>
                                        <div id="employmentInformationValidation" class="invalid-feedback">
                                            {{ getError('employment_information') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="land-tab-pane" role="tabpanel" aria-labelledby="land-tab" tabindex="0">
                                <div class="row mb-3">
                                    <h5>Наявність земельної ділянки</h5>
                                    <div class="col">
                                        <label for="landOwned" class="form-label">у власності</label>
                                        <input  type="text"
                                                :class="['form-control', hasError('land_owned') ? 'is-invalid' : '']"
                                                id="landOwned"
                                                v-model="_form.land_owned"
                                                :disabled="!isInEditMode" />
                                        <div id="landOwnedValidation" class="invalid-feedback">
                                            {{ getError('land_owned') }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label  for="landRented" class="form-label">взято в оренду</label>
                                        <input  type="text"
                                                :class="['form-control', hasError('land_rented') ? 'is-invalid' : '']"
                                                id="landRented"
                                                v-model="_form.land_rented"
                                                :disabled="!isInEditMode" />
                                        <div id="landRentedValidation" class="invalid-feedback">
                                            {{ getError('land_rented') }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="landLeased" class="form-label">знадо в оренду</label>
                                        <input  type="text"
                                                :class="['form-control', hasError('land_leased') ? 'is-invalid' : '']"
                                                id="landLeased"
                                                v-model="_form.land_leased"
                                                :disabled="!isInEditMode" />
                                        <div id="landLeasedValidation" class="invalid-feedback">
                                            {{ getError('land_leased') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="tab-pane fade" id="peasant-economy-tab-pane" role="tabpanel" aria-labelledby="peasant-economy-tab" tabindex="0">
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">у власності</label>
                                        <input  type="email"
                                                class="form-control"
                                                id="exampleFormControlInput1"
                                                v-model="_form.surname"
                                                :disabled="!isInEditMode" />
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">взято в оренду</label>
                                        <input  type="email"
                                                class="form-control"
                                                id="exampleFormControlInput1"
                                                v-model="_form.name"
                                                :disabled="!isInEditMode" />
                                    </div>
                                    <div class="col">
                                        <label  for="exampleFormControlInput1" class="form-label">знадо в оренду</label>
                                        <input  type="email"
                                                class="form-control"
                                                id="exampleFormControlInput1"
                                                v-model="_form.patronymic"
                                                :disabled="!isInEditMode" />
                                    </div>
                                </div>
                            </div> -->

                            <div class="tab-pane fade" id="movement-tab-pane" role="tabpanel" aria-labelledby="movement-tab" tabindex="0">
                                <div>
                                    <div class="mb-3">
                                        <button class="btn btn-sm btn-outline-primary"
                                                title="Додати подію"
                                                @click="showMovementEventForm"
                                                v-if="!movementEventFormIsVisible">
                                            <span class="mdi mdi-calendar me-1"></span>
                                            Додати подію
                                        </button>
                                    </div>
                                    <div v-if="movementEventFormIsVisible">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="movementEventType" class="form-label">Подія</label>
                                                <select :class="['form-control', hasError('movement_type_id') ? 'is-invalid' : '']"
                                                        v-model="eventForm.movement_type_id">
                                                    <option disabled value="0">Оберить подію</option>
                                                    <option :value="movementType.id" v-for="movementType in movementTypes" :key="movementType.id">
                                                        {{movementType.name}}
                                                    </option>
                                                </select>
                                                <div id="movementEventValidation" class="invalid-feedback">
                                                    {{ getError('movement_type_id') }}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label  for="movementEventDate" class="form-label">Дата</label>
                                                <input  type="date"
                                                        :class="['form-control', hasError('date') ? 'is-invalid' : '']"
                                                        id="movementEvent"
                                                        v-model="eventForm.date">
                                                <div id="movementEventValidation" class="invalid-feedback">
                                                    {{ getError('date') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label  for="movementEventComment" class="form-label">Примітка</label>
                                                <input  type="text"
                                                        :class="['form-control', hasError('comment') ? 'is-invalid' : '']"
                                                        id="movementEventComment"
                                                        v-model="eventForm.comment" />
                                                <div id="movementEventCommentValidation" class="invalid-feedback">
                                                    {{ getError('comment') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-sm btn-outline-secondary me-4"
                                                        :title="movementAction == 'create' ? 'Відмінити додовання події' : 'Відмінити редагування події'"
                                                        @click="closeMovementEventForm">
                                                    <span class="mdi mdi-cancel me-1"></span>
                                                    Відмінити
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary"
                                                        :title="movementAction == 'create' ? 'Додати подію' : 'Зберегти зміни'"
                                                        @click="submitMovementEventForm">
                                                    <span class="mdi mdi-calendar-check me-1"></span>
                                                    {{ movementEventSubmitButtonTitle }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <template v-if="_form.movements?.length">
                                        <table class="table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Дата</th>
                                                    <th>Подія</th>
                                                    <th>Коментар</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(event, index) in _form.movements" :key="index">
                                                    <td>{{ formatedDate(event.date)}}</td>
                                                    <td>{{ event.movement_type.name }}</td>
                                                    <td>{{ event.comment }}</td>
                                                    <td class="text-end">
                                                        <button class="btn btn-sm btn-outline-warning me-3"
                                                                title="Редагувати подію"
                                                                @click="editMovementEvent(event)"
                                                                :disabled="movementEventFormIsVisible">
                                                            <span class="mdi mdi-pencil"></span>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-danger"
                                                                title="Видалити подію"
                                                                @click="deleteMovementEvent(event.id)"
                                                                :disabled="movementEventFormIsVisible">
                                                            <span class="mdi mdi-trash-can-outline"></span>
                                                        </button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </template>
                                    <template v-else>
                                        <div class="text-center text-muted">
                                            Інформація відсутня
                                        </div>
                                    </template>
                                    <!-- <Timeline :events="movements" /> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div> -->

    </ModalForm>

</template>

<script>
import { mapGetters } from 'vuex';

import ModalForm from '../../../components/ui/ModalForm.vue';
import FormValidator from '../../../minixs/FormValidator';
import DateFormat from '../../../minixs/DateFormat';
// import Timeline from '../../components/ui/Timeline.vue';
export default {
    name: 'HouseholdMemberInfo',
    mixins: [FormValidator, DateFormat],
    props: {
        'formData': {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            movementTypes: [],
            isInEditMode: false,
            _form: {},
            movementEventFormIsVisible: false,
            eventForm: {
                member_id: null,
                date: null,
                movement_type_id: 0,
                comment: ''
            },
            movementAction: '',
            movementEventCancelButtonTitle: '',
            movementEventSubmitButtonTitle: '',
        }
    },
    methods: {
        submitData() {
            // console.log('Submit Form');
            let form = Object.assign({}, this._form);
            if (form.work_place_id == 0) {
                delete form.work_place_id;
            }
            if (form.death_date == '') {
                form.death_date = null;
            }
            axios.patch(`/api/v1/household-members/${form.id}`, form)
                .then(res => {
                    this.$store.dispatch('Households/fetchRecord', form.household_id);
                    this.$emit('refreshData', form.id);
                    this.errors = [];
                    this.$nextTick(function() {
                        this._form = {...this._form};
                    })
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
        cancelEdit() {
            this.isInEditMode = false;
            this.errors = [];
            this._form = Object.assign({}, this.formData);
        },
        clearFormData() {
            this.$emit('closeForm');
            this.isInEditMode = false;
        },
        showMovementEventForm() {
            this.movementEventFormIsVisible = true;
            this.movementAction = 'create';
            this.movementEventSubmitButtonTitle = 'Додати';
        },
        editMovementEvent(event) {
            Object.assign(this.eventForm, event);
            this.movementEventFormIsVisible = true;
            this.movementAction = 'update';
            this.movementEventSubmitButtonTitle = 'Зберегти';
        },
        clearMovementEventForm() {
            this.eventForm.date = null;
            this.eventForm.movement_type_id = 0;
            this.eventForm.comment = '';
        },
        closeMovementEventForm() {
            this.movementEventFormIsVisible = false;
            if (this.errors['date'])
                delete this.errors['date'];
            if (this.errors['movement_type_id'])
                delete this.errors['movement_type_id'];
            if (this.errors['comment'])
                delete this.errors['comment'];
            this.clearMovementEventForm();
        },
        submitMovementEventForm() {
            this.eventForm.member_id = this.formData.id;
            if (this.movementAction == 'create') {
                axios.post('/api/v1/household-member-movements', this.eventForm)
                    .then(res => {
                        axios.get(`/api/v1/household-members/${this._form.id}`)
                            .then(res => {
                                this.$store.dispatch('Households/fetchRecord', this._form.household_id);
                                this.$emit('refreshData', this._form.id);
                                Object.assign(this._form, res.data.data);
                                this.clearMovementEventForm();
                            })
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.movementAction = 'update') {
                axios.patch(`/api/v1/household-member-movements/${this.eventForm.id}`, this.eventForm)
                    .then(res => {
                        axios.get(`/api/v1/household-members/${this._form.id}`)
                            .then(res => {
                                this.$store.dispatch('Households/fetchRecord', this._form.household_id);
                                this.$emit('refreshData', this._form.id);
                                Object.assign(this._form, res.data.data);
                                // this.clearMovementEventForm();
                            })
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        deleteMovementEvent(id) {
            axios.delete(`/api/v1/household-member-movements/${id}`)
                .then(res => {
                    axios.get(`/api/v1/household-members/${this._form.id}`)
                        .then(res => {
                                this.$store.dispatch('Households/fetchRecord', this._form.household_id);
                                this.$emit('refreshData', this._form.id);
                                Object.assign(this._form, res.data.data);
                        })
                })
        }
    },
    computed: {
        ...mapGetters('FamilyRelationships', ['relationships']),
        ...mapGetters('WorkPlaces', ['places']),
        readyForSave() {
            return JSON.stringify(this.formData) !== JSON.stringify(this._form);
        },
        isEmploymentInformationDisabled() {
            if (this.isInEditMode) {
                if (this._form.work_place_id > 0) {
                    return false;
                }
            }
            return true;
        }
    },
    mounted() {
       this.$nextTick(function() {
            this._form = {...this.formData}
       })
    },
    created() {
        axios.get('/api/v1/movement-types')
            .then(res => {
                this.movementTypes = res.data.data;
            })
    },
    watch: {
        '_form.death_date' (newVal) {
            if (newVal == "") {
                this._form.death_date = null;
                this._form.death_register_number = '';
                if (this.errors['death_register_number'])
                    delete this.errors['death_register_number'];

                this._form.death_register_office = '';
                if (this.errors['death_register_office'])
                    delete this.errors['death_register_office'];
            }
        }
    },
    components: {
        ModalForm,
        // Timeline
    }
}
</script>
