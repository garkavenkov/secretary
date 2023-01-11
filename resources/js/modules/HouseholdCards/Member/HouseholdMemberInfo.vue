<template>

    <ModalForm formId="HouseholdMemberInfo" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-fullscreen" :showFooter="false">
        <template v-slot:modalHeader>
            <button class="btn btn-sm btn-light ms-3" title="Редагувати" @click="isInEditMode = true" v-if="!isInEditMode" >
                <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-sm btn-outline-secondary ms-3" title="Відмінити редагування" @click="cancelEdit" v-else>
                <i class="bi bi-x-lg"></i>
            </button>
            <button class="btn btn-sm btn-outline-success ms-3" title="Зберегти редагування" v-if="isInEditMode" @click="submitData" :disabled="!readyForSave">
                <i class="bi bi-save2"></i>
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
                                <label for="exampleFormControlTextarea1" class="form-label">Відомості про пенсію, інвалідність, отримання соціальної допомоги</label>
                                <textarea
                                        class="form-control"
                                        id="exampleFormControlTextarea1"
                                        rows="2"
                                        v-model="_form.employment"
                                        :disabled="!isInEditMode">
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">Додаткова інформація</label>
                                <textarea
                                        class="form-control"
                                        id="exampleFormControlTextarea1"
                                        rows="2"
                                        v-model="_form.additional"
                                        :disabled="!isInEditMode">
                                </textarea>
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
                                        id="movement-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#movement-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="movement-tab-pane"
                                        aria-selected="false">
                                    Рєестрація
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content p-3" id="myTabContent">
                           <!-- <div class="tab-pane fade show active" id="main-tab-pane" role="tabpanel" aria-labelledby="main-tab" tabindex="0">
                                <div class="row mb-3">

                                    <div class="col">
                                        <label  for="memberSurname" class="form-label">Прізвище</label>
                                        <input  type="text"
                                                id="memberSurname"
                                                :class="['form-control', hasError('surname') ? 'is-invalid' : '']"
                                                v-model="_form.surname" >
                                        <div id="memberSurnameValidation" class="invalid-feedback">
                                            {{ getError('surname') }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label  for="memberName" class="form-label">Ім'я</label>
                                        <input  type="text"
                                                :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                                                id="memberName"
                                                v-model="_form.name">
                                        <div id="memberNameValidation" class="invalid-feedback">
                                            {{ getError('name') }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label  for="memberPatronymic" class="form-label">По батькові</label>
                                        <input  type="text"
                                                :class="['form-control', hasError('patronymic') ? 'is-invalid' : '']"
                                                id="memberPatronymic"
                                                v-model="_form.patronymic">
                                        <div id="memberPatronymicValidation" class="invalid-feedback">
                                            {{ getError('patronymic') }}
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label  for="memberBirthday" class="form-label">Дата народження</label>
                                        <input  type="date"
                                                :class="['form-control', hasError('birthday') ? 'is-invalid' : '']"
                                                id="memberBirthday"
                                                v-model="_form.birthday">
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
                                                v-model="_form.sex">
                                        <datalist id="sex">
                                            <option value="чоловіча" />
                                            <option value="жіноча" />
                                        </datalist>
                                        <div id="memberSexValidation" class="invalid-feedback">
                                            {{ getError('sex') }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="familyRelationship" class="form-label">Родинні стосунки</label>
                                        <select :class="['form-control', hasError('family_relationship_id') ? 'is-invalid' : '']"
                                                aria-label="Default select example"
                                                v-model="_form.family_relationship_id">
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

                                <div class="mb-2">
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Місце роботи залежно від територіального розташування</label>
                                        <select class="form-select" aria-label="Default select example" v-model="_form.workPlace">
                                            <option disabled value="0">Оберить місце роботи</option>
                                            <option :value="place.id" v-for="place in places" :key="place.id">
                                                {{place.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Відомості про зайнятість / незайнятість</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="_form.employment"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Відомості про пенсію, інвалідність, отримання соціальної допомоги</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="_form.employment"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label  for="memberDeathDate" class="form-label">Дата сметрі</label>
                                        <input  type="date"
                                                id="memberDeathFate"
                                                :class="['form-control', hasError('death_date') ? 'is-invalid' : '']"
                                                value="02/01/2023">
                                        <div id="memberSurnameValidation" class="invalid-feedback">
                                            {{ getError('surname') }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label  for="memberDeathNumber" class="form-label">Номер свідоцтва</label>
                                        <input  type="text"
                                                id="memberDeathNumber"
                                                :class="['form-control', hasError('death_number') ? 'is-invalid' : '']"
                                                value="21323254" >
                                        <div id="memberSurnameValidation" class="invalid-feedback">
                                            {{ getError('surname') }}
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="tab-pane fade show active" id="work-tab-pane" role="tabpanel" aria-labelledby="work-tab" tabindex="0">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlInput1" class="form-label">Місце роботи залежно від територіального розташування</label>
                                        <select
                                                class="form-select"
                                                aria-label="Default select example"
                                                v-model="_form.work_place_id"
                                                :disabled="!isInEditMode">
                                            <option disabled value="0">Оберить місце роботи</option>
                                            <option :value="place.id" v-for="place in places" :key="place.id">
                                                {{place.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Відомості про зайнятість / незайнятість</label>
                                        <textarea
                                                class="form-control"
                                                id="exampleFormControlTextarea1"
                                                rows="2"
                                                v-model="_form.employment_information"
                                                :disabled="!isInEditMode">
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="land-tab-pane" role="tabpanel" aria-labelledby="land-tab" tabindex="0">
                                <div class="row mb-3">
                                    <h5>Наявність земельної ділянки</h5>
                                    <div class="col">
                                        <label for="landOwned" class="form-label">у власності</label>
                                        <input  type="text"
                                                class="form-control"
                                                id="landOwned"
                                                v-model="_form.land_owned"
                                                :disabled="!isInEditMode" />
                                    </div>
                                    <div class="col">
                                        <label  for="landRented" class="form-label">взято в оренду</label>
                                        <input  type="text"
                                                class="form-control"
                                                id="landRented"
                                                v-model="_form.land_rented"
                                                :disabled="!isInEditMode" />
                                    </div>
                                    <div class="col">
                                        <label for="landLeased" class="form-label">знадо в оренду</label>
                                        <input  type="text"
                                                class="form-control"
                                                id="landLeased"
                                                v-model="_form.land_leased"
                                                :disabled="!isInEditMode" />
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="peasant-economy-tab-pane" role="tabpanel" aria-labelledby="peasant-economy-tab" tabindex="0">
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
                            </div>

                            <div class="tab-pane fade" id="movement-tab-pane" role="tabpanel" aria-labelledby="movement-tab" tabindex="0">
                                <div>
                                    <div class="mb-2">
                                        <button class="btn btn-sm btn-outline-secondary" title="Додати подію">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                        <button class="btn btn-sm ms-3 btn-outline-secondary"
                                                :class="{'active': isHistoryShown}"
                                                title="Відобразити історію"
                                                @click="showMovementHistory">
                                            <i class="bi bi-clock-history"></i>
                                        </button>
                                    </div>
                                    <!-- <label for="exampleFormControlTextarea1" class="form-label">Додаткова інформація</label> -->
                                    <table class="table" v-if="isHistoryShown">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Дата</th>
                                                <th>Тип</th>
                                                <th>Попереднє місце реєстрації</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(event, index) in movements" :key="index">
                                                <td>{{ event.date }}</td>
                                                <td>{{ event.type }}</td>
                                                <td>{{ event.purpose }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
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
// import Timeline from '../../components/ui/Timeline.vue';
export default {
    name: 'HouseholdMemberInfo',
    mixins: [FormValidator],
    props: {
        'formData': {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            movements: [
                {
                    date: '01.01.2022',
                    type: 'return',
                    purpose: 'Повернення'
                },
                {
                    date: '01.01.2021',
                    type: 'leave',
                    purpose: 'Повне вибуття'
                },
                {
                    date: '01.01.2020',
                    type: 'register',
                    purpose: 'Реєстрація перебування'
                },
            ],
            isInEditMode: false,
            // _form: {...this.formData},
            isHistoryShown: false,
            _form: {}
        }
    },
    methods: {
        submitData() {
            // console.log('Submit Form');
            let form = Object.assign({}, this._form);
            if (form.work_place_id == 0) {
                form.work_place_id = null;
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
        showMovementHistory() {
            this.isHistoryShown = true;
        },
        cancelEdit() {
            this.isInEditMode = false;
            this.errors = [];
            this._form = Object.assign({}, this.formData);
        },
        clearFormData() {
            this.$emit('closeForm');
            this.isInEditMode = false;
        }
    },
    computed: {
        ...mapGetters('FamilyRelationships', ['relationships']),
        ...mapGetters('WorkPlaces', ['places']),
        readyForSave() {
            // console.log(JSON.stringify(this.formData));
            // console.log(JSON.stringify(this._form));
            return JSON.stringify(this.formData) !== JSON.stringify(this._form);
        },
        // _form() {
        //     return Object.assign({},this.formData)
        // }
    },
    mounted() {
       this.$nextTick(function() {
            this._form = {...this.formData}
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
