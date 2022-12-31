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
        ...mapGetters('Settlements', ['settlements']),
    },
    created() {
        // this.fetchData();
    }
}
</script>

<template>
    <breadcrumbs />
    <h4>
        Населенні пункти
    </h4>
    <div>
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
</template>
