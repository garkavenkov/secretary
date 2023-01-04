<template>

    <ModalForm  formId="HouseholdTypeForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label for="householdTypeName" class="form-label">Назва</label>
                <textarea
                        row="2"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="householdTypeName"
                        v-model="formData.name">
                </textarea>
                <div id="householdTypeNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>
import ModalForm from '../../components/ui/ModalForm.vue';
import FormValidator from '../../minixs/FormValidator';

export default {
    name: 'HouseholdTypeForm',
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
        },
        'disabledFields': {
            type: Array,
            required: false,
            default: () => []
        }
    },
    data() {
        return {
        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post('/api/v1/household-types', this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/household-types/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.errors = [];
                        this.$emit('refreshData', this.formData.id);
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
