<template>

    <ModalForm  formId="DistrictForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label for="householdType" class="form-label">Регіон</label>
                <select :class="['form-control', hasError('region_id') ? 'is-invalid' : '']"
                        id="region"
                        v-model="formData.region_id"
                        :disabled="disabledFields.includes('region_id')">
                    <option disabled value="0">Оберить регіон</option>
                    <option :value="region.id" v-for="region in regions" :key="region.id">
                        {{region.name}}
                    </option>
                </select>
                <div id="regionValidation" class="invalid-feedback">
                    {{ getError('region_id') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="regionName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="regionName"
                        v-model="formData.name" />
                <div id="regionNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="regionCenter" class="form-label">Адміністративний центр</label>
                <input  type="text"
                        :class="['form-control', hasError('center') ? 'is-invalid' : '']"
                        id="regionCenter"
                        v-model="formData.center" />
                <div id="regionCenterValidation" class="invalid-feedback">
                    {{ getError('center') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>
import { mapGetters } from 'vuex';

import ModalForm from '../../components/ui/ModalForm.vue';
import FormValidator from '../../minixs/FormValidator';

export default {
    name: 'DistrictForm',
    mixins: [FormValidator],
    props: {
        'formData': {
            type: Object,
            required: true,
            // default() {
            //     return {
            //         region_id: 0,
            //         name: '',
            //         center: ''
            //     }
            // }
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
                axios.post('/api/v1/districts', this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$store.dispatch('Districts/fetchDistricts');
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/districts/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.errors = [];
                        this.$store.dispatch('Districts/fetchDistrict', this.formData.id);
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        clearFormData() {
            this.formData.name = '';
            this.formData.center = '';
            this.errors = [];
        },
    },
    computed: {
        ...mapGetters('Regions', ['regions']),
    },
    components: {
        ModalForm
    }
}
</script>
