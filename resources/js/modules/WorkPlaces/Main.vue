<template>
    <breadcrumbs />
    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <!-- <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Довідник "Коди місця роботи (заняття)"</span>
                        <button class="btn btn-sm btn-primary">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <DataTable
                            :dataTable="places"
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
                                <td></td>
                            </tr>
                        </template>
                    </DataTable>
                </div>
            </div> -->
            <SystemDictionary
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

import SystemDictionary from '../../components/ui/SystemDictionary.vue';
import WorkPlaceForm from './Form.vue';

export default {
    name: 'WorkPlacesMain',
    components: {
        SystemDictionary,
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
