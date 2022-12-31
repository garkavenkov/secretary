<script>

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'DistrictsMain',
    components: {
        DataTable
    },
    data() {
        return {
            communities: [],
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
    <breadcrumbs />
    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник "Громади"</span>
                <button class="btn btn-sm btn-primary">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-funnel"></i>
                </button>
            </div>
            <!-- <h5>Громади</h5> -->
        </div>
        <div class="card-body">
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
    </div>

</template>
