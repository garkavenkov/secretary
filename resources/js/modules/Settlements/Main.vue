<script>

import { mapGetters } from 'vuex';
import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'SettlementsMain',
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
                                <i class="bi bi-eye"></i>
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
</template>
