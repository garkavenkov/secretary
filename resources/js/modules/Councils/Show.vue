<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="council.name">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація о раді</span>
                        <button class="btn btn-sm btn-light" @click="openCouncilForm" title="Редагувати дані">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">Назва</div>
                            <div class="col-md-9">{{ council.name }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">Адреса</div>
                            <div class="col-md-9">{{ council.address }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">ЕДРПОУ</div>
                            <div class="col-md-9">{{ council.edrpou }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">КОАТУУ</div>
                            <div class="col-md-9">{{ council.koatuu }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">Громада</div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'CommunitiesShow', params: {id: council.community_id}}">
                                    {{ council.community.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                                <span>Підпорядковані населенні пункти</span>
                                <button class="btn btn-sm btn-light" title="Додати населенний пункт" @click="openSettlementForm">
                                    <span class="mdi mdi-plus"></span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <DataTable  :dataTable="council.settlements"
                                        tableHeaderClass="table-dark">
                                <template v-slot:header>
                                    <tr>
                                        <th>Назва</th>
                                        <th>Індекс</th>
                                        <th>КАТОТТГ</th>
                                    </tr>
                                </template>
                                <template v-slot:default="slotProps">
                                    <tr     v-for="record in slotProps.paginatedData"
                                            :key="record.id">
                                        <td>
                                            <router-link :to="{name: 'SettlementsShow', params: { id: record.id }}">
                                                <!-- <i class="bi bi-eye"></i> -->
                                                <td>{{record.name}}</td>
                                            </router-link>
                                        </td>
                                        <td>{{record.postcode}}</td>
                                        <td>{{record.katottg}}</td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <CouncilForm
            :formData="councilFormData"
            action="update"
            @refreshData="$store.dispatch('Councils/fetchRecord', id)" />


    <SettlementForm
            :formData="settlementFormData"
            :disabledFields="['region_id', 'district_id', 'community_id', 'council_id']"
            @refreshData="$store.dispatch('Councils/fetchRecord', id)" />

</template>

<script>
import { Modal } from 'bootstrap';
import { computed } from 'vue';
import { mapGetters } from 'vuex';

import DataTable from '../../components/ui/DataTable.vue';
import CouncilForm from './Form.vue';
import SettlementForm from '../Settlements/Form.vue';

export default {
    name: 'CouncilsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            councilFormData: {
                id:                 null,
                region_id:          0,
                district_id:        0,
                community_id:       0,
                council_type_id:    0,
                name:               '',
                address:            '',
                edrpou:             '',
                koatuu:             '',
            },
            settlementFormData: {
                region_id             : 0,
                district_id           : 0,
                community_id          : 0,
                council_id            : 0,
                settlement_type_id    : 0,
                name                  : '',
                postcode              : '',
                inner_code            : '',
                katottg               : '',
            },
            modalTitle: '',
            modalSubmitCaption: ''
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        openCouncilForm() {
            let myModal = new Modal(document.getElementById('CouncilForm'))

            this.modalTitle         = 'Редагувати раду';
            this.modalSubmitCaption = 'Зберегти';

            this.councilFormData.id                 =   this.council.id;
            this.councilFormData.region_id          =   this.council.community.district.region_id;
            this.councilFormData.district_id        =   this.council.community.district_id;
            this.councilFormData.community_id       =   this.council.community_id;
            this.councilFormData.council_type_id    =   this.council.council_type_id;
            this.councilFormData.name               =   this.council.name;
            this.councilFormData.center             =   this.council.center;
            this.councilFormData.address            =   this.council.address;
            this.councilFormData.edrpou             =   this.council.edrpou;
            this.councilFormData.koatuu             =   this.council.koatuu;

            myModal.show();
        },
        openSettlementForm() {
            let myModal = new Modal(document.getElementById('SettlementForm'))

            this.modalTitle         = 'Новий населенний пункт';
            this.modalSubmitCaption = 'Додати';

            this.settlementFormData.region_id          =   this.council.community.district.region_id;
            this.settlementFormData.district_id        =   this.council.community.district_id;
            this.settlementFormData.community_id       =   this.council.community_id;
            this.settlementFormData.council_id         =   this.council.id;

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('Councils', ['council']),
    },
    created() {
        this.$store.dispatch('Councils/fetchRecord', this.id)
    },
    components: {
        DataTable,
        CouncilForm,
        SettlementForm,
    }
}
</script>
