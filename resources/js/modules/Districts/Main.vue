<script>
import { mapGetters } from 'vuex';
import { Modal } from 'bootstrap';

import DataTable from '../../components/ui/DataTable.vue';
import DistrictForm from './Form.vue';

export default {
    name: 'DistrictsMain',
    components: {
        DataTable,
        DistrictForm
    },
    data() {
        return {
            districtFormData: {
                region_id: 0,
                name: '',
                center: ''
            }
        }
    },
    provide() {
        return {
            modalTitle: 'Новий район',
        }
    },
    methods: {
        openDistrictForm() {
            var myModal = new Modal(document.getElementById('DistrictForm'))
            myModal.show();
        }
    },
    computed: {
        ...mapGetters('Districts', ['districts'])
    },
}
</script>

<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник "Райони"</span>
                <button class="btn btn-sm btn-primary" @click="openDistrictForm">
                    <span class="mdi mdi-plus"></span>
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary">
                    <span class="mdi mdi-filter-outline"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="districts"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Назва района</th>
                        <th>Адміністративний центр</th>
                        <th>Область</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'DistrictsShow', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{record.name}}</td>
                        <td>{{record.center}}</td>
                        <td>{{record.region.name}}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <DistrictForm :formData="districtFormData" @refreshData="$store.dispatch('Districts/fetchDistricts')"/>

</template>
