<script>

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'DistrictsMain',
    components: {
        DataTable
    },
    data() {
        return {
            communities: []
        }
    },
    methods: {
        fetchData() {
            axios.get('/api/v1/communities')
                .then(res => {
                    this.communities = res.data.data;
                });
        }
    },
    created() {
        this.fetchData();
    }
}
</script>


<template>
    <h4>
        Громади
    </h4>
    <div>
        <DataTable
                :dataTable="communities"
                tableHeaderClass="table-dark">
            <template v-slot:header>
                <tr>
                    <th>Район</th>
                    <th>Назва громади</th>
                    <th>Адреса</th>
                    <th>ЕДРПОУ</th>
                    <th>КОАТУУ</th>
                </tr>
            </template>
            <template v-slot:default="slotProps">
                <tr     v-for="record in slotProps.paginatedData"
                        :key="record.id">
                    <td>{{record.district.name}}</td>
                    <td>{{record.name}}</td>
                    <td>{{record.address}}</td>
                    <td>{{record.edrpou}}</td>
                    <td>{{record.koatuu}}</td>
                </tr>
            </template>
        </DataTable>
    </div>

</template>
