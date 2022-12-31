<script>
import { mapGetters } from 'vuex';

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'WorkPlacesMain',
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
        ...mapGetters('WorkPlaces', ['places'])
    },
}
</script>

<template>
    <breadcrumbs />
    <!-- <div class="row">
        <div class="col-md-8 mx-auto"> -->
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Довідник "Коди місця роботи (заняття)"</span>
                        <button class="btn btn-sm btn-primary">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <!-- <div>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div> -->
                    <!-- <h5>Коди місця роботи (заняття)</h5> -->
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
            </div>
        <!-- </div>
    </div> -->
</template>
