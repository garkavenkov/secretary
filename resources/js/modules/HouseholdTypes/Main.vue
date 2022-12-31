<script>
import { mapGetters } from 'vuex';

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'HouseholdTypesMain',
    components: {
        DataTable
    },
    data() {
        return {
            // districts: []
        }
    },
    methods: {
        // fetchData() {
        //     axios.get('/api/v1/districts')
        //         .then(res => {
        //             this.districts = res.data.data;
        //         });
        // }
    },
    computed: {
        ...mapGetters('HouseholdTypes', ['householdTypes'])
    },
    created() {
        // this.fetchData();
    }
}
</script>

<template>
    <breadcrumbs />
    <!-- <div class="row">
        <div class="col-md-8 mx-auto"> -->
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Довідник "Типи об'єктів погосподарського обліку"</span>
                        <button class="btn btn-sm btn-primary">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <!-- <div>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-funnel"></i>
                        </button>
                    </div> -->
                    <!-- <h5>Типи об'єктів погосподарського обліку</h5> -->
                </div>
                <div class="card-body">
                    <DataTable
                            :dataTable="householdTypes"
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
