<template>
    
    <div class="row">
        <div class="col-md-8 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="settlementTypes"
                    title="Довідник 'Тип населеного пункту'"
                    newRecordTitle="Додати новий тип населенного пункту"
                    editRecordTitle="Редагувати тип населенного пункту"
                    deleteRecordTitle="Видалити тип населенного пункту"
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit"
                    @deleteRecprd="() => {}"/>

        </div>
    </div>

    <SystemDictionaryForm
            :formData="formData"
            :action="action"
            :formId="formId"
            fieldId="settlementTypeName"
            url="/api/v1/settlement-types"
            @refreshData="$store.dispatch('SettlementTypes/fetchRecords')"  />

</template>

<script>
import { mapGetters }           from 'vuex';

import SystemDictionary         from '../../mixins/SystemDictionary';
import SystemDictionaryForm     from '../../components/ui/SystemDictionaryForm.vue';
import SystemDictionaryTable    from '../../components/ui/SystemDictionaryTable.vue';

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
