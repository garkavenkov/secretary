<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="community.name">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація о громаді</span>
                        <button class="btn btn-sm btn-light" @click="openCommunityForm" title="Редагувати дані">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Назва
                            </div>
                            <div class="col-md-9">
                                {{ community.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Адміністративний центр
                            </div>
                            <div class="col-md-9">
                                {{ community.center }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Адреса
                            </div>
                            <div class="col-md-9">
                                {{ community.address }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                ЕДРПОУ
                            </div>
                            <div class="col-md-9">
                                {{ community.edrpou }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                КОАТУУ
                            </div>
                            <div class="col-md-9">
                                {{ community.koatuu }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Район
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'DistrictsShow', params: {id: community.district.id}}">
                                    {{ community.district.name }}
                                </router-link>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Регіон
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'RegionsShow', params: {id: community.district.region.id}}">
                                    {{ community.district.region.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                                <span>Міські / сільські ради в громаді</span>
                                <button class="btn btn-sm btn-light" title="Додати раду"  @click="openCouncilForm">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <DataTable  :dataTable="community.councils"
                                        tableHeaderClass="table-dark">
                                <template v-slot:header>
                                    <tr>
                                        <th>Назва</th>
                                        <th>Адреса</th>
                                    </tr>
                                </template>
                                <template v-slot:default="slotProps">
                                    <tr     v-for="record in slotProps.paginatedData"
                                            :key="record.id">
                                        <td>
                                            <router-link :to="{name: 'CouncilsShow', params: { id: record.id }}">
                                                <td>{{record.name}}</td>
                                            </router-link>
                                        </td>
                                        <td>{{ record.address }}</td>
                                    </tr>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <CommunityForm
            :formData="communityFormData"
            action='update'
            @refreshData="$store.dispatch('Communities/fetchRecord', id)"/>

    <CouncilForm
            :formData="councilFormData"
            @refreshData="$store.dispatch('Communities/fetchRecord', id)"
            :disabledFields="['region_id', 'district_id', 'community_id']"/>

</template>

<script>
import { mapGetters } from 'vuex';
import { computed } from 'vue';
import { Modal } from 'bootstrap';

import DataTable from '../../components/ui/DataTable.vue';
import CommunityForm from './Form.vue';
import CouncilForm from '../Councils/Form.vue';

export default {
    name: 'CommunitiesShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            communityFormData: {
                id: null,
                region_id: 0,
                district_id: 0,
                name:   '',
                center: '',
                address:'',
                edrpou: '',
                koatuu: ''
            },
            councilFormData: {
                region_id:          0,
                district_id:        0,
                community_id:       0,
                council_type_id:    0,
                name:               '',
                address:            '',
                edrpou:             '',
                koatuu:             '',
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
        openCommunityForm() {
            let myModal = new Modal(document.getElementById('CommunityForm'))

            this.modalTitle         = 'Редагувати громаду';
            this.modalSubmitCaption = 'Зберегти';

            this.communityFormData.id           =   this.community.id;
            this.communityFormData.region_id    =   this.community.district.region_id;
            this.communityFormData.district_id  =   this.community.district_id;
            this.communityFormData.name         =   this.community.name;
            this.communityFormData.center       =   this.community.center;
            this.communityFormData.address      =   this.community.address;
            this.communityFormData.edrpou       =   this.community.edrpou;
            this.communityFormData.koatuu       =   this.community.koatuu;

            myModal.show();
        },
        openCouncilForm() {
            let myModal = new Modal(document.getElementById('CouncilForm'))

            this.modalTitle         = 'Нава рада';
            this.modalSubmitCaption = 'Додати';

            this.councilFormData.region_id      =   this.community.district.region_id;
            this.councilFormData.district_id    =   this.community.district_id;
            this.councilFormData.community_id   =   this.community.id;
            // this.councilFormData.council_type_id
            // this.councilFormData.name
            // this.councilFormData.address
            // this.councilFormData.edrpou
            // this.councilFormData.koatuu

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('Communities', ['community']),
    },
    created() {
        this.$store.dispatch('Communities/fetchRecord', this.id);
    },
    components: {
        DataTable,
        CommunityForm,
        CouncilForm
    }
}
</script>
