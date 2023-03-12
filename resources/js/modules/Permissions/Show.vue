<template>

    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="permission.code">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація</span>
                        <button class="btn btn-sm btn-light btn-transparent"
                                @click="openPermissionForm"
                                title="Редагувати дані">
                            <span class="mdi mdi-pencil"></span>
                        </button>
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
            formData: {}
        }
    },
    methods: {
        fetchData() {
            axios.get(`/api/v1/permissions/${this.id}`)
                .then(res => {
                    this.permission = res.data.data
                });
        },
        openPermissionForm() {
            this.formData = Object.assign({}, this.permission);

            var permissionForm = new Modal(document.getElementById('PermissionForm'))
            permissionForm.show();
        }
    },
    created() {
        this.fetchData()
    }
}

</script>
