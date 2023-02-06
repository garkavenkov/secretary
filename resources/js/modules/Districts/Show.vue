<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="district.name">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація</span>
                        <button class="btn btn-sm btn-light btn-transparent"
                                @click="openDistrictForm"
                                title="Редагувати дані">
                            <span class="mdi mdi-pencil"></span>
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
                                {{ district.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Адміністративний центр
                            </div>
                            <div class="col-md-9">
                                {{ district.center }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Регіон
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'regions.show', params: {id: district.region_id}}">
                                    {{ district.region.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                                <span>Громади в районі</span>
                                <button class="btn btn-sm btn-light btn-transparent"
                                        title="Додати громаду"
                                        @click="openCommunityForm">
                                    <span class="mdi mdi-plus"></span>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <DataTable  :dataTable="district.communities"
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
                                            <router-link :to="{name: 'communities.show', params: { id: record.id }}">
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

    <DistrictForm
            :formData="districtFormData"
            action="update"
            @refreshData="$store.dispatch('Districts/fetchRecord', id)"/>

    <CommunityForm
            :formData="communityFormData"
            :disabled-fields="['region_id', 'district_id']"
            @refreshData="$store.dispatch('Districts/fetchRecord', id)"/>

</template>

<script>
import { mapGetters }   from 'vuex';
import { computed }     from 'vue';
import { Modal }        from 'bootstrap';

import DataTable        from '../../components/ui/DataTable.vue'
import DistrictForm     from './Form.vue';
import CommunityForm    from '../Communities/Form.vue';

export default {
    name: 'DistrictsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            districtFormData: {
                region_id: 0,
                name: '',
                center: ''
            },
            communityFormData: {
                region_id: 0,
                district_id: 0,
                name:   '',
                center: '',
                address:'',
                edrpou: '',
                koatuu: ''
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
        openDistrictForm() {
            var myModal = new Modal(document.getElementById('DistrictForm'))

            this.modalTitle = 'Редагувати регіон';
            this.modalSubmitCaption = 'Зберегти';

            this.districtFormData.id        = this.district.id;
            this.districtFormData.region_id = this.district.region_id;
            this.districtFormData.name      = this.district.name;
            this.districtFormData.center    = this.district.center;

            myModal.show();
        },
        openCommunityForm() {
            var myModal = new Modal(document.getElementById('CommunityForm'))

            this.modalTitle = 'Нова громада';
            this.modalSubmitCaption = 'Додати';

            this.communityFormData.region_id = this.district.region_id;
            this.communityFormData.district_id = this.district.id;

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('Districts', ['district'])
    },
    created() {
        this.$store.dispatch('Districts/fetchRecord', this.id);
    },
    components: {
        DataTable,
        DistrictForm,
        CommunityForm
    }
}
</script>
