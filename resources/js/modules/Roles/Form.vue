<template>

    <ModalForm  formId="RoleForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label  for="roleCode" class="form-label">Код</label>
                <input  type="text"
                        :class="['form-control', hasError('code') ? 'is-invalid' : '']"
                        id="roleCode"
                        v-model="formData.code" />
                <div id="roleCodeValidation" class="invalid-feedback">
                    {{ getError('code') }}
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label  for="roleName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="roleName"
                        v-model="formData.name" />
                <div id="roleNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label  for="roleDescription" class="form-label">Опис</label>
                <input  type="text"
                        :class="['form-control', hasError('description') ? 'is-invalid' : '']"
                        id="roleDescription"
                        v-model="formData.description" />
                <div id="roleDescriptionValidation" class="invalid-feedback">
                    {{ getError('description') }}
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
    name: 'RolesForm',
    mixins: [FormValidator, SubmitData],
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
    data() {
        return {
            apiUrl: '/api/v1/roles',
        }
    },
    methods: {
        clearFormData() {}
    },
    components: {
        ModalForm
    }
}

</script>
