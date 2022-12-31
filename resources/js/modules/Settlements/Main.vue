<script>

import { mapGetters } from 'vuex';
import DataTable from '../../components/ui/DataTable.vue';

export default {
    components: {
        DataTable
    },
    data() {
        return {
        }
    },
    methods: {
    },
    computed: {
        ...mapGetters('Settlements', ['settlements']),
    },
}
</script>

<template>
    <breadcrumbs />
    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник "Населенні пункти"</span>
                <button class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-funnel"></i>
                </button>
            </div>
            <!-- <h5>Населенні пункти</h5> -->
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="settlements"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th>Сільська рада</th>
                        <th>Тип</th>
                        <th>Назва</th>
                        <th>Індекс</th>
                        <th>КАТОТТГ</th>
                        <th></th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>{{record.council_id}}</td>
                        <td>{{record.settlement_type_id}}</td>
                        <td>{{record.name}}</td>
                        <td>{{record.postcode}}</td>
                        <td>{{record.katottg}}</td>
                        <td></td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>
</template>
