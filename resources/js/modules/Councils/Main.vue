<script>
import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap';
import FormValidator    from '../../minixs/FormValidator';

import DataTable        from '../../components/ui/DataTable.vue';

export default {
    name: 'CouncilsMain',
    mixins: [FormValidator],
    components: {
        DataTable
    },
    data() {
        return {
            formData: {
                region_id:          0,
                district_id:        0,
                community_id:       0,
                council_type_id:    0,
                name:               '',
                address:            '',
                edrpou:             '',
                koatuu:             '',
            },
            districts: [],
            communities: [],
            modalTitle: '',
            modalSubmitCaption: '',
        }
    },
    methods: {
        addCouncil() {
            var myModal = new Modal(document.getElementById('CouncilForm'))
            this.modalTitle = 'Нова рада';
            this.modalSubmitCaption = 'Додати';
            myModal.show();
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
        submitData() {
            axios.post('/api/v1/councils', this.formData)
                .then(res => {
                    this.clearFormData();
                    this.$store.dispatch('Councils/fetchData');
                })
                .catch(err => {
                    this.errors = err.response.data.errors;
                })
        }

    },
    computed: {
        ...mapGetters('Regions', ['regions']),
        // ...mapGetters('Districts', ['districts']),
        // ...mapGetters('Communities', ['communities']),
        ...mapGetters('CouncilTypes', ['councilTypes']),
        ...mapGetters('Councils', ['councils']),
    },
    watch: {
        'formData.region_id' (newValue, oldValue) {
            if (newValue !== 0) {
                this.formData.district_id = 0;
                this.districts = this.$store.getters['Districts/districts'].filter(d => d.region_id == newValue);
            }
        },
        'formData.district_id' (newValue, oldValue) {
            if (newValue !== 0) {
                this.formData.community_id = 0;
                this.communities = this.$store.getters['Communities/communities'].filter(c => c.district_id == newValue);
            }
        },
        'formData.community_id' (newValue, oldValue) {
            if (this.errors['community_id']) {
                delete this.errors['community_id'];
            }
        },
        'formData.council_type_id' (newValue, oldValue) {
            if (this.errors['council_type_id']) {
                delete this.errors['council_type_id'];
            }
        },
        'formData.name' (newValue, oldValue) {
            if (this.errors['name']) {
                delete this.errors['name'];
            }
        },
        'formData.address' (newValue, oldValue) {
            if (this.errors['address']) {
                delete this.errors['address'];
            }
        },
        'formData.edrpou' (newValue, oldValue) {
            if (this.errors['edrpou']) {
                delete this.errors['edrpou'];
            }
        },
        'formData.koatuu' (newValue, oldValue) {
            if (this.errors['koatuu']) {
                delete this.errors['koatuu'];
            }
        },
    }
}
</script>

<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник "Міські / сільські ради"</span>
                <button class="btn btn-sm btn-primary" @click="addCouncil">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-funnel"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="councils"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Громада</th>
                        <!-- <th>Тип</th> -->
                        <th>Назва </th>
                        <th>Адреса</th>
                        <th>ЕДРПОУ</th>
                        <th>КОАТУУ</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'CouncilsShow', params: { id: record.id }}">
                                <i class="bi bi-eye"></i>
                            </router-link>
                        </td>
                        <td>{{record.community.name}}</td>
                        <!-- <td>{{record.council_type.name}}</td> -->
                        <td>{{record.name}}</td>
                        <td>{{record.address}}</td>
                        <td>{{record.edrpou}}</td>
                        <td>{{record.koatuu}}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <div class="modal modal-lg fade" id="CouncilForm" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel" v-html="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clearFormData"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="region" class="form-label">Регіон</label>
                            <select class='form-control'
                                    id="region"
                                    v-model="formData.region_id">
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
                                    v-model="formData.district_id">
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
                                    v-model="formData.community_id">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">Відмінити</button>
                    <button type="button" class="btn btn-primary" @click="submitData">{{modalSubmitCaption}}</button>
                </div>
            </div>
        </div>
    </div>

</template>
