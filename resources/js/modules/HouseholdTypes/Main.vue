<template>
    <breadcrumbs />
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="householdTypes"
                    title="Довідник 'Типи об'єктів погосподарського обліку'"
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit" />

        </div>
    </div>

    <SystemDictionaryForm
            :formData="formData"
            :action="action"
            :formId="formId"
            fieldId="householdTypeName"
            url="/api/v1/household-types"
            @refreshData="$store.dispatch('HouseholdTypes/fetchRecords')"  />

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
        }
    },
    computed: {
        ...mapGetters('HouseholdTypes', ['householdTypes'])
    },
}
</script>
