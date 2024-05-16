<template>

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Ролі'</span>
                <ButtonAdd buttonClass="btn-primary p-2" @click="openRoleForm" title="Додати нову роль"/>                
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="roles"
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
                            <DictionaryShowRecordLink routeName="roles.show" :routeParamId="record.id" />
                        </td>
                        <td>{{record.code}}</td>
                        <td>{{record.name}}</td>
                        <td>{{record.description}}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <RoleForm
            :formData="form"
            @refreshData="fetchData"/>

</template>

<script>

import { Modal }                from 'bootstrap';

import RoleForm                 from './Form.vue';
import DictionaryShowRecordLink from '../../components/ui/DictionaryShowRecordLink.vue';

export default {
    name: 'RolesMain',
    components: {
        RoleForm,
        DictionaryShowRecordLink
    },
    provide() {
        return {
            modalTitle: 'Новий користувач',
        }
    },
    data() {
        return {
            roles: [],
            form: {
                code: '',
                name: '',
                description: ''
            }
        }
    },
    methods: {
        fetchData() {
            axios.get('/api/v1/roles')
                .then(res => {
                    this.roles = res.data.data;
                })
        },
        openRoleForm() {
            var roleForm = new Modal(document.getElementById('RoleForm'))
            roleForm.show();
        }
    },
    created() {
        this.fetchData();
    }
}

</script>
