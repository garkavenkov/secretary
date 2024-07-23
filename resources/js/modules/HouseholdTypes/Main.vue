<template>

    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="householdTypes"
                    :fields="fields"
                    title="Довідник 'Типи об'єктів погосподарського обліку'"
                    newRecordTitle="Додати новий тип обліку"
                    editRecordTitle="Редагувати тип обліку"
                    deleteRecordTitle="Видалити тип обліку"
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
            url="/api/v1/household-types"
            @refreshData="$store.dispatch('HouseholdTypes/fetchRecords')"  
            @resetForm="resetForm" />

</template>

<script>
import { mapGetters }           from 'vuex';

import SystemDictionary         from '../../mixins/SystemDictionary';

import SystemDictionaryTable    from '../../components/ui/SystemDictionaryTable.vue';
import SystemDictionaryForm     from '../../components/ui/SystemDictionaryForm.vue';

export default {
    name: 'HouseholdTypesMain',
    mixins: [SystemDictionary],
    components: {
        SystemDictionaryTable,
        SystemDictionaryForm,
    },
    data() {
        return {
            formId: 'HouseholdTypeForm',
            modalTitleCreate: "Новий тип об'єкта погосподарського обліку",
            modalTitleUpdate: 'Редагування типу',
            fields: [
                {
                    title: 'Назва',
                    name: 'name',
                    fieldId: "settlementTypeName",
                    validate: true                  
                },                
            ],
            formData: {
                name: ''                
            }
        }
    },
    methods: {
        resetForm() {
            this.formData.name = '';
        }
    },
    computed: {
        ...mapGetters('HouseholdTypes', ['householdTypes'])
    },
}
</script>
