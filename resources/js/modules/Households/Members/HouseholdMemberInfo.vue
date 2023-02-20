<template>

    <ModalForm formId="HouseholdMemberInfo" @submitData="submitData" @closeForm="closeForm" modalClass="modal-fullscreen" :showFooter="false">
        <template v-slot:modalHeader>
            <button v-if="!isInEditMode"
                    class="btn btn-sm btn-light ms-3"
                    title="Редагувати"
                    @click="isInEditMode = true">
                <span class="mdi mdi-account-edit"></span>
            </button>
            <button v-else
                    class="btn btn-sm btn-outline-secondary ms-3"
                    title="Відмінити редагування"
                    @click="cancelEdit">
                <span class="mdi mdi-account-cancel"></span>
            </button>
            <button v-if="isInEditMode"
                    class="btn btn-sm btn-outline-success ms-3"
                    title="Зберегти редагування"
                    @click="submitData"
                    :disabled="!readyForSave">
                <span class="mdi mdi-account-check-outline"></span>
            </button>
        </template>

        <div class="col-10 mx-auto h-100">
            <div class="row h-100">
                <div class="col-4 border-end">
                    <div class="mb-2">
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
                    <div class="row mb-2">
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
                    <div class="row mb-2">
                        <div class="col">
                            <label  for="memberBirthdate" class="form-label">Дата народження</label>
                            <input  type="date"
                                    :class="['form-control', hasError('birthdate') ? 'is-invalid' : '']"
                                    id="memberBirthdate"
                                    v-model="_form.birthdate"
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
                    <div class="row mb-2">
                        <div class="col">
                            <label for="familyRelationshipType" class="form-label">Родинні стосунки</label>
                            <select :class="['form-control', hasError('family_relationship_type_id') ? 'is-invalid' : '']"
                                    aria-label="Default select example"
                                    v-model="_form.family_relationship_type_id"
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
                    <!-- <div class="row mb-1">
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
                    </div> -->
                    <div class="row mb-2">
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
                    <div class="row mb-2">
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
                   <div class="row mb-2">
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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                        <li class="nav-item" role="presentation">
                            <button class="nav-link"
                                    id="additional-param-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#additional-param-tab-pane"
                                    type="button"
                                    role="tab"
                                    aria-controls="additional-param-tab-pane"
                                    aria-selected="false">
                                <span class="mdi mdi-tag-multiple me-1"></span>
                                Додаткова параметри
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
                            <table class="table table-sm  table-bordered table-years" v-if="_form.land">
                                <thead>
                                    <tr>
                                        <th>
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-secondary btn-transparent"
                                                    @click="newYearData">
                                                <span class="mdi mdi-plus-thick"></span>
                                                Додати рік
                                            </button>
                                        </th>
                                        <th v-for="year in _form.land.sort((a, b) => a.year - b.year)"
                                            :key="year.year">
                                            {{year.year}}
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light btn-transparent"
                                                        type="button"
                                                        data-bs-toggle="dropdown"
                                                        aria-expanded="false"
                                                        title="Операції з даними за рік">
                                                    <span class="mdi mdi-cog"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item" @click="landOwnedReport(year)">
                                                            <span class="mdi mdi-pencil text-warning me-2"></span>
                                                            Звіт про склад земельної ділянки
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" @click="editYear(year)">
                                                            <span class="mdi mdi-pencil text-warning me-2"></span>
                                                            Редагувати дані
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" @click="deleteYear(year)">
                                                            <span class="mdi mdi-trash-can text-danger me-2"></span>
                                                            Видалити дані
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <TableRow   :years="_form.land"
                                                field="total"
                                                rowTitle="<b>Площа земельних ділянок - усього</b>" />
                                    <TableRow   :years="_form.land"
                                                field="maintenance"
                                                rowTitle="під забудовою"
                                                rowTitleClass="ps-3"/>
                                    <TableRow   :years="_form.land"
                                                field="personal_agriculture"
                                                rowTitle="для ведення  <abbr title='особистого селянського господарства'>ОСГ</abbr>"
                                                rowTitleClass="ps-3"/>
                                    <TableRow   :years="_form.land"
                                                field="hay_cutting"
                                                rowTitle="сінокосіння"
                                                rowTitleClass="ps-3"/>
                                    <TableRow   :years="_form.land"
                                                field="pastures"
                                                rowTitle="пасовища"
                                                rowTitleClass="ps-3"/>
                                    <TableRow   :years="_form.land"
                                                field="land_share"
                                                rowTitle="земельний пай"
                                                rowTitleClass="ps-3"/>
                                    <TableRow   :years="_form.land"
                                                field="property_share"
                                                rowTitle="майновий пай"
                                                rowTitleClass="ps-3"/>
                                </tbody>
                            </table>
                        </div>
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
                            </div>
                        </div>
                        <div class="tab-pane fade" id="additional-param-tab-pane" role="tabpanel" aria-labelledby="additional-param-tab" tabindex="0">
                            <div v-if="(_form.additional_params) ?? (_form.additional_params.length > 0)">
                                <div class="row">
                                    <div class="col-md-10 mx-auto">
                                        <table class="table table-sm">
                                            <tbody>
                                                <tr v-for="param in _form.additional_params" :key="param.id" class="align-middle">
                                                    <td>
                                                        <label :for="param.code" :style="[isInEditMode ? 'cursor: pointer;' : '']">
                                                            {{ param.name }}
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <template v-if="param.value_type_code == 'boolean'">
                                                            <div class="form-check form-switch">
                                                                <input  class="form-check-input"
                                                                        type="checkbox"
                                                                        role="switch"
                                                                        :disabled="!isInEditMode"
                                                                        :id="param.code"
                                                                        v-model="param.value">
                                                            </div>
                                                        </template>
                                                        <template v-else>
                                                            <input  type="text"
                                                                    class="form-control form-control-sm"
                                                                    :id="param.code"
                                                                    :disabled="!isInEditMode"
                                                                    v-model="param.value">
                                                        </template>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-end pt-2">
                                            <button class="btn btn-sm btn-outline-primary"
                                                    title="Встановити додаткові параметри"
                                                    @click="updateAdditionalParams"
                                                    :disabled="!additionalParamsWereChanged">
                                                <span class="mdi mdi-check-all"></span>
                                                Встановити
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </ModalForm>

    <LandYearForm
            :formData="yearData"
            :title="title"
            :submitCaption="submitCaption"
            :action="yearDataAction"
            @closeYearForm="closeYearForm"
            @refreshData="refreshData"/>

