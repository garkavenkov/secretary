<template>
    <breadcrumbs />
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Довідник "Типи об'єктів погосподарського обліку"</span>
                        <button class="btn btn-sm btn-primary" @click="openFormForAdd">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <DataTable
                            :dataTable="householdTypes"
                            tableHeaderClass="table-dark">
                        <template v-slot:header>
                            <tr>
                                <th>Назва</th>
                                <th></th>
                            </tr>
                        </template>
                        <template v-slot:default="slotProps">
                            <tr     v-for="record in slotProps.paginatedData"
                                    :key="record.id">
                                <td>{{record.name}}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" @click="openFormForEdit(record)" title="Редагувати інформацію">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                        </template>
                    </DataTable>
                </div>
            </div>
        </div>
    </div>

    <HouseholdTypeForm
            :formData="formData"
            :action="action"
            @refreshData="$store.dispatch('HouseholdTypes/fetchRecords')" />

</template>

<script>
import { mapGetters } from 'vuex';
import { Modal } from 'bootstrap';
import { computed } from 'vue';

import DataTable from '../../components/ui/DataTable.vue';
import HouseholdTypeForm from './Form.vue';

export default {
    name: 'HouseholdTypesMain',
    components: {
        DataTable,
        HouseholdTypeForm
    },
    data() {
        return {
            formData: {
                name: ''
            },
            action: '',
            modalTitle: '',
            modalSubmitCaption: '',
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        openFormForAdd() {
            let myModal = new Modal(document.getElementById('HouseholdTypeForm'));

            this.modalTitle = 'Новий тип об\'єкта погосподарського обліку';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            myModal.show();
        },
        openFormForEdit(type) {
            let myModal = new Modal(document.getElementById('HouseholdTypeForm'));

            this.modalTitle = 'Редагування типу ';
            this.modalSubmitCaption = 'Зберегти';

            this.formData.id   = type.id;
            this.formData.name = type.name;
            this.action = 'update';

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('HouseholdTypes', ['householdTypes'])
    },
}
</script>

<style lang="scss" scoped>
table tr td:last-of-type {
    text-align: center;
    width: 5rem;
}
</style>
