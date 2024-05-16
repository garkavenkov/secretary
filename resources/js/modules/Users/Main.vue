<template>

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Користувачі</span>
                <ButtonAdd buttonClass="btn btn-primary p-2" @click="openUserForm" title="Додати нового користувача"/>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="users"
                    tableClass="table-bordered table-hover"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th class="show-record"></th>
                        <th>Прізвище Ім'я по Батькові</th>
                        <th>Логін</th>
                        <th>Посада</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td class="text-center">
                            <DictionaryShowRecordLink routeName="users.profile" :routeParamId="record.id" />
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

import { Modal }                from 'bootstrap';

import UserForm                 from './Form.vue';

import DataTable                from '../../components/ui/DataTable.vue'
import DictionaryShowRecordLink from '../../components/ui/DictionaryShowRecordLink.vue';


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
                password_confirmation: ''
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
            this.form.password_confirmation = '';

            var userForm = new Modal(document.getElementById('UserForm'))
            userForm.show();
        }
    },
    components: {
        DataTable,
        UserForm,
        DictionaryShowRecordLink
    },
    created() {
        this.fetchUsers();
    }
}

</script>
