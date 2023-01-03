<template>

    <ModalForm  formId="CouncilForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label for="region" class="form-label">Регіон</label>
                <select class='form-control'
                        id="region"
                        v-model="formData.region_id"
                        :disabled="disabledFields.includes('region_id')">
                    <option disabled value="0">Оберіть регіон</option>
                    <option :value="region.id" v-for="region in regions" :key="region.id">
                        {{region.name}}
                    </option>
                </select>
            </div>
            <div class="col">
                <label for="district" class="form-label">Район</label>
                <select class='form-control'
                        id="district"
                        v-model="formData.district_id"
                        :disabled="disabledFields.includes('district_id')">
                    <option disabled value="0">Оберіть район</option>
                    <option :value="district.id" v-for="district in districts" :key="district.id">
                        {{district.name}}
                    </option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="community" class="form-label">Громада</label>
                <select :class="['form-control', hasError('community_id') ? 'is-invalid' : '']"
                        id="community"
                        v-model="formData.community_id"
                        :disabled="disabledFields.includes('community_id')">
                    <option disabled value="0">Оберіть громаду</option>
                    <option :value="community.id" v-for="community in communities" :key="community.id">
                        {{community.name}}
                    </option>
                </select>
                <div id="communityValidation" class="invalid-feedback">
                    {{ getError('community_id') }}
                </div>
            </div>
            <div class="col">
                <label for="councilType" class="form-label">Тип ради</label>
                <select :class="['form-control', hasError('council_type_id') ? 'is-invalid' : '']"
                        id="councilType"
                        v-model="formData.council_type_id">
                    <option disabled value="0">Оберіть тип ради</option>
                    <option :value="councilType.id" v-for="councilType in councilTypes" :key="councilType.id">
                        {{councilType.name}}
                    </option>
                </select>
                <div id="householdTypeValidation" class="invalid-feedback">
                    {{ getError('council_type_id') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="councildName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="councilName"
                        v-model="formData.name" />
                <div id="councilNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="councildAddress" class="form-label">Місцезнаходження / адреса</label>
                <textarea
                        :class="['form-control', hasError('address') ? 'is-invalid' : '']"
                        id="councilAddress"
                        rows="2"
                        v-model="formData.address">
                </textarea>
                <div id="councilAddressValidation" class="invalid-feedback">
                    {{ getError('address') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="councilEdrpou" class="form-label">ЕДРПОУ</label>
                <input  type="text"
                        :class="['form-control', hasError('edrpou') ? 'is-invalid' : '']"
                        id="councilEdrpou"
                        v-model="formData.edrpou" />
                <div id="councilEdrpouValidation" class="invalid-feedback">
                    {{ getError('edrpou') }}
                </div>
            </div>
            <div class="col">
                <label for="councilKoatuu" class="form-label">КОАТУУ</label>
                <input  type="text"
                        :class="['form-control', hasError('koatuu') ? 'is-invalid' : '']"
                        id="councilKoatuu"
                        v-model="formData.koatuu" />
                <div id="councilKoatuuValidation" class="invalid-feedback">
                    {{ getError('koatuu') }}
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
    name: 'CouncilForm',
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
            districts: [],
            communities: []
        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post('/api/v1/councils', this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/councils/${this.formData.id}`, this.formData)
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
            this.formData.region_id         = 0;
            this.formData.district_id       = 0;
            this.formData.community_id      = 0;
            this.formData.council_type_id   = 0;
            this.formData.name              = '';
            this.formData.address           = '';
            this.formData.edrpou            = '';
            this.formData.koatuu            = '';

            this.errors = [];
        },
    },
    computed: {
        ...mapGetters('Regions', ['regions']),
        ...mapGetters('CouncilTypes', ['councilTypes']),
        ...mapGetters('Councils', ['councils']),
    },
    watch: {
        'formData.region_id' (newValue, oldValue) {
            if (newValue !== 0) {
                // this.formData.district_id = 0;
                this.districts = this.$store.getters['Districts/districts'].filter(d => d.region_id == newValue);
            }
        },
        'formData.district_id' (newValue, oldValue) {
            if (newValue !== 0) {
                // this.formData.community_id = 0;
                this.communities = this.$store.getters['Communities/communities'].filter(c => c.district_id == newValue);
            }
        },
    },
    components: {
        ModalForm
    }
}
</script>
