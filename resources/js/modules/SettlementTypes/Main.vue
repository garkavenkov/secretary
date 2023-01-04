<template>
    <breadcrumbs />
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Довідник "Тип населеного пункту"</span>
                        <button class="btn btn-sm btn-primary" @click="openFormForAdd">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <DataTable
                            :dataTable="settlementTypes"
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

    <SettlementTypeForm
            :formData="formData"
            :action="action"
            @refreshData="$store.dispatch('SettlementTypes/fetchRecords')" />

</template>

<script>
import { mapGetters } from 'vuex';
import { Modal } from 'bootstrap';
import { computed } from 'vue';

import DataTable from '../../components/ui/DataTable.vue';
import SettlementTypeForm from './Form.vue';

export default {
    name: 'SettlementTypesMain',
    components: {
        DataTable,
        SettlementTypeForm
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
            let myModal = new Modal(document.getElementById('SettlementTypeForm'));

            this.modalTitle = 'Новий тип населеного пункту';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            myModal.show();
        },
        openFormForEdit(type) {
            let myModal = new Modal(document.getElementById('SettlementTypeForm'));

            this.modalTitle = 'Редагування типу населеного пункту';
            this.modalSubmitCaption = 'Зберегти';

            this.formData.id   = type.id;
            this.formData.name = type.name;
            this.action = 'update';

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('SettlementTypes', ['settlementTypes'])
    },
}
</script>

<style lang="scss" scoped>
table tr td:last-of-type {
    text-align: center;
    width: 5rem;
}
</style>
