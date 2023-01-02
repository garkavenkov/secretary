<template>
    <breadcrumbs />
    <!-- {{ council }} -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="council.name">
                <div class="card-header">
                    <h5>Інформація о раді</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">Назва</div>
                            <div class="col-md-9">{{ council.name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">Адреса</div>
                            <div class="col-md-9">{{ council.address }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">ЕДРПОУ</div>
                            <div class="col-md-9">{{ council.edrpou }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">КОАТУУ</div>
                            <div class="col-md-9">{{ council.koatuu }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">Громада</div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'CommunitiesShow', params: {id: council.community_id}}">
                                    {{ council.community.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper">
                                <span>Населенні пункти в громаді</span>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <DataTable  :dataTable="council.settlements"
                                        tableHeaderClass="table-dark">
                                <template v-slot:header>
                                    <tr>
                                        <th>Назва</th>
                                        <th>Індекс</th>
                                        <th>КАТОТТГ</th>
                                    </tr>
                                </template>
                                <template v-slot:default="slotProps">
                                    <tr     v-for="record in slotProps.paginatedData"
                                            :key="record.id">
                                        <td>
                                            <router-link :to="{name: 'SettlementsShow', params: { id: record.id }}">
                                                <!-- <i class="bi bi-eye"></i> -->
                                                <td>{{record.name}}</td>
                                            </router-link>
                                        </td>
                                        <td>{{record.postcode}}</td>
                                        <td>{{record.katottg}}</td>
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
import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'CouncilsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            council: {}
        }
    },
    methods: {
        fetchData() {
            axios.get(`/api/v1/councils/${this.id}`)
                .then(res => {
                    this.council = res.data.data;
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
