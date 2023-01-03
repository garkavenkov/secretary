<script>

import { mapGetters } from 'vuex';
import { Modal } from 'bootstrap';

import DataTable from '../../components/ui/DataTable.vue';
import RegionForm from './Form.vue';

export default {
    components: {
        DataTable,
        RegionForm
    },

    data() {
        return {
            form: {
                name: '',
                center: ''
            }
        }
    },
    provide() {
        return {
            modalTitle: 'Новий регіон',
            modalSubmitCaption: 'Додати',
        }
    },
    methods: {
        addRegion() {
            var myModal = new Modal(document.getElementById('RegionForm'))
            myModal.show();
        },
    },
    computed: {
        ...mapGetters('Regions', ['regions']),
    },
}
</script>

<template>
    <breadcrumbs />
    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник "Регіони"</span>
                <button class="btn btn-sm btn-primary" @click="addRegion" title="Додати новий регіон">
                    <i class="bi bi-plus"></i>
                </button>
                <button class="btn btn-sm btn-outline-primary ms-2" @click="$store.dispatch('Regions/fetchRegions')" title="Оновити дані">
                    <i class="bi bi-arrow-repeat"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="regions"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Назва</th>
                        <th>Обласний центр</th>
                        <th></th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'RegionsShow', params: {id: record.id}}">
                                <i class="bi bi-eye"></i>
                            </router-link>
                        </td>
                        <td>{{record.name}}</td>
                        <td>{{record.center}}</td>
                        <td></td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <RegionForm  :formData="form"/>

</template>
