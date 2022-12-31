<script>
import { mapGetters } from 'vuex';

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'DistrictsMain',
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
        ...mapGetters('Districts', ['districts'])
    },
}
</script>

<template>
    <breadcrumbs />
    <!-- <div class="row">
        <div class="col-md-12 mx-auto"> -->
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Довідник "Райони"</span>
                        <button class="btn btn-sm btn-primary">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div>
                    <!-- <h5>Райони</h5> -->
                </div>
                <div class="card-body">
                    <DataTable
                            :dataTable="districts"
                            tableHeaderClass="table-dark">
                        <template v-slot:header>
                            <tr>
                                <th>Область</th>
                                <th>Назва района</th>
                                <th>Адміністративний центр</th>
                            </tr>
                        </template>
                        <template v-slot:default="slotProps">
                            <tr     v-for="record in slotProps.paginatedData"
                                    :key="record.id">
                                <td>{{record.region.name}}</td>
                                <td>{{record.name}}</td>
                                <td>{{record.center}}</td>
                            </tr>
                        </template>
                    </DataTable>
                </div>
            </div>
        <!-- </div>
    </div> -->
</template>
