<template>
    <breadcrumbs />
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <!-- <div class="card">
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
            </div> -->

            <SystemDictionaryTable
                    :dataTable="settlementTypes"
                    title='Довідник "Тип населеного пункту"'
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit" />

        </div>
    </div>

    <SystemDictionaryForm
            :formData="formData"
            :action="action"
            :formId="formId"
            fieldId="settlementTypeNameName"
            url="/api/v1/settlement-types"
            @refreshData="$store.dispatch('SettlementTypes/fetchRecords')"  />

</template>

<script>
import { mapGetters } from 'vuex';

import SystemDictionary from '../../minixs/SystemDictionary';
import SystemDictionaryForm from '../../components/ui/SystemDictionaryForm.vue';
import SystemDictionaryTable from '../../components/ui/SystemDictionaryTable.vue';

export default {
    name: 'SettlementTypesMain',
    mixins: [SystemDictionary],
    components: {
        SystemDictionaryForm,
        SystemDictionaryTable,
    },
    data() {
        return {
            formId: 'SettlementTypeForm',
            modalTitleCreate: "Новий тип населеного пункту",
            modalTitleUpdate: 'Редагування типу',
        }
    },
    computed: {
        ...mapGetters('SettlementTypes', ['settlementTypes'])
    },
}
</script>
