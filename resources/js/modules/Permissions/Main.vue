<template>

    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Дозволи'</span>
                <button class="btn btn-sm btn-primary" @click="openPermissionForm">
                    <span class="mdi mdi-plus"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="permissions"
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
                            <router-link :to="{name: 'permissions.show', params: { id: record.id }}">
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

    <PermissionForm :formData="formData" action="create" @refreshData="fetchData" />

</template>

<script>

import { Modal }        from 'bootstrap';

import DataTable        from '../../components/ui/DataTable.vue';
import PermissionForm   from './Form.vue';

export default {
    name: 'PermissionsMain',
    components: {
        DataTable,
        PermissionForm
    },
    provide() {
        return {
            modalTitle: 'Новий дозвіл',
        }
    },
    data() {
        return {
            permissions: [],
            formData: {
                code: '',
                name: '',
                description: '',
                error: ''
            }
        }
    },
    methods: {
        fetchData() {
            axios.get('/api/v1/permissions')
                .then(res => {
                    this.permissions = res.data.data;
                })
        },
        openPermissionForm() {
            var permissionForm = new Modal(document.getElementById('PermissionForm'))
            permissionForm.show();
        }
    },
    created() {
        this.fetchData();
    }
}

</script>
