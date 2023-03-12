<template>

    <ModalForm formId="CategoryForm" @submitData="submitData" @closeForm="closeForm">

        <div class="row mb-3">
            <div class="col">
                <label  for="categoryCode" class="form-label">Код</label>
                <input  type="text"
                        :class="['form-control', hasError('code') ? 'is-invalid' : '']"
                        id="categoryCode"
                        v-model="formData.code">
                <div id="categoryCodeValidation" class="invalid-feedback">
                    {{ getError('code') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="categoryName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="categoryName"
                        v-model="formData.name">
                <div id="categoryNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>

        </div>

    </ModalForm>

</template>


<script>
import ModalForm        from "../../components/ui/ModalForm.vue"

import SubmitData       from '../../mixins/SubmitData';
import FormValidator    from "../../mixins/FormValidator";

export default {
    name: 'AdditionalParamCategoryForm',
    mixins: [SubmitData, FormValidator],
    props: {
        'formData': {
            type: Object,
            required: true
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        }
    },
    data() {
        return {
            apiUrl: '/api/v1/additional-param-categories',
        }
    },
    methods: {
        clearFormData() {
            this.formData.code = '';
            this.formData.name = '';
            this.errors = [];
        },
        closeForm() {
            this.clearFormData()
        }
    },
    components: {
        ModalForm
    }
}


</script>
