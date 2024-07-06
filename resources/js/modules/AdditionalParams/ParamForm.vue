<template>

    <ModalForm formId="ParamForm" @submitData="submitData" @closeForm="closeForm" :sumbitIsDisabled="!readyFodSubmit" modalClass="modal-lg">

        <!-- <div class="row mb-3">
            <div class="col">
                <span class="category-name">Категорія: {{ category.name }}</span>
            </div>
        </div> -->        
        <div class="row mb-3">          
            <div class="col">
                <label  for="paramCode" class="form-label">Код</label>
                <input  type="text"
                        :class="['form-control', hasError('code') ? 'is-invalid' : '']"
                        id="paramCode"
                        v-model="formData.code">
                <div id="paramCodeValidation" class="invalid-feedback">
                    {{ getError('code') }}
                </div>
            </div>           
        </div>        
        <div class="row mb-3">
            <div class="col">
                <label  for="paramName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="paramName"
                        v-model="formData.name">
                <div id="paramNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="paramValueType" class="form-label">Тип параметру</label>
                <select :class="['form-control', hasError('value_type_id') ? 'is-invalid' : '']"
                        id="paramValueType"
                        v-model="formData.value_type_id">
                    <option disabled value="0">Оберіть тип параметру</option>
                    <option :value="valueType.id" v-for="valueType in valueTypes" :key="valueType.id">
                        {{valueType.description}}
                    </option>
                </select>
                <div id="paramValueTypeValidation" class="invalid-feedback">
                    {{ getError('value_type_id') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="paramMask" class="form-label">Шаблон</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="paramMask"
                        v-model="formData.mask">
                <div id="paramMaskValidation" class="invalid-feedback">
                    {{ getError('mask') }}
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <span class="category-name">Додаткове налаштування</span>
            </div>
        </div>

        

    </ModalForm>

</template>


<script>
import ModalForm        from "../../components/ui/ModalForm.vue"

import SubmitData       from '../../mixins/SubmitData';
import FormValidator    from "../../mixins/FormValidator";

export default {
    name: 'AdditionalParamForm',
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
        },
        // 'category': {
        //     type: Object,
        //     required: true
        // },
        'valueTypes': {
            type: Array,
            required: true
        }
    },
    emits: ['refreshData'],
    data() {
        return {
            apiUrl: '/api/v1/additional-params',            
        }
    },
    methods: {
        clearFormData() {
            this.formData.code          = '';
            this.formData.name          = '';
            this.formData.mask          = '';
            this.formData.value_type_id = 0;
            this.errors                 = [];
        },
        closeForm() {
            // this.formData.category_id = null;
            // this.formData.code = '';
            // this.formData.name = '';
            // this.errors = [];
            this.clearFormData();
        }
    },
    computed: {
        readyFodSubmit() {
            return (this.formData.name !== '') && (this.formData.code !== '');
        }
    },
    components: {
        ModalForm
    }
}


</script>


<style lang="scss" scoped>
.category-name {
    font-size: 1rem;
}
</style>
