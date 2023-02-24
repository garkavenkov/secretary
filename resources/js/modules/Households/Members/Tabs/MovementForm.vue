<template>

    <ModalForm  formId="MovementForm"
                :submitCaption="submitCaption"
                :title="title"
                @closeForm="closeForm"
                @submitData="submitData"
                modalContentClass="second-modal">

            <div class="row mb-3">
                <div class="col">
                    <label for="movementEventType" class="form-label">Подія</label>
                    <select :class="['form-control', hasError('movement_type_id') ? 'is-invalid' : '']"
                            v-model="formData.movement_type_id">
                        <option disabled value="0">Оберить подію</option>
                        <option :value="movementType.id" v-for="movementType in movementTypes" :key="movementType.id">
                            {{movementType.name}}
                        </option>
                    </select>
                    <div id="movementEventValidation" class="invalid-feedback">
                        {{ getError('movement_type_id') }}
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label  for="movementEventDate" class="form-label">Дата</label>
                    <input  type="date"
                            :class="['form-control', hasError('date') ? 'is-invalid' : '']"
                            id="movementEvent"
                            v-model="formData.date">
                    <div id="movementEventValidation" class="invalid-feedback">
                        {{ getError('date') }}
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label  for="movementEventComment" class="form-label">Примітка</label>
                    <input  type="text"
                            :class="['form-control', hasError('comment') ? 'is-invalid' : '']"
                            id="movementEventComment"
                            v-model="formData.comment" />
                    <div id="movementEventCommentValidation" class="invalid-feedback">
                        {{ getError('comment') }}
                    </div>
                </div>
            </div>

    </ModalForm>

</template>

<script>

import ModalForm        from '../../../../components/ui/ModalForm.vue';

import FormValidator    from '../../../../minixs/FormValidator';
// import SubmitData       from '../../../../minixs/SubmitData';

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
        'title': {
            type: String,
            required: true
        },
        'submitCaption': {
            type: String,
            required: true
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
    components: {
        ModalForm
    }
}

</script>
