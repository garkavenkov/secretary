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
                <label  for="ownerAddress"
                        class="form-label"
                        @click="$emit('getHouseholdAddress')"
                        style="cursor:copy;"
                        title="Клікніть для використання адреси домогосподарства">
                    Адреса
                </label>
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
import SubmitData       from '../../../minixs/SubmitData';

export default {
    name: 'HouseholdOwnerForm',
    mixins: [FormValidator, SubmitData],
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
            apiUrl: '/api/v1/household-owners',
        }
    },
    methods: {
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
