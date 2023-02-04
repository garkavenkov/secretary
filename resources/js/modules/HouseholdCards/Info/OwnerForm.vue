<template>

    <ModalForm formId="HouseholdOwnerModalForm"  @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label  for="ownerName" class="form-label">Прізвище І.Б.</label>
                <input  type="text"
                        :class="['form-control',  hasError('name') ? 'is-invalid' : '']"
                        id="ownerName"
                        v-model="formData.name" >
                <div id="ownerNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="ownerAddress" class="form-label">Адреса</label>
                <input  type="text"
                        :class="['form-control',  hasError('address') ? 'is-invalid' : '']"
                        @dblclick.ctrl="$emit('getHouseholdAddress')"
                        id="ownerAddress"
                        v-model="formData.address">
                <div id="ownerAddressValidation" class="invalid-feedback">
                    {{ getError('address') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>

import ModalForm        from '../../../components/ui/ModalForm.vue';
import FormValidator    from '../../../minixs/FormValidator';

export default {
    name: 'HouseholdOwnerForm',
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
    },
    data() {
        return {

        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post("/api/v1/household-owners", this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$emit('refreshData');
                        this.$toast(res.data.message);
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/household-owners/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.$emit('refreshData');
                        this.$toast(res.data.message);
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        clearFormData() {
            this.formData.name = '';
            this.formData.address = '';
            this.id = null;
        }
    },
    components: {
        ModalForm
    }
}

</script>
