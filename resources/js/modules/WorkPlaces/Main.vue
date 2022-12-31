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
        ...mapGetters('WorkPlaces', ['places'])
    },
    created() {
        // this.fetchData();
    }
}
</script>

<template>
    <breadcrumbs />
    <h4>
        Коди місця роботи (заняття)
    </h4>
    <div>
        <div class="row">
            <div class="col-md-6 mx-auto">

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
        <!-- {{districts}} -->
    </div>
</template>
