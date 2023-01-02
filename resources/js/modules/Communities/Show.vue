<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="community.name">
                <div class="card-header">
                    <h5>Інформація о громаді</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Назва
                            </div>
                            <div class="col-md-9">
                                {{ community.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Адреса
                            </div>
                            <div class="col-md-9">
                                {{ community.address }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                ЕДРПОУ
                            </div>
                            <div class="col-md-9">
                                {{ community.edrpou }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                КОАТУУ
                            </div>
                            <div class="col-md-9">
                                {{ community.koatuu }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Район
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'DistrictsShow', params: {id: community.district.id}}">
                                    {{ community.district.name }}
                                </router-link>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Регіон
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'RegionsShow', params: {id: community.district.region.id}}">
                                    {{ community.district.region.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper">
                                <span>Міські / сільські ради в громаді</span>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <DataTable  :dataTable="community.councils"
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
                                            <router-link :to="{name: 'CouncilsShow', params: { id: record.id }}">
                                                <!-- <i class="bi bi-eye"></i> -->
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
import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'CommunitiesShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            community: {}
        }
    },
    methods: {
        fetchData() {
            axios.get(`/api/v1/communities/${this.id}`)
                .then(res => {
                    this.community = res.data.data;
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
