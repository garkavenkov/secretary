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
                    this.clearFormData();
                    this.$store.dispatch('Households/fetchRecords');
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        },
    },
    computed: {
        ...mapGetters('Households', ['households']),
        ...mapGetters('HouseholdTypes', ['householdTypes']),
        ...mapGetters('Settlements', ['settlements']),
    },
    created() {
        this.$store.dispatch('Households/fetchRecords');
    }
}
</script>

<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Облікові картки</span>
                <button class="btn btn-sm btn-primary" @click="addCard">
                    <span class="mdi mdi-plus"></span>
                </button>
                <button class="btn btn-sm btn-outline-primary ms-2" @click="$store.dispatch('Households/fetchRecords')" title="Оновити дані">
                    <span class="mdi mdi-refresh"></span>
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary" @click="addCard">
                    <!-- <i class="bi bi-funnel"></i>/ -->
                    <span class="mdi mdi-filter-outline"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="households"
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
                                <!-- <i class="bi bi-eye"></i> -->
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{record.settlement}}</td>
                        <td>{{record.number}}</td>
                        <td>{{record.householdTypeId}}</td>
                        <td>{{record.address}}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>


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
