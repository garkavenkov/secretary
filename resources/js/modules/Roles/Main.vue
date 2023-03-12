<template>

    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Ролі'</span>
                <button class="btn btn-sm btn-primary" @click="openRoleForm">
                    <span class="mdi mdi-plus"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="roles"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Код</th>
                        <th>Назва </th>
                        <th>Опис</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'roles.show', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{record.code}}</td>
                        <td>{{record.name}}</td>
                        <td>{{record.description}}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>


</template>

<script>

import DataTable        from '../../components/ui/DataTable.vue';

export default {
    name: 'RolesMain',
    components: {
        DataTable
    },
    data() {
        return {
            roles: []
        }
    },
    methods: {
        fetchData() {
            axios.get('/api/v1/roles')
                .then(res => {
                    this.roles = res.data.data;
                })
        },
        openRoleForm() {}
    },
    created() {
        this.fetchData();
    }
}

</script>
