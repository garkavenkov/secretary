<template>
    <breadcrumbs />
    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник "Населенні пункти"</span>
                <button class="btn btn-sm btn-primary" @click="openSettlementForm">
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
                    :dataTable="settlements"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Назва</th>
                        <th>Тип</th>
                        <th>Сільська рада</th>
                        <th>Індекс</th>
                        <th>КАТОТТГ</th>
                        <th></th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'SettlementsShow', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{ record.name }}</td>
                        <td>{{ record.settlement_type.name }}</td>
                        <td>{{ record.council.name }}</td>
                        <td>{{ record.postcode }}</td>
                        <td>{{ record.katottg }}</td>
                        <td></td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <SettlementForm
            :formData="formData"
            @refreshData="$store.dispatch('Settlements/fetchRecords')" />

</template>

<script>
import { mapGetters } from 'vuex';
import { Modal } from 'bootstrap'

import DataTable from '../../components/ui/DataTable.vue';
import SettlementForm from './Form.vue';

export default {
    name: 'SettlementsMain',
    components: {
        DataTable,
        SettlementForm
    },
    data() {
        return {
            formData: {
                region_id           : 0,
                district_id         : 0,
                community_id        : 0,
                council_id          : 0,
                settlement_type_id  : 0,
                name                :'',
                postcode            :'',
                inner_code          :'',
                katottg             :'',
            }
        }
    },
    provide() {
        return {
            modalTitle: 'Новий населений пункт',
        }
    },
    methods: {
        openSettlementForm() {
            var myModal = new Modal(document.getElementById('SettlementForm'));
            myModal.show();
        }
    },
    computed: {
        ...mapGetters('Settlements', ['settlements']),
    },
}
</script>

