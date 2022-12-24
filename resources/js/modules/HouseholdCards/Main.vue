<script>

import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap'
import FormValidator    from '../../minixs/FormValidator';

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'HouseholdCardsMain',
    components: {
        DataTable,
    },
    mixins: [FormValidator],
    data() {
        return {
            formData: {
                settlement_id: 0,
                household_type_id: 0,
                address: '',
                special_marks: '',
                additional_data: ''
            },
            currentTab: 'HouseholdInfo',
            modalTitle: '',
            modalSubmitCaption: '',
            cards: [],
            // cards: [
            //     {
            //         id:1,
            //         settlementId: 1,
            //         settlement: 'Шаповалівка',
            //         householdTypeId: 1,
            //         address: 'вул Набрежна, б. 55',
            //         specialMarks: '',
            //         additional: '',
            //         number: '01-0001-1',
            //     },
            //     {
            //         id:2,
            //         settlementId: 1,
            //         settlement: 'Шаповалівка',
            //         householdTypeId: 1,
            //         address: 'вул Набрежна, б. 57',
            //         specialMarks: '',
            //         additional: '',
            //         number: '01-0002-1',
            //     },
            //     {
            //         id:3,
            //         settlementId: 1,
            //         settlement: 'Шаповалівка',
            //         householdTypeId: 1,
            //         address: 'вул Набрежна, б. 59',
            //         specialMarks: '',
            //         additional: '',
            //         number: '01-0003-1',
            //     },
            //     {
            //         id:4,
            //         settlementId: 1,
            //         settlement: 'Шаповалівка',
            //         householdTypeId: 1,
            //         address: 'вул Набрежна, б. 61',
            //         specialMarks: '',
            //         additional: '',
            //         number: '01-0004-1',
            //     },
            //     {
            //         id:5,
            //         settlementId: 1,
            //         settlement: 'Привокзальне',
            //         householdTypeId: 1,
            //         address: 'вул Свободи, б. 32',
            //         specialMarks: '',
            //         additional: '',
            //         number: '02-0001-1',
            //     },
            //     {
            //         id:6,
            //         settlementId: 1,
            //         settlement: 'Привокзальне',
            //         householdTypeId: 1,
            //         address: 'вул Свободи, б. 34',
            //         specialMarks: '',
            //         additional: '',
            //         number: '02-0002-1',
            //     },
            //     {
            //         id:7,
            //         settlementId: 1,
            //         settlement: 'Привокзальне',
            //         householdTypeId: 1,
            //         address: 'вул Свободи, б. 36',
            //         specialMarks: '',
            //         additional: '',
            //         number: '02-0003-1',
            //     }
            // ]
        }
    },
    methods: {
        addCard() {
            var myModal = new Modal(document.getElementById('HouseholdCard'))
            this.modalTitle = 'Нова облікова картка';
            this.modalSubmitCaption = 'Додати';
            myModal.show();
        },
        clearFormData() {
            this.formData.settlement_id = 0;
            this.formData.household_type_id = 0;
            this.formData.address = '';
            this.formData.special_marks =  '';
            this.formData.additional_data = '';
        },
        submitData() {
            axios.post('/api/v1/households', this.formData)
                .then(res => {
                    console.log(res.data.message);
                    this.clearFormData();
                    this.fetchCards();
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
        fetchCards() {
            axios.get('/api/v1/households')
                .then(res => {
                    this.cards = res.data.data
                });
        },
    },
    computed: {
        ...mapGetters('HouseholdTypes', ['householdTypes']),
        ...mapGetters('Settlements', ['settlements']),
    },
    created() {
        this.fetchCards();
    }
}
</script>

<template>
    <div class="d-flex mb-3">
        <span>
            Шаповалівська сільська рада
        </span>
    </div>
    <!-- <div class="d-flex mb-3">
        <div class="settlement">
            <div class="settlement-name">
                с. Шаповалівка
            </div>
            <div class="cards-count">
                64
            </div>
        </div>
        <div div class="settlement">
            <div class="settlement-name">
                с. Привокзальне
            </div>
            <div class="cards-count">
                32
            </div>
        </div>
    </div> -->
    <button class="btn btn-primary" @click="addCard">
        <i class="bi bi-plus"></i>
        Додати картку
    </button>
    <button class="btn btn-primary" @click="addCard">
        <i class="bi bi-funnel"></i>
        Фільтр
    </button>
    <DataTable
                :dataTable="cards"
                tableHeaderClass="table-dark">
            <template v-slot:header>
                <tr>
                    <th></th>
                    <th>Населений пункт</th>
                    <th>Номер</th>
                    <th>Тип</th>
                    <th>Місцезнаходження / адреса</th>
                </tr>
            </template>
            <template v-slot:default="slotProps">
                <tr     v-for="record in slotProps.paginatedData"
                        :key="record.id">
                    <td>
                        <router-link :to="{name: 'HouseholdCardsShow', params: { id: record.id }}">
                            <i class="bi bi-eye"></i>
                        </router-link>
                    </td>
                    <td>{{record.settlement}}</td>
                    <td>{{record.number}}</td>
                    <td>{{record.householdTypeId}}</td>
                    <td>{{record.address}}</td>
                </tr>
            </template>
        </DataTable>


    <div class="modal modal-lg fade" id="HouseholdCard" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel" v-html="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clearFormData"></button>
                </div>
                <div class="modal-body">
                    <!-- <div class="row mb-3">
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
                    </div> -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="householdType" class="form-label">Населений пункт</label>
                            <select :class="['form-control', hasError('settlement_id') ? 'is-invalid' : '']"
                                    id="householdType"
                                    aria-label="Default select example"
                                    v-model="formData.settlement_id">
                                <option disabled value="0">Оберить населений пункт</option>
                                <option :value="settlement.id" v-for="settlement in settlements" :key="settlement.id">
                                    {{settlement.name}}
                                </option>
                            </select>
                            <div id="householdTypeValidation" class="invalid-feedback">
                                {{ getError('settlement_id') }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="householdType" class="form-label">Тип об'єкта погосподарського обліку</label>
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

                    <!-- <div class="row mb-3">
                        <div class="col">
                            <label for="householdType" class="form-label">Тип об'єкта погосподарського обліку</label>
                            <select class="form-select" id="householdType" aria-label="Default select example" v-model="formData.householdType">
                                <option disabled value="0">Оберить тип об'єкта</option>
                                <option :value="t.id" v-for="t in types" :key="t.id">
                                    {{t.name}}
                                </option>
                            </select>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <div class="col">
                            <label for="householdAddress" class="form-label">Місцезнаходження / адреса</label>
                            <textarea
                                    :class="['form-control', hasError('address') ? 'is-invalid' : '']"
                                    id="householdAddress"
                                    rows="2"
                                    v-model="formData.address">
                            </textarea>
                            <div id="householdAddressValidation" class="invalid-feedback">
                                {{ getError('address') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="householdSpecialMarks" class="form-label">Спеціальні відмітки</label>
                            <textarea class="form-control" id="householdSpecialMarks" rows="2" v-model="formData.special_marks"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="householdAdditionalInformation" class="form-label">Додаткові відомості</label>
                            <textarea class="form-control" id="householdAdditionalInformation" rows="2" v-model="formData.additional_data"></textarea>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">Відмінити</button>
                    <button type="button" class="btn btn-primary" @click="submitData">{{modalSubmitCaption}}</button>
                </div>
            </div>
        </div>
    </div>
</template>


<style lang="scss" scoped>
.settlement {
    display: flex;
    padding: 0.5rem 1rem;
    border: 1px solid #eee;
    border-radius: 0.2rem;
    flex-direction: column;

    .settlement-name {
        font-size: 1.1rem
    }

    .cards-count {
        text-align: end;
        color: var(--bs-gray-600);
    }
}
</style>
