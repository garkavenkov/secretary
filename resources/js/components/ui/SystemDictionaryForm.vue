<template>

    <ModalForm  :formId="formId" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3" v-for="(field,index) in fields" :key="index">
            <div class="col">
                <label :for="field.fieldId" class="form-label" :class="{'is-invalid': hasError(field.name) }">{{ field.title }}</label>
                <textarea
                        row="2"
                        class="form-control"
                        :class="{ 'is-invalid': hasError(field.name) }"
                        :id="field.fieldId"
                        v-model="formData[field.name]">
                </textarea>
                <div :id="`${field.fieldId}Validation`" class="invalid-feedback" v-if="field.validate">
                    {{ getError(field.name) }}
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
        formId: {
            type: String,
            required: true
        },
        fields: {
            type: Array,
            required: true
        },        
        url: {
            type: String,
            required: true
        },
        formData: {
            type: Object,
            required: true,
        },
        action: {
            type: String,
            required: false,
            default: 'create'
        },
    },
    emits: ['refreshData'],
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
                        this.$toast(res.data.message);
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`${this.url}/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.errors = [];
                        this.$toast(res.data.message);
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
