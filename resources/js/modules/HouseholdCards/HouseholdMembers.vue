<script>
import { Modal } from 'bootstrap'
import { mapActions, mapGetters } from 'vuex'
export default {
    name: 'HouseholdMembers',
    data() {
        return {
            members: [
                {
                    id: 1,
                    surname: 'Петренко',
                    name: 'Семен',
                    patronymic: 'Іванович',
                    sex: 'чоловіча',
                    birthday: '1956-06-12',
                    familyRelationship: 1,
                    employment: '',
                    workPlace: 0,
                    additional: ''
                },
                {
                    id: 2,
                    surname: 'Петренко',
                    name: 'Галина',
                    patronymic: 'Вісиліївна',
                    sex: 'жіноча',
                    birthday: '1960-01-20',
                    familyRelationship: 2,
                    employment: '',
                    workPlace: 0,
                    additional: ''
                }
            ],
            formData: {
                id: 0,
                surname: '',
                name: '',
                patronymic: '',
                sex: '',
                birthday: null,
                familyRelationship: 0,
                employment: '',
                workPlace: 0,
                additional: ''
            },
            modalSubmitCaption: 'Додати',
            modalTitle: '',
        }
    },
    methods: {
        clearFormData() {
                this.formData.id = 0;
                this.formData.surname = '';
                this.formData.name = '';
                this.formData.patronymic = '';
                this.formData.sex = '';
                this.formData.birthday = null;
                this.formData.familyRelationship = 0;
                this.formData.employment = '';
                this.formData.workPlace = 0;
                this.formData.additional = '';
        },
        submitData() {
            this.formData.id = this.members.length + 1;
            this.members.push(Object.assign({}, this.formData));
            this.clearFormData();
        },
        newMember(e) {
            var myModal = new Modal(document.getElementById('HouseholdMemberModalForm'))
            this.modalTitle = 'Новий член домогосподарства';
            myModal.show();
        },
        showHouseholdMember(id) {
            var myModal = new Modal(document.getElementById('HouseholdMemberModalForm'))
            this.modalTitle = 'Інформація о члені домогосподарства';
            let member = this.members.find(el => el.id == id);
            Object.assign(this.formData, member);
            myModal.show();
        }
    },
    computed: {
        ...mapGetters('FamilyRelationships', ['relationships']),
        ...mapGetters('WorkPlaces', ['places']),
    }
}
</script>

<template>

    <div>

        <button type="button" class="btn btn-sm btn-primary" @click="newMember($event)">
            +
        </button>
    </div>
    <div class="p-5">
        <!-- <div class="card-header">

        </div> -->
        <!-- <div class="card-body"> -->

            <table class="table table-bordered">
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
                    <tr v-for="member in members" :key="member.id">
                        <td><button class="btn btn-sm btn-outline-secondary" @click="showHouseholdMember(member.id)">show</button></td>
                        <td>{{member.surname}}</td>
                        <td>{{member.name}}</td>
                        <td>{{member.patronymic}}</td>
                        <td>{{member.birthday}}</td>
                        <td>{{member.sex}}</td>
                        <td>{{member.familyRelationship}}</td>
                        <td>{{member.workPlace}}</td>
                        <td>{{member.employment}}</td>
                    </tr>
                </tbody>
            </table>
        <!-- </div> -->
    </div>
    <div class="pt-4">
        <!-- <table class="table table-bordered table-sm">
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
        </table> -->
    </div>

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
                            <label for="memberSurname" class="form-label">Прізвище</label>
                            <input type="text" class="form-control" id="memberSurname" v-model="formData.surname">
                        </div>
                        <div class="col">
                            <label for="memberName" class="form-label">Ім'я</label>
                            <input type="text" class="form-control" id="memberName" v-model="formData.name">
                        </div>
                        <div class="col">
                            <label for="memberPatronymic" class="form-label">По батькові</label>
                            <input type="text" class="form-control" id="memberPatronymic" v-model="formData.patronymic">
                        </div>
                    </div>
                    <!-- <div class="mb-1 row">
                        <label for="exampleFormControlInput1" class="form-label">Дата народження</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" v-model="formData.birthday">
                    </div> -->
                    <!-- <hr> -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="memberSex" class="form-label">Стать</label>
                            <input class="form-control" list="sex" id="memberSex" placeholder="Type to search..." v-model="formData.sex">
                            <datalist id="sex">
                                <option value="чоловіча" />
                                <option value="жіноча" />
                            </datalist>
                        </div>
                        <div class="col-md-3">
                            <label for="memberBirthday" class="form-label">Дата народження</label>
                            <input type="date" class="form-control" id="memberBirthday" v-model="formData.birthday">
                        </div>
                        <div class="col-md-6">
                            <label for="familyRelationship" class="form-label">Родинні стосунки</label>
                            <!-- <input type="email" class="form-control" id="exampleFormControlInput1" v-model="formData.familyRelationship"> -->
                            <select class="form-select" aria-label="Default select example" v-model="formData.familyRelationship">
                                <option disabled value="0">Оберить тип родинних стосунків</option>
                                <option :value="relationship.id" v-for="relationship in relationships" :key="relationship.id">
                                    {{relationship.name}}
                                </option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="workPlace" class="form-label">Місце роботи залежно від територіального розташування</label>
                            <select class="form-select" id="workPlace" aria-label="Default select example" v-model="formData.workPlace">
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
                            <textarea class="form-control" id="memberEmployment" rows="2" v-model="formData.employment"></textarea>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">Відмінити</button>
                    <button type="button" class="btn btn-primary" @click="submitData">{{modalSubmitCaption}}</button>
                </div>
            </div>
        </div>
    </div>
</template>
