<script>
import { Modal } from 'bootstrap'
import { mapActions, mapGetters } from 'vuex'
import FormValidator from '../../minixs/FormValidator'

export default {
    name: 'HouseholdMembers',
    props: {
        'members': {
            type: Array,
            required: true
        },
        'household_id': {
            type: [String, Number],
            required: true
        }
    },
    mixins: [FormValidator],
    data() {
        return {
            formData: {
                household_id: this.household_id,
                surname: '',
                name: '',
                patronymic: '',
                sex: '',
                birthday: null,
                family_relationship_id: 0,
                employment_information: '',
                work_place_id: 0,
            },
            modalSubmitCaption: 'Додати',
            modalTitle: '',
            viewMode: 'card'
        }
    },
    methods: {
        clearFormData() {
                this.formData.surname = '';
                this.formData.name = '';
                this.formData.patronymic = '';
                this.formData.sex = '';
                this.formData.birthday = null;
                this.formData.family_relationship_id = 0;
                this.formData.employment_information = '';
                this.formData.work_place_id = 0;

                this.errors = {};
        },
        submitData() {
            if (this.formData.work_place_id == 0) {
                delete this.formData.work_place_id;
            }
            axios.post('/api/v1/household-members', this.formData)
                .then(res => {
                    this.$store.dispatch('Households/fetchHousehold', this.household_id);
                    this.clearFormData();
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
        newMember(e) {
            var myModal = new Modal(document.getElementById('HouseholdMemberModalForm'))
            this.modalTitle = 'Новий член домогосподарства';
            myModal.show();
        },
        showHouseholdMember(id) {
            axios.get(`/api/v1/household-members/${id}`)
                .then(res => {
                    var myModal = new Modal(document.getElementById('HouseholdMemberModalForm'))
                    this.modalTitle = 'Інформація о члені домогосподарства';
                    Object.assign(this.formData, res.data.data);
                    myModal.show();
                })
        },
        formatedDate(date) {
            // return new Date(date).toISOString();
            return new Date(date).toISOString().slice(0, 10).split('-').reverse().join('.');
        },
        deleteMember(id) {

            axios.delete(`/api/v1/household-members/${id}`)
                .then(res => {
                    this.$store.dispatch('Households/fetchHousehold', this.household_id);
                    this.clearFormData();
                    var myModalForm = Modal.getInstance('#HouseholdMemberModalForm');
                    myModalForm.hide();
                })
        }
    },
    computed: {
        ...mapGetters('FamilyRelationships', ['relationships']),
        ...mapGetters('WorkPlaces', ['places']),
    },
}
</script>

<template>
    <div>
        <div class="p-3 d-flex justify-content-between">
            <div>
                <button type="button" class="btn btn-sm btn-primary" @click="newMember($event)">
                    <i class="bi bi-person-add"></i>
                    новий член
                </button>
            </div>
            <div>
                <button type="button"
                        title="Режим карток"
                        class="btn btn-sm btn-outline-secondary me-2"
                        :class="{'active' : viewMode == 'card'}"
                        @click="viewMode = 'card'">
                    <i class="bi bi-person-vcard"></i>
                </button>
                <button type="button"
                        title="Режим таблиці"
                        class="btn btn-sm btn-outline-secondary"
                        :class="{'active' : viewMode == 'table'}"
                        @click="viewMode = 'table'">
                    <i class="bi bi-table"></i>
                </button>
            </div>
        </div>
        <div class="px-3 d-flex gap-3">
            <template v-if="viewMode == 'card'">
                <div class="card member" v-for="member in members" :key="member.id" @dblclick="showHouseholdMember(member.id)">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <div class="member-surname">{{member.surname}}</div>
                            <div class="member-name">{{member.name}} {{member.patronymic}}</div>
                        </div>
                        <h4 class="mt-2" v-if="member.family_relationship == 'голова домогосподарства'">
                            <i class="bi bi-person-bounding-box" title="Голова домогосподарства"></i>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-2 align-items-center family-relationship">
                            <i class="bi bi-diagram-3 me-3" style="color:blue" title="Родинні відносини"></i>
                            {{member.family_relationship}}
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <i class="bi bi-gift me-3" style="color:red" title="Дата народження"></i>
                            {{formatedDate(member.birthday)}}
                        </div>
                        <!-- <div class="member-sex">
                            <span v-if="member.sex=='чоловіча'" title="чоловік">
                                &#9794;
                            </span>
                            <span v-else title="жінка">
                                &#9792;
                            </span>
                        </div> -->
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-sm btn-outline-secondary" @click="showHouseholdMember(member.id)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
            </template>
            <template v-else>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Прізвище</th>
                            <th>Ім'я</th>
                            <th>По батькові</th>
                            <th>Дата народження</th>
                            <th>Стать</th>
                            <th>Родинні стосунки</th>
                            <th>Місце роботи</th>
                            <th>Відомості про зайнятість / незайнятість</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="member in members" :key="member.id" :class="{'table-primary' : member.family_relationship == 'голова домогосподарства'}">
                            <td>
                                <button class="btn btn-sm btn-outline-secondary"
                                        @click="showHouseholdMember(member.id)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                            <td>{{member.surname}}</td>
                            <td>{{member.name}}</td>
                            <td>{{member.patronymic}}</td>
                            <td>{{formatedDate(member.birthday)}}</td>
                            <td>{{member.sex}}</td>
                            <td>{{member.family_relationship}}</td>
                            <td>
                                <template v-if="member.work_place">
                                    {{member.work_place.name}}
                                </template>
                            </td>
                            <td>{{member.employment_information}}</td>
                        </tr>
                    </tbody>
                </table>
            </template>
        </div>
    </div>
    <!-- <div class="pt-4">
        <table class="table table-bordered table-sm">
            <tbody>
                <tr>
                    <td colspan="2">Прізвище</td>
                    <td>Петренко</td>
                    <td>Петренко</td>
                </tr>
                <tr>
                    <td colspan="2">Ім'я</td>
                    <td>Петр</td>
                    <td>Марія</td>
                </tr>
                <tr>
                    <td colspan="2">По батькові</td>
                    <td>Іванович</td>
                    <td>Степанівна</td>
                </tr>
                <tr>
                    <td colspan="2">Дата народження</td>
                    <td>15.12.1965</td>
                    <td>27.05.1969</td>
                </tr>
                <tr>
                    <td colspan="2">Стать</td>
                    <td>чоловіча</td>
                    <td>жіноча</td>
                </tr>
                <tr>
                    <td colspan="2">Родинні стосунки</td>
                    <td>голова домогосподарства</td>
                    <td>дружина</td>
                </tr>
                <tr>
                    <td colspan="2">Відомості про зайнятість / незайнятість <br> <i>(для осіб віком 15 років і старше)</i></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Місце роботи (заняття) залежно від територального розташування</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="3">Наявність <br>земельної<br>ділянки</td>
                    <td>у власності</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>взято в оренду</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>здано в оренду</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">Відмитка про<br>ведення особистого<br>селянського<br>господарстка</td>
                    <td>ведеться <br><i>(дата)</i></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>припинено<br><i>(дата)</i></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="4">
                        Відмитка про<br>тимчасову<br>відсутність<br>
                        <i>
                            (місяць, рік і причина вибуття<br>місяць, рік повернення)
                        </i>
                    </td>
                    <td>вибув</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>повернувся</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>вибув</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>повернувся</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">Відмитка про повне вибуття</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td rowspan="2">
                        Відмитка про<br>прибуття на<br>терріторію населеного<br>пункту заново
                    </td>
                    <td><small>дата реєстрації місця<br>проживання на терріторії<br>населенного пункта</small></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><small>попереднє місце<br>реєстрації проживання</small></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>-->

    <div class="modal modal-lg fade" id="HouseholdMemberModalForm" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel" v-html="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clearFormData"></button>
                </div>
                <div class="modal-body">
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
                    <!-- <div class="mb-1 row">
                        <label for="exampleFormControlInput1" class="form-label">Дата народження</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" v-model="formData.birthday">
                    </div> -->
                    <!-- <hr> -->
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
                            <label  for="memberBirthday" class="form-label">Дата народження</label>
                            <input  type="date"
                                    :class="['form-control', hasError('birthday') ? 'is-invalid' : '']"
                                    id="memberBirthday"
                                    v-model="formData.birthday">
                            <div id="memberBirthdayValidation" class="invalid-feedback">
                                {{ getError('birthday') }}
                            </div>
                        </div>
                        <div class="col-md-6">
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
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-danger" @click="deleteMember(formData.id)">Видалити</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">Відмінити</button>
                        <button type="button" class="btn btn-primary" @click="submitData">{{modalSubmitCaption}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<style lang="scss" scoped>
.member {
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;

    width: 200px;

    &:hover, &:active {
        box-shadow: 0 0 2px 3px #e7e7e7;
        transform: scale(1.05);
        transition: all 0.3s ease;
        -webkit-font-smoothing: subpixel-antialiased;
    }

    &-surname {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .family-relationship {
        height: 2rem;
    }
    // &-name {
    //     margin-bottom: 0.25rem;
    //     padding-bottom: 0.25rem;
    //     border-bottom: 1px solid #e7e7e7;
    // }
}
</style>
