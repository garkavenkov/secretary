<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="district.name">
                <div class="card-header">
                    <h5>Інформація</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Назва
                            </div>
                            <div class="col-md-9">
                                {{ district.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Адміністративний центр
                            </div>
                            <div class="col-md-9">
                                {{ district.center }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Регіон
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'RegionsShow', params: {id: district.region_id}}">
                                    {{ district.region.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper">
                                <span>Громади в районі</span>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <DataTable  :dataTable="district.communities"
                                        tableHeaderClass="table-dark">
                                <template v-slot:header>
                                    <tr>
                                        <th>Назва</th>
                                        <th>Адреса</th>
                                    </tr>
                                </template>
                                <template v-slot:default="slotProps">
                                    <tr     v-for="record in slotProps.paginatedData"
                                            :key="record.id">
                                        <td>
                                            <router-link :to="{name: 'CommunitiesShow', params: { id: record.id }}">
                                                <td>{{record.name}}</td>
                                            </router-link>
                                        </td>
                                        <td>{{ record.address }}</td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DataTable from '../../components/ui/DataTable.vue'
export default {
    name: 'DistrictsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            district: {}
        }
    },
    methods: {
        fetchData() {
            axios.get(`/api/v1/districts/${this.id}`)
                .then(res => {
                    this.district = res.data.data
                })
        }
    },
    created() {
        this.fetchData();
    },
    components: {
        DataTable
    }
}
</script>