</template>

<script>
import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap';


import ModalForm        from '../../../components/ui/ModalForm.vue';
import TableRow         from '../../../components/ui/TableRow.vue';

import FormValidator    from '../../../minixs/FormValidator';
import DateFormat       from '../../../minixs/DateFormat';

import LandYearForm     from './LandYearForm.vue';

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
            _form: {
                additional_params: [],
                land: [],
                movements: []
            },
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
            additionalParamData: {},
            yearData: {
                id: null,
                member_id: null,
                year: new Date().getFullYear(),
                maintenance: 0,
                personal_agriculture: 0,
                hay_cutting: 0,
                pastures: 0,
                land_share: 0,
                property_share: 0
            },
            yearDataAction: '',
            title: '',
            submitCaption: '',
        }
    },
    // provide() {
    //     return {
    //         modalTitle: computed(() => this.modalTitle),
    //         modalSubmitCaption: computed(() => this.modalSubmitCaption),
    //     }
    // },
    methods: {
        submitData() {
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
                    this.$emit('refreshData', _form.id);
                    this.errors = [];
                    this.$nextTick(function() {
                        this._form = {...this._form};
                    })
                    this.$toast(res.data.message);
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
        closeForm() {
            this.$emit('closeMemberInfoForm');
            this.isInEditMode = false;
            this.errors = [];
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
                                this._form = JSON.parse(JSON.stringify(res.data.data));
                                // Object.assign(this._form, res.data.data);
                                // this.clearMovementEventForm();
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
                                this._form = JSON.parse(JSON.stringify(res.data.data));
                                // Object.assign(this._form, res.data.data);
                            })
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        deleteMovementEvent(id) {
            this.$confirmDelete('Ви дійсно бажаєте видалити інформацію о реєстрації / переміщенні')
                .then(res => {
                    if (res.isConfirmed) {

                        axios.delete(`/api/v1/household-member-movements/${id}`)
                            .then(res => {
                                axios.get(`/api/v1/household-members/${this._form.id}`)
                                    .then(res => {
                                            this.$store.dispatch('Households/fetchRecord', this._form.household_id);
                                            this.$emit('refreshData', this._form.id);
                                            this._form = JSON.parse(JSON.stringify(res.data.data));
                                    })
                            })
                    }
                })
        },
        updateAdditionalParams() {
            var vm = this;
            let changed_params = this._form.additional_params.filter(function(element, index) {
                return element.value !== vm.formData.additional_params[index].value;
            });

            if (changed_params.length > 0) {
                changed_params.forEach(p => {
                    this.additionalParamData[p.code] = p.value;
                });

                this.additionalParamData['owner_id'] = this._form?.id;
                axios.post('/api/v1/member-additional-params', this.additionalParamData)
                    .then(res => {
                        this.$toast(res.data.message);
                        axios.get(`/api/v1/household-members/${this._form.id}`)
                            .then(res => {
                                this.$store.dispatch('Households/fetchRecord', this._form.household_id);
                                this.$emit('refreshData', this._form.id);
                                this._form = JSON.parse(JSON.stringify(res.data.data));
                            });
                    });
            }
        },
        newYearData() {
            this.title = 'Додати інформацію про землю';
            this.submitCaption = 'Додати';
            this.yearDataAction = 'create';

            this.yearData.member_id = this.formData.id;

            let landYearForm = new Modal(document.getElementById('LandYearForm'))
            landYearForm.show();
        },
        editYear(year) {
            Object.assign(this.yearData, year);
            this.yearData.member_id = this.formData.id;

            this.title = `Редагувати дані за ${year.year} рік`;
            this.submitCaption = 'Зберегти';
            this.yearDataAction = 'update';

            var landYearForm = new Modal(document.getElementById('LandYearForm'))
            landYearForm.show()
        },
        deleteYear(year) {
        },
        refreshData() {
            // console.log('Refresh data after LandYearForm data was changed');
            // this.$emit('refreshData', this.formData.id);
            axios.get(`/api/v1/household-members/${this._form.id}`)
                .then(res => {
                    // this.$store.dispatch('Households/fetchRecord', this._form.household_id); ???
                    this.$emit('refreshData', this._form.id);
                    this._form = JSON.parse(JSON.stringify(res.data.data));
                });
            // this.$nextTick(function() {
            // this._form = JSON.parse(JSON.stringify(this.formData));
            //     // Object.assign({},this.formData
            // });
        },
        closeYearForm() {
            this.yearData.id = null;
            this.yearData.year = new Date().getFullYear();
            this.yearData.maintenance = 0;
            this.yearData.personal_agriculture = 0;
            this.yearData.hay_cutting = 0;
            this.yearData.pastures = 0;
            this.yearData.land_share = 0;
            this.yearData.property_shar = 0;

        },
        landOwnedReport({year, member_id}) {
            let data = {
                report: 'landOwned',
                year: year,
                member_id: member_id
            }

            axios.post('/api/v1/generate-report', data,    { responseType: 'arraybuffer'} )
                .then(res => {

                    const url = window.URL.createObjectURL(new Blob([res.data]));
                    const link = document.createElement('a');

                    link.href = url;
                    // let member = this.members.find(m => m.id == this.memberId);
                    // let fileName = `${member.surname} ${member.name} ${member.patronymic}. Довідка про склад земельної ділянки.docx`;
                    let fileName = 'Довідка про склад земельної ділянки.docx';
                    // link.setAttribute('download', "Довідка про стан родини.docx"); // set custom file name
                    link.setAttribute('download', fileName);
                    document.body.appendChild(link);

                    link.click();
                })
        }
    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes': 'types'}),
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
        },
        additionalParamsWereChanged() {
            var vm = this;
            // return this._form.additional_params.every(function(element, index) {
            //     return element.param_value == vm.formData.additional_params[index].param_name;
            // });
            return JSON.stringify(this.formData.additional_params) !== JSON.stringify(this._form.additional_params);
        }
    },
    mounted() {
       this.$nextTick(function() {
            this._form = JSON.parse(JSON.stringify(this.formData));
            // Object.assign({},this.formData
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
        LandYearForm,
        TableRow
    }
}
</script>
