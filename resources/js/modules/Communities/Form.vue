<template>

    <ModalForm  formId="CommunityForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label for="region" class="form-label">Регіон</label>
                <select class='form-control'
                        id="region"
                        v-model="formData.region_id"
                        :disabled="disabledFields.includes('region_id')">
                    <option disabled value="0">Оберить регіон</option>
                    <option :value="region.id" v-for="region in regions" :key="region.id">
                        {{region.name}}
                    </option>
                </select>
                <!-- <div id="regionValidation" class="invalid-feedback">
                    {{ getError('region_id') }}
                </div> -->
            </div>
            <div class="col">
                <label for="district" class="form-label">Район</label>
                <select class='form-control'
                        id="distric"
                        v-model="formData.district_id"
                        :disabled="disabledFields.includes('district_id')">
                    <option disabled value="0">Оберить район</option>
                    <option :value="district.id" v-for="district in districts" :key="district.id">
                        {{district.name}}
                    </option>
                </select>
                <!-- <div id="regionValidation" class="invalid-feedback">
                    {{ getError('region_id') }}
                </div> -->
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="communityName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="communityName"
                        v-model="formData.name" />
                <div id="communityNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="communityCenter" class="form-label">Адміністративний центр</label>
                <input  type="text"
                        :class="['form-control', hasError('center') ? 'is-invalid' : '']"
                        id="communityCenter"
                        v-model="formData.center" />
                <div id="communityCenterValidation" class="invalid-feedback">
                    {{ getError('center') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="communityAddress" class="form-label">Адреса</label>
                <textarea
                        :class="['form-control', hasError('address') ? 'is-invalid' : '']"
                        id="communityAddress"
                        col="2"
                        v-model="formData.address">
                </textarea>
                <div id="communityAddressValidation" class="invalid-feedback">
                    {{ getError('address') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="communityEdrpou" class="form-label">ЄДРПОУ</label>
                <input  type="text"
                        :class="['form-control', hasError('edrpou') ? 'is-invalid' : '']"
                        id="communityEdrpou"
                        v-model="formData.edrpou" />
                <div id="communityEdrpouValidation" class="invalid-feedback">
                    {{ getError('edrpou') }}
                </div>
            </div>
            <div class="col">
                <label  for="communityKoatuu" class="form-label">КОАТУУ</label>
                <input  type="text"
                        :class="['form-control', hasError('koatuu') ? 'is-invalid' : '']"
                        id="communityKoatuu"
                        v-model="formData.koatuu" />
                <div id="communityKoatuuValidation" class="invalid-feedback">
                    {{ getError('koatuu') }}
                </div>
            </div>
        </div>
    </ModalForm>

</template>

<script>
import { mapGetters } from 'vuex';

import ModalForm        from '../../components/ui/ModalForm.vue';
import FormValidator    from '../../mixins/FormValidator';

export default {
    name: 'CommunityForm',
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
            districts: []
        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post('/api/v1/communities', this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/communities/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.errors = [];
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
            this.formData.address = '';
            this.formData.edrpou = ''
            this.formData.koatuu = ''
            this.errors = [];
        },
    },
    computed: {
        ...mapGetters('Regions', ['regions']),
    },
    watch: {
        'formData.region_id' (newValue, oldValue) {
            if (newValue !== 0) {
                // this.formData.district_id = 0;
                this.districts = this.$store.getters['Districts/districts'].filter(d => d.region_id == newValue);
            }
        },
    },
    components: {
        ModalForm
    }
}
</script>
