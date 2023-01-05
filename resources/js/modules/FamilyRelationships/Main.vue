<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="relationships"
                    title='Довідник "Родинні стосунки"'
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit" />

        </div>
    </div>

    <SystemDictionaryForm
            :formData="formData"
            :action="action"
            :formId="formId"
            fieldId="familyRelationshipName"
            url="/api/v1/family-relationships"
            @refreshData="$store.dispatch('FamilyRelationships/fetchRecords')" />

</template>

<script>
import { mapGetters } from 'vuex';
import SystemDictionary from '../../minixs/SystemDictionary';

import Breadcrumbs from '../../components/ui/Breadcrumbs.vue';
import SystemDictionaryTable from '../../components/ui/SystemDictionaryTable.vue';
import SystemDictionaryForm from '../../components/ui/SystemDictionaryForm.vue';

export default {
    name: 'FamilyRelationshipsMain',
    mixins: [SystemDictionary],
    components: {
        Breadcrumbs,
        SystemDictionaryTable,
        SystemDictionaryForm,
    },
    data() {
        return {
            formId: 'FamilyRelationshipForm',
            modalTitleCreate: 'Новий тип родинних відносин',
            modalTitleUpdate: 'Редагування типу',
        }
    },
    computed: {
        ...mapGetters('FamilyRelationships', ['relationships'])
    },
}
</script>
