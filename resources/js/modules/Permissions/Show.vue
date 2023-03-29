<template>

    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="permission.code">
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
                                    @click="openPermissionForm">
                                        <span class="mdi mdi-pencil text-warning me-1"></span>
                                        Редагувати
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a  class="dropdown-item"
                                    @click="deletePermission(permission.id)">
                                        <span class="mdi mdi-trash-can text-danger me-1"></span>
                                        Видалити
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Код
                        </div>
                        <div class="col-md-9">
                            {{ permission.code }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Назва
                        </div>
                        <div class="col-md-9">
                            {{ permission.name }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Опис
                        </div>
                        <div class="col-md-9">
                            {{ permission.description }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3">
                            Доступ заборонено
                        </div>
                        <div class="col-md-9">
                            {{ permission.error }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <PermissionForm :formData="formData" action="update" @refreshData="fetchData" />

</template>

<script>

import { Modal }        from 'bootstrap';
import PermissionForm   from './Form.vue'

export default {
    name: 'PermissionsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    components: {
        PermissionForm
    },
    provide() {
        return {
            modalTitle: 'Редагування дозволу',
            modalSubmitCaption: 'Зберегти'
        }
    },
    data() {
        return {
            permission: {},
            formData: {},
            apiUrl: '/api/v1/permissions'
        }
    },
    methods: {
        fetchData() {
            axios.get(`${this.apiUrl}/${this.id}`)
                .then(res => {
                    this.permission = res.data.data
                });
        },
        openPermissionForm() {
            this.formData = Object.assign({}, this.permission);

            var permissionForm = new Modal(document.getElementById('PermissionForm'))
            permissionForm.show();
        },
        deletePermission(id) {
            this.$confirmDelete('Ви дійсно бажаєти видалити дозвіл')
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`${this.apiUrl}/${id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.$router.push({name: 'permissions'});
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити дозвіл', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        }
    },
    created() {
        this.fetchData()
    }
}

</script>
