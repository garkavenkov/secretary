<template>

    <ModalForm  :formId="formId" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label :for="fieldId" class="form-label">Назва</label>
                <textarea
                        row="2"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        :id="fieldId"
                        v-model="formData.name">
                </textarea>
                <div :id="`${fieldId}Validation`" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>
import ModalForm        from '../../components/ui/ModalForm.vue';
import FormValidator    from '../../mixins/FormValidator';

export default {
    name: 'SystemDictionaryForm',
    mixins: [FormValidator],
    props: {
        'formId': {
            type: String,
            required: true
        },
        'fieldId': {
            type: String,
            required: true
        },
        'url': {
            type: String,
            required: true
        },
        'formData': {
            type: Object,
            required: true,
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        },
    },
    data() {
        return {
        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post(this.url, this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`${this.url}/${this.formData.id}`, this.formData)
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
            this.errors = [];
        },
    },
    components: {
        ModalForm
    }
}
</script>
