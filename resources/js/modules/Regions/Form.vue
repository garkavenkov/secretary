<template>

    <ModalForm  formId="RegionForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label  for="regionName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="regionName"
                        v-model="formData.name" />
                <div id="regionNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="regionCenter" class="form-label">Обласний центр</label>
                <input  type="text"
                        :class="['form-control', hasError('center') ? 'is-invalid' : '']"
                        id="regionCenter"
                        v-model="formData.center" />
                <div id="regionCenterValidation" class="invalid-feedback">
                    {{ getError('center') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>

import ModalForm        from '../../components/ui/ModalForm.vue';
import FormValidator    from '../../minixs/FormValidator';

export default {
    name: 'RegionsForm',
    mixins: [FormValidator],
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
        return {}
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post('/api/v1/regions', this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/regions/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.errors = [];
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        clearFormData() {
            this.formData.name = '';
            this.formData.center = '';
            this.errors = [];
        },
    },
    components: {
        ModalForm
    }
}
</script>
