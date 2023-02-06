<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Регіони'</span>
                <button class="btn btn-sm btn-primary"
                        @click="addRegion"
                        title="Додати новий регіон">
                    <span class="mdi mdi-plus"></span>
                </button>
                <button class="btn btn-sm btn-outline-primary ms-2"
                        @click="$store.dispatch('Regions/fetchRegions')"
                        title="Оновити дані">
                    <span class="mdi mdi-refresh"></span>
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
                            <router-link :to="{name: 'regions.show', params: {id: record.id}}">
                                <span class="mdi mdi-eye-outline"></span>
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

    <RegionForm
            :formData="form"
            @refreshData="$store.dispatch('Regions/fetchRecords')"/>

</template>


<script>
import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap';

import DataTable        from '../../components/ui/DataTable.vue';
import RegionForm       from './Form.vue';

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
