<template>

    <ModalForm formId="HouseholdMemberInfo" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-fullscreen">

        <!-- <div class="row"> -->
            <div class="col-10 mx-auto h-100">
                <div class="row h-100">
                    <div class="col-4 border-end">
                        <div class="mb-3">
                            <label  for="memberSurname" class="form-label">Прізвище</label>
                            <input  type="text"
                                    id="memberSurname"
                                    :class="['form-control', hasError('surname') ? 'is-invalid' : '']"
                                    v-model="formData.surname" >
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
                        <!-- <div class="mb-3">
                        </div> -->
                        <div class="d-flex gap-3 mb-3">
                            <div class="col flex-grow-1 flex-shrink-0">
                                <label  for="memberBirthday" class="form-label">Дата народження</label>
                                <input  type="date"
                                        :class="['form-control', hasError('birthday') ? 'is-invalid' : '']"
                                        id="memberBirthday"
                                        v-model="formData.birthday">
                                <div id="memberBirthdayValidation" class="invalid-feedback">
                                    {{ getError('birthday') }}
                                </div>
                            </div>
                            <div class="col flex-grow-1 flex-shrink-0">
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
                        </div>
                        <div class="mb-3">
                            <label for="familyRelationship" class="form-label">Родинні стосунки</label>
                            <select :class="['form-control', hasError('family_relationship_id') ? 'is-invalid' : '']"
                                    aria-label="Default select example"
                                    v-model="formData.family_relationship_id">
                                <option disabled value="0">Оберить тип родинних стосунків</option>
                                <option :value="relationship.id" v-for="relationship in relationships" :key="relationship.id">
                                    {{relationship.name}}
                                </option>
                            </select>
                            <div id="familyRelationshipValidation" class="invalid-feedback">
                                {{ getError('family_relationship_id') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Відомості про пенсію, інвалідність, отримання соціальної допомоги</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.employment"></textarea>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Місце роботи залежно від територіального розташування</label>
                            <select class="form-select" aria-label="Default select example" v-model="formData.workPlace">
                                <option disabled value="0">Оберить місце роботи</option>
                                <option :value="place.id" v-for="place in places" :key="place.id">
                                    {{place.name}}
                                </option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="exampleFormControlTextarea1" class="form-label">Відомості про зайнятість / незайнятість</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.employment"></textarea>
                        </div> -->
                       <div class="row gap-3">
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
                       <div class="row mb-3">
                           <div class="col">
                               <label  for="memberDeathNumber" class="form-label">Орган</label>
                               <input  type="text"
                                       id="memberDeathPlace"
                                       :class="['form-control', hasError('death_number') ? 'is-invalid' : '']"
                                       value="21323254" >
                               <div id="memberSurnameValidation" class="invalid-feedback">
                                   {{ getError('surname') }}
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
                                        id="social-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#social-tab-pane"
                                        type="button"
                                        role="tab"
                                        aria-controls="social-tab-pane"
                                        aria-selected="false">
                                    Соціальний статус
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
                        <div class="tab-content pb-3" id="myTabContent">
                           <!-- <div class="tab-pane fade show active" id="main-tab-pane" role="tabpanel" aria-labelledby="main-tab" tabindex="0">
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
                                    <div class="col">
                                        <label  for="memberBirthday" class="form-label">Дата народження</label>
                                        <input  type="date"
                                                :class="['form-control', hasError('birthday') ? 'is-invalid' : '']"
                                                id="memberBirthday"
                                                v-model="formData.birthday">
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
                                                v-model="formData.sex">
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
                                                v-model="formData.family_relationship_id">
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
                                        <select class="form-select" aria-label="Default select example" v-model="formData.workPlace">
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
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.employment"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1" class="form-label">Відомості про пенсію, інвалідність, отримання соціальної допомоги</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.employment"></textarea>
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
                                        <select class="form-select" aria-label="Default select example" v-model="formData.workPlace">
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
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" v-model="formData.employment"></textarea>
                                    </div>
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

                            <div class="tab-pane fade" id="movement-tab-pane" role="tabpanel" aria-labelledby="movement-tab" tabindex="0">
                                <div class="mt-5 d-flex justify-content-center position-relative">
                                    <!-- <label for="exampleFormControlTextarea1" class="form-label">Додаткова інформація</label> -->
                                    <table class="table">
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

import ModalForm from '../../components/ui/ModalForm.vue';
import FormValidator from '../../minixs/FormValidator';
import Timeline from '../../components/ui/Timeline.vue';
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
            ]
        }
    },
    methods: {
        submitData() {},
        clearFormData() {}
    },
    computed: {
        ...mapGetters('FamilyRelationships', ['relationships']),
        ...mapGetters('WorkPlaces', ['places'])
    },
    components: {
        ModalForm,
        Timeline
    }
}
</script>
