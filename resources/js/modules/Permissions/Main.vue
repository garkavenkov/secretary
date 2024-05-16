<template>

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Дозволи'</span>
                <ButtonAdd buttonClass="btn-primary p-2" @click="openPermissionForm" title="Додати новий дозвіл"/>                
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="permissions"
                    tableClass="table-bordered table-hover"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th class="show-record"></th>
                        <th>Код</th>
                        <th>Назва </th>
                        <th>Опис</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td class="text-center">
                            <DictionaryShowRecordLink routeName="permissions.show" :routeParamId="record.id" />                            
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

import { Modal }                from 'bootstrap';

import PermissionForm           from './Form.vue';

import DictionaryShowRecordLink from '../../components/ui/DictionaryShowRecordLink.vue';

export default {
    name: 'PermissionsMain',
    components: {
        PermissionForm,
        DictionaryShowRecordLink
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
