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
        ...mapGetters('Districts', ['districts'])
    },
    created() {
        // this.fetchData();
    }
}
</script>

<template>
    <h4>
        Райони
    </h4>
    <div>
        <!-- {{districts}} -->
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
</template>
