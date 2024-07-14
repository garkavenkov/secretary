<template>

    <ModalForm  formId="HouseInfoForm" @submitData="submitData" @closeForm="closeForm">

        <div class="row mb-2">
            <label  for="yearBuilt"
                    class="col-md-6 col-form-label">
                Рік побудови
            </label>
            <div class="col-md-6">
                <input  type="text"
                        class="form-control"
                        id="yearBuilt"
                        name="yearBuilt"
                        v-model="formData.house_year_of_construction">
            </div>
        </div>
        <div class="row mb-2">
            <label  for="materialWalls"
                    class="col-md-6 col-form-label">
                Матеріал стін
            </label>
            <div class="col-md-6">
                <input  type="text"
                        class="form-control"
                        id="materialWalls"
                        name="materialWalls"
                        v-model="formData.house_material_walls">
            </div>
        </div>
        <div class="row">
            <label  for="materialRoof"
                    class="col-md-6 col-form-label">
                Матеріал кровлі
            </label>
            <div class="col-md-6">
                <input  type="text"
                        class="form-control"
                        id="materialRoof"
                        name="materialRoof"
                        v-model="formData.house_material_roof">
            </div>
        </div>

    </ModalForm>

</template>


<script>

import axios from 'axios';
import ModalForm from '../../../components/ui/ModalForm.vue';

export default {
    name: 'HouseholdHouseInfoForm',
    props: {
        'formData': {
            type: Object,
            required: true
        }
    },
    data() {
        return {}
    },
    emits:['refreshHouseInfo'],
    methods: {
        submitData() {
            
            // axios.post('/api/v1/house-additional-information', this.formData)
            axios.post('api/v1/set-additional-params', this.formData)
                .then(res => {
                    this.$toast(res.data.message);
                    this.$emit('refreshHouseInfo');
                })
        },
        closeForm() {}
    },
    components: {
        ModalForm
    }
}

</script>
