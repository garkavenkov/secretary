<template>

    <ModalForm  formId="PermissionForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label  for="permissionCode" class="form-label">Код</label>
                <input  type="text"
                        :class="['form-control', hasError('code') ? 'is-invalid' : '']"
                        id="permissionCode"
                        v-model="formData.code" />
                <div id="permissionCodeValidation" class="invalid-feedback">
                    {{ getError('code') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="permissionName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="permissionName"
                        v-model="formData.name" />
                <div id="permissionNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="permissionDescription" class="form-label">Опис</label>
                <input  type="text"
                        :class="['form-control', hasError('description') ? 'is-invalid' : '']"
                        id="permissionDescription"
                        v-model="formData.description" />
                <div id="permissionDescriptionValidation" class="invalid-feedback">
                    {{ getError('description') }}
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label  for="permissionError" class="form-label">Відмова в доступі</label>
                <textarea
                        :class="['form-control', hasError('error') ? 'is-invalid' : '']"
                        id="permissionError"
                        rows="2"
                        v-model="formData.error">
                </textarea>
                <div id="permissionDescriptionValidation" class="invalid-feedback">
                    {{ getError('error') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>

import ModalForm        from '../../components/ui/ModalForm.vue';

import FormValidator    from '../../mixins/FormValidator';
import SubmitData       from '../../mixins/SubmitData';

export default {
    name: 'PermissionForm',
    components: {
        ModalForm
    },
    props: {
        'formData': {
            type: Object,
            required: true,
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        }
    },
    mixins: [FormValidator, SubmitData],
    data() {
        return {
            apiUrl: '/api/v1/permissions'
        }
    },
    methods: {
        clearFormData() {
            this.formData.code = '';
            this.formData.name = '';
            this.formData.description = '';
            this.formData.error = '';

            this.errors = [];
        }
    }
}

</script>
