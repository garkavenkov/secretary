<template>

    <ModalForm  formId="MovementForm"                
                @closeForm="closeForm"
                @submitData="submitData"
                :sumbitIsDisabled="!readyForSubmit"
                modalContentClass="second-modal">

            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="movementEventType" class="form-label">Подія</label>
                    <select :class="['form-control', hasError('movement_type_id') ? 'is-invalid' : '']"
                            v-model="formData.movement_type_id"
                            id="movementEventType">
                        <option disabled value="0">Оберить подію</option>
                        <option :value="movementType.id" v-for="movementType in movementTypes" :key="movementType.id">
                            {{movementType.name}}
                        </option>
                    </select>
                    <div id="movementEventValidation" class="invalid-feedback">
                        {{ getError('movement_type_id') }}
                    </div>
                </div>
                <div class="col-md-4">
                    <label  for="movementEventDate" class="form-label">Дата</label>
                    <input  type="date"
                            :class="['form-control', hasError('date') ? 'is-invalid' : '']"
                            id="movementEventDate"
                            v-model="formData.date">
                    <div id="movementEventValidation" class="invalid-feedback">
                        {{ getError('date') }}
                    </div>
                </div>
            </div>            
            <div class="row mb-3">
                <div class="col">
                    <label  for="movementEventComment" class="form-label">Примітка</label>
                    <textarea
                        :class="['form-control', hasError('comment') ? 'is-invalid' : '']"
                        id="movementEventComment"
                        rows="2"
                        v-model="formData.comment">
                    </textarea>
                    <div id="movementEventCommentValidation" class="invalid-feedback">
                        {{ getError('comment') }}
                    </div>
                </div>
            </div>

    </ModalForm>

</template>

<script>

import ModalForm        from '../../../components/ui/ModalForm.vue';

import FormValidator    from '../../../mixins/FormValidator';

export default {
    name: 'MovementForm',
    mixins: [FormValidator, ],
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
        'movementTypes': {
            type: Array,
            required: true
        }
    },
    emits:['refreshData'],
    data() {
        return {
            apiUrl: '/api/v1/household-member-lands'
        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post('/api/v1/household-member-movements', this.formData)
                    .then(res => {
                        this.$toast(res.data.message);
                        axios.get(`/api/v1/household-members/${this.formData.member_id}`)
                            .then(res => {
                                this.$emit('refreshData');
                                this.clearForm();
                            })
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/household-member-movements/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.$toast(res.data.message);
                        axios.get(`/api/v1/household-members/${this.formData.member_id}`)
                            .then(res => {
                                this.$emit('refreshData');
                            })
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        clearForm() {
            this.formData.date = null;
            this.formData.movement_type_id = 0;
            this.formData.comment = '';

            this.errors = [];
        },
        closeForm() {
            this.clearForm();
        }
    },
    computed: {
        readyForSubmit() {
            return this.formData.date != null && this.formData.movement_type_id != 0 && this.formData.comment != '';
        }
    },
    components: {
        ModalForm
    }
}

</script>
