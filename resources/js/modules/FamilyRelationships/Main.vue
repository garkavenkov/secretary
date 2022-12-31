<script>
import { mapGetters } from 'vuex';
import Breadcrumbs from '../../components/ui/Breadcrumbs.vue';

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'FamilyRelationshipsMain',
    components: {
        DataTable,
        Breadcrumbs
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
        ...mapGetters('FamilyRelationships', ['relationships'])
    },
    created() {
        // this.fetchData();
    }
}
</script>

<template>
    <breadcrumbs />
    <h4>
        Родинні відносини
    </h4>
    <div>
        <div class="row">
            <div class="col-md-6 mx-auto">

                <DataTable
                        :dataTable="relationships"
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
