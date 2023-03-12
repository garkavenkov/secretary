<template>

    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="role.code">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація</span>
                        <button class="btn btn-sm btn-light btn-transparent"
                                @click="openRoleForm"
                                title="Редагувати дані">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    Код
                                </div>
                                <div class="col-md-9">
                                    {{ role.code }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    Назва
                                </div>
                                <div class="col-md-9">
                                    {{ role.name }}
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3">
                                    Опис
                                </div>
                                <div class="col-md-9">
                                    {{ role.description }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper flex-grow-1 justify-content-between">
                                <span>Районі в регіоні</span>
                                <button class="btn btn-sm btn-light btn-transparent"
                                        title="Додати район"
                                        @click="openDistrictForm">
                                    <span class="mdi mdi-plus"></span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <template v-if="region.districts.length > 0">
                                <DataTable  :dataTable="region.districts"
                                            tableHeaderClass="table-dark">
                                    <template v-slot:header>
                                        <tr>
                                            <th>Назва</th>
                                            <th>Центр</th>
                                        </tr>
                                    </template>
                                    <template v-slot:default="slotProps">
                                        <tr     v-for="record in slotProps.paginatedData"
                                                :key="record.id">
                                            <td>
                                                <router-link :to="{name: 'districts.show', params: { id: record.id }}">
                                                    <td>{{record.name}}</td>
                                                </router-link>
                                            </td>
                                            <td>{{ record.center }}</td>
                                        </tr>
                                    </template>
                                </DataTable>
                            </template>
                            <template v-else>
                                <div class="text-center text-muted">
                                    В данному регіоні райони не знайдені
                                </div>
                            </template>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: 'RolesShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            role: {}
        }
    },
    methods: {
        fetchData() {
            axios.get(`/api/v1/roles/${this.id}`)
                .then(res => {
                    this.role = res.data.data
                });
        },
        openRoleForm() {}
    },
    created() {
        this.fetchData()
    }
}

</script>
