<template>

    <ModalForm  formId="HouseAdditionalDataForm" @submitData="submitData" @closeForm="closeForm">

        <div class="mb-3">
            <textarea
                    class="form-control"
                    id="houseAdditionalData"
                    rows="10"
                    v-model="formData.house_additional_data">
            </textarea>
        </div>

    </ModalForm>

</template>


<script>

import ModalForm from '../../../components/ui/ModalForm.vue';

export default {
    name: 'HouseholdHouseAdditionalDataForm',
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
    emits:['refreshHouseInfo'],
    methods: {
        submitData() {
            axios.post('api/v1/set-additional-params', this.formData)
                .then(res => {
                    this.$toast(res.data.message);
                    this.$emit('refreshHouseInfo');
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
