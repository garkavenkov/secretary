<script>

import { mapGetters } from 'vuex';
import DataTable from '../../components/ui/DataTable.vue';

export default {
    components: {
        DataTable
    },
    data() {
        return {
            // regions: []
        }
    },
    methods: {
        // fetchData() {
        //     axios.get('/api/v1/regions')
        //         .then(res => {
        //             this.regions = res.data.data;
        //         });
        // }
    },
    computed: {
        ...mapGetters('Regions', ['regions']),
    },
    created() {
        // this.fetchData();
    }
}
</script>

<template>
    <h4>
        Області країни
    </h4>
    <div>
        <DataTable
                :dataTable="regions"
                tableHeaderClass="table-dark">
            <template v-slot:header>
                <tr>
                    <th>Назва</th>
                    <th>Обласний центр</th>
                    <th></th>
                </tr>
            </template>
            <template v-slot:default="slotProps">
                <tr     v-for="record in slotProps.paginatedData"
                        :key="record.id">
                    <td>{{record.name}}</td>
                    <td>{{record.center}}</td>
                    <td></td>
                </tr>
            </template>
        </DataTable>
    </div>
</template>
