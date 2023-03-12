<template>
    <breadcrumbs />
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="places"
                    title="Довідник 'Коди місця роботи (заняття)'"
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit" />

        </div>
    </div>

    <SystemDictionaryForm
            :formData="formData"
            :action="action"
            :formId="formId"
            fieldId="workPlaceName"
            url="/api/v1/work-places"
            @refreshData="$store.dispatch('WorkPlaces/fetchRecords')" />

</template>

<script>
import { mapGetters }           from 'vuex';

import SystemDictionary         from '../../mixins/SystemDictionary';

import SystemDictionaryTable    from '../../components/ui/SystemDictionaryTable.vue';
import SystemDictionaryForm     from '../../components/ui/SystemDictionaryForm.vue';

export default {
    name: 'WorkPlacesMain',
    mixins: [SystemDictionary],
    components: {
        SystemDictionaryTable,
        SystemDictionaryForm,
    },
    data() {
        return {
            formId: 'WorkPlaceForm',
            modalTitleCreate: "Новий код місця роботи",
            modalTitleUpdate: 'Редагування коду',
        }
    },
    computed: {
        ...mapGetters('WorkPlaces', ['places'])
    },
}
</script>
