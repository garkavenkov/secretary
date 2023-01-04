<template>

    <ModalForm  formId="SettlementForm" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-lg">

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
                <select class='form-control'
                        id="community"
                        v-model="formData.community_id"
                        :disabled="disabledFields.includes('community_id')">
                    <option disabled value="0">Оберіть громаду</option>
                    <option :value="community.id" v-for="community in communities" :key="community.id">
                        {{community.name}}
                    </option>
                </select>
            </div>
            <div class="col">
                <label for="council" class="form-label">Міська / сільська рада</label>
                <select class='form-control'
                        id="council"
                        v-model="formData.council_id"
                        :disabled="disabledFields.includes('council_id')">
                    <option disabled value="0">Оберіть раду</option>
                    <option :value="council.id" v-for="council in councils" :key="council.id">
                        {{council.name}}
                    </option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-8">
                <label for="settlementName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="settlementName"
                        v-model="formData.name" />
                <div id="settlementNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
            <div class="col">
                <label for="settlementType" class="form-label">Тип ради</label>
                <select :class="['form-control', hasError('settlement_type_id') ? 'is-invalid' : '']"
                        id="settlementType"
                        v-model="formData.settlement_type_id">
                    <option disabled value="0">Оберіть тип ради</option>
                    <option :value="settlementType.id" v-for="settlementType in settlementTypes" :key="settlementType.id">
                        {{settlementType.name}}
                    </option>
                </select>
                <div id="settlementTypeValidation" class="invalid-feedback">
                    {{ getError('settlement_type_id') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="settlementPostcode" class="form-label">Поштовий індекс</label>
                <input  type="text"
                        :class="['form-control', hasError('postcode') ? 'is-invalid' : '']"
                        id="settlementPostcode"
                        v-model="formData.postcode" />
                <div id="settlementPostcodeValidation" class="invalid-feedback">
                    {{ getError('postcode') }}
                </div>
            </div>
            <div class="col-4">
                <label for="settlementKatottg" class="form-label">КАТОТТГ</label>
                <input  type="text"
                        :class="['form-control', hasError('katottg') ? 'is-invalid' : '']"
                        id="settlementKatottg"
                        v-model="formData.katottg" />
                <div id="settlementKatottgValidation" class="invalid-feedback">
                    {{ getError('katottg') }}
                </div>
            </div>
            <div class="col">
                <label for="settlementInnerCode" class="form-label">Внутрішній код</label>
                <input  type="text"
                        :class="['form-control', hasError('inner_code') ? 'is-invalid' : '']"
                        id="settlementInnerCode"
                        v-model="formData.inner_code" />
                <div id="settlementInnerCodeValidation" class="invalid-feedback">
                    {{ getError('inner_code') }}
                </div>
            </div>
        </div>
        <!-- <div class="row mb-3">
        </div> -->

    </ModalForm>

</template>

<script>
import { mapGetters } from 'vuex';

import ModalForm from '../../components/ui/ModalForm.vue';
import FormValidator from '../../minixs/FormValidator';

export default {
    name: 'SettlementForm',
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
            communities: [],
            councils: [],
        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post('/api/v1/settlements', this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/settlements/${this.formData.id}`, this.formData)
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
            this.formData.region_id             = 0;
            this.formData.district_id           = 0;
            this.formData.community_id          = 0;
            this.formData.council_id            = 0;
            this.formData.settlement_type_id    = 0;
            this.formData.name                  = '';
            this.formData.postcode              = '';
            this.formData.inner_code            = '';
            this.formData.katottg               = '';

            this.errors = [];
        },
    },
    computed: {
        ...mapGetters('Regions', ['regions']),
        ...mapGetters('SettlementTypes', ['settlementTypes']),
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
        'formData.community_id' (newValue, oldValue) {
            if (newValue !== 0) {
                // this.formData.community_id = 0;
                this.councils = this.$store.getters['Councils/councils'].filter(c => c.community_id == newValue);
            }
        },
    },
    components: {
        ModalForm
    }
}
</script>
