<template>   

    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="relationshipTypes"
                    :fields="fields"
                    title="Довідник 'Родинні стосунки'"                    
                    newRecordTitle="Додати новий тип родинних стосунків"
                    editRecordTitle="Редагувати тип родинних стосунків"
                    deleteRecordTitle="Видалити тип родинних стосунків"
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit" 
                    @deleteRecord="() => {}" />

        </div>
    </div>

    <SystemDictionaryForm
            :formData="formData"
            :action="action"
            :formId="formId"
            :fields="fields"            
            url="/api/v1/family-relationship-types"
            @refreshData="$store.dispatch('FamilyRelationshipTypes/fetchRecords')" 
            @resetForm="resetForm" />

</template>

<script>
import { mapGetters }           from 'vuex';

import SystemDictionary         from '../../mixins/SystemDictionary';
import SystemDictionaryTable    from '../../components/ui/SystemDictionaryTable.vue';
import SystemDictionaryForm     from '../../components/ui/SystemDictionaryForm.vue';

export default {
    name: 'FamilyRelationshipTypesMain',
    mixins: [SystemDictionary],
    components: {        
        SystemDictionaryTable,
        SystemDictionaryForm,
    },
    data() {
        return {
            formId: 'FamilyRelationshipTypeForm',
            modalTitleCreate: 'Новий тип родинних відносин',
            modalTitleUpdate: 'Редагування типу',
            fields: [
                {
                    title: 'Назва',
                    name: 'name',
                    fieldId: "familyRelationshipTypeName",
                    validate: true                  
                },
                {
                    title: 'Стать',
                    name: 'sex',
                    fieldId: "familyRelationshipTypeSex",
                    validate: true
                },
            ],
            formData: {
                name: '',
                sex: ''
            },
        }
    },
    methods: {
        resetForm() {
            this.formData.name = '';
            this.formData.sex = '';
        }
    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes':'types'})
    },
}
</script>
