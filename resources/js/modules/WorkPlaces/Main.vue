<template>
    <breadcrumbs />
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="places"
                    title='Довідник "Коди місця роботи (заняття)"'
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit" />

        </div>
    </div>

    <WorkPlaceForm
            :formData="formData"
            :action="action"
            @refreshData="$store.dispatch('WorkPlaces/fetchRecords')" />

</template>

<script>
import { mapGetters } from 'vuex';
import { Modal } from 'bootstrap';
import { computed } from 'vue';

import SystemDictionaryTable from '../../components/ui/SystemDictionaryTable.vue';
import WorkPlaceForm from './Form.vue';

export default {
    name: 'WorkPlacesMain',
    components: {
        SystemDictionaryTable,
        WorkPlaceForm
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
            let myModal = new Modal(document.getElementById('WorkPlaceForm'));

            this.modalTitle = 'Новий код місця роботи';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            myModal.show();
        },
        openFormForEdit(record) {
            let myModal = new Modal(document.getElementById('WorkPlaceForm'));

            this.modalTitle = 'Редагування коду ';
            this.modalSubmitCaption = 'Зберегти';

            this.formData.id   = record.id;
            this.formData.name = record.name;
            this.action = 'update';

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('WorkPlaces', ['places'])
    },
}
</script>
