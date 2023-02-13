<template>

    <ModalForm formId="ReportForm" @submitData="submitData" @closeForm="closeForm">

        <div class="row mb-3">
            <div class="col">
                <label  for="reportName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="reportName"
                        v-model="formData.name" />
                <div id="reportNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="reportDescription" class="form-label">Опис</label>
                <input  type="text"
                        :class="['form-control', hasError('description') ? 'is-invalid' : '']"
                        id="reportDescription"
                        v-model="formData.description" />
                <div id="regionNameValidation" class="invalid-feedback">
                    {{ getError('description') }}
                </div>
            </div>
        </div>
          <div class="row mb-3">
            <div class="col">
                <label for="reportModel" class="form-label">Модель</label>
                <select :class="['form-control', hasError('model') ? 'is-invalid' : '']"
                        id="reporModel"
                        v-model="formData.model"
                        :disabled="disabledFields.includes('model')">
                    <option disabled value="0">Оберить модель</option>
                    <option :value="model.code" v-for="model in models" :key="model.id">
                        {{model.name}}
                    </option>
                </select>
                <div id="modelReportValidation" class="invalid-feedback">
                    {{ getError('model') }}
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Шаблон документа</label>
            <input class="form-control" type="file" id="formFile">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="reportIcon" class="form-label">Іконка</label>
                <input  type="text"
                        :class="['form-control', hasError('icon') ? 'is-invalid' : '']"
                        id="reportIcon"
                        v-model="formData.icon" />
                <div id="reportIconValidation" class="invalid-feedback">
                    {{ getError('icon') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>

import FormValidator    from '../../minixs/FormValidator';

import ModalForm        from '../../components/ui/ModalForm.vue';

export default {
    name: 'ReportForm',
    props: {
        'formData': {
            type: Object,
            required: true,
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        },
        'models': {
            type: Array,
            required: true,
        },
        'disabledFields': {
            type: Array,
            required: false,
            default: () => [],
        }
    },
    mixins: [FormValidator],
    data() {
        return {

        }
    },
    methods: {
        submitData() {},
        closeForm() {}
    },
    components: {
        ModalForm,
    }
}

</script>
