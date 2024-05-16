<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="relationshipTypes"
                    title="Довідник 'Родинні стосунки'"
                    :fieldsTitle="['Назва', 'Стать']"
                    :fieldsName="['name', 'sex']"
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
            fieldId="familyRelationshipTypeName"
            url="/api/v1/family-relationship-types"
            @refreshData="$store.dispatch('FamilyRelationshipTypes/fetchRecords')" />

</template>

<script>
import { mapGetters }           from 'vuex';

import SystemDictionary         from '../../mixins/SystemDictionary';
import Breadcrumbs              from '../../components/ui/Breadcrumbs.vue';
import SystemDictionaryTable    from '../../components/ui/SystemDictionaryTable.vue';
import SystemDictionaryForm     from '../../components/ui/SystemDictionaryForm.vue';

export default {
    name: 'FamilyRelationshipTypesMain',
    mixins: [SystemDictionary],
    components: {
        Breadcrumbs,
        SystemDictionaryTable,
        SystemDictionaryForm,
    },
    data() {
        return {
            formId: 'FamilyRelationshipTypeForm',
            modalTitleCreate: 'Новий тип родинних відносин',
            modalTitleUpdate: 'Редагування типу',
            formData: {
                name: '',
                sex: ''
            },
        }
    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes':'types'})
    },
}
</script>
