<template>

    <breadcrumbs />

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card" v-if="role.code">
                <div class="card-header">
                    <h5>Інформація</h5>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary btn-transparent dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <span class="mdi mdi-cogs"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a  class="dropdown-item"
                                    @click="openRoleForm">
                                        <span class="mdi mdi-pencil text-warning me-1"></span>
                                        Редагувати
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a  class="dropdown-item"
                                    @click="deleteRole(role.id)">
                                        <span class="mdi mdi-trash-can text-danger me-1"></span>
                                        Видалити
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
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

                </div>
            </div>
        </div>
    </div>

    <RoleForm
            :formData="form"
            action="update"
            @refreshData="fetchData"/>

</template>

<script>

import { Modal }    from 'bootstrap';

import RoleForm     from './Form.vue';

export default {
    name: 'RolesShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    provide() {
        return {
            modalTitle: 'Редагування ролі',
            modalSubmitCaption: 'Зберегти'
        }
    },
    data() {
        return {
            role: {},
            form: {
                id: null,
                code: '',
                name: '',
                description: ''
            },
            apiUrl: '/api/v1/roles'
        }
    },
    methods: {
        fetchData() {
            axios.get(`${this.apiUrl}/${this.id}`)
                .then(res => {
                    this.role = res.data.data
                });
        },
        openRoleForm() {
            this.form = Object.assign({}, this.role);

            var roleForm = new Modal(document.getElementById('RoleForm'))
            roleForm.show();
        },
        deleteRole(id) {
            this.$confirmDelete('Ви дійсно бажаєти видалити роль')
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`${this.apiUrl}/${id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.$router.push({name: 'roles'});
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити роль', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        }
    },
    components: {
        RoleForm
    },
    created() {
        this.fetchData()
    }
}

</script>
