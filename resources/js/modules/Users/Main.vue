<template>

    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Користувачі</span>
                <button class="btn btn-sm btn-primary" @click="openUserForm">
                    <span class="mdi mdi-plus"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="users"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Прізвище Ім'я по Батькові</th>
                        <th>Логін</th>
                        <th>Посада</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'users.profile', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{ record.name }}</td>
                        <td>{{ record.user_name }}</td>
                        <td>{{ record.position }}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <UserForm
            :formData="form"
            @refreshData="fetchUsers"/>

</template>


<script>

import { Modal } from 'bootstrap';

import DataTable from '../../components/ui/DataTable.vue'

import UserForm  from './Form.vue';

export default {
    name: 'UsersMain',
    provide() {
        return {
            modalTitle: 'Новий користувач',
        }
    },
    data() {
        return {
            users: [],
            form: {
                // surname: '',
                name: '',
                // patronymic: '',
                user_name: '',
                email: '',
                position: '',
                password: '',
                password_confirm: ''
            }
        }
    },
    methods: {
        fetchUsers() {
            axios.get(`/api/v1/users`)
                .then(res => {
                    this.users = res.data.data
                })
        },
        openUserForm() {

            this.form.name = '';
            this.form.user_name = '';
            this.form.email = '';
            this.form.position = '';
            this.form.password = '';
            this.form.password_confirm = '';

            var userForm = new Modal(document.getElementById('UserForm'))
            userForm.show();
        }
    },
    components: {
        DataTable,
        UserForm
    },
    created() {
        this.fetchUsers();
    }
}

</script>
