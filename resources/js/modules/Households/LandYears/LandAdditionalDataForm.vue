<template>

    <ModalForm  formId="LandAdditionalDataForm" @submitData="submitData" @closeForm="closeForm">

        <div class="mb-3">
            <textarea
                    class="form-control"
                    id="landAdditionalData"
                    rows="10"
                    v-model="formData.land_additional_data">
            </textarea>
        </div>

    </ModalForm>

</template>


<script>

import ModalForm from '../../../components/ui/ModalForm.vue';

export default {
    name: 'HouseholdLandAdditionalDataForm',
    props: {
        'formData': {
            type: Object,
            required: true
        }
    },
    data() {
        return {

        }
    },
    methods: {
        submitData() {
            axios.post('/api/v1/land-additional-information', this.formData)
                .then(res => {
                    this.$toast(res.data.message);
                    this.$emit('refreshData');
                    this.closeForm();
                })
        },
        closeForm() {}
    },
    components: {
        ModalForm
    }
}

</script>
