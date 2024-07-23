<template>
    
    <div class="row">
        <div class="col-md-8 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="settlementTypes"
                    :fields="fields"                    
                    title="Довідник 'Тип населеного пункту'"
                    newRecordTitle="Додати новий тип населенного пункту"
                    editRecordTitle="Редагувати тип населенного пункту"
                    deleteRecordTitle="Видалити тип населенного пункту"
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit"
                    @deleteRecord="() => {}"/>

        </div>
    </div>

    <SystemDictionaryForm
            :formData="formData"
            :action="action"
            :formId="formId"
            :fields="fields"            
            url="/api/v1/settlement-types"
            @refreshData="$store.dispatch('SettlementTypes/fetchRecords')" 
            @resetForm="resetForm"  />

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
            fields: [
                {
                    title: 'Назва',
                    name: 'name',
                    fieldId: "settlementTypeName",
                    validate: true                  
                },
                {
                    title: 'Абревіатура',
                    name: 'abbreviation',
                    fieldId: "settlementTypeAbbreviation",
                    validate: true
                },
            ],
            formData: {
                name: '',
                abbreviation: ''
            }

        }
    },
    methods: {
        resetForm() {
            this.formData.name = '';
            this.formData.abbreviation = '';
        }
    },
    computed: {
        ...mapGetters('SettlementTypes', ['settlementTypes'])
    },
}
</script>
