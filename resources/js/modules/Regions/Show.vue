<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="region.name">
                <div class="card-header">
                    <!-- <h5>Інформація</h5> -->
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація</span>
                        <button class="btn btn-sm btn-light" @click="openRegionForm" title="Редагувати дані">
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
                                {{ region.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Адміністративний центр
                            </div>
                            <div class="col-md-9">
                                {{ region.center }}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper flex-grow-1 justify-content-between">
                                <span>Районі в регіоні</span>
                                <button class="btn btn-sm btn-light" title="Додати район" @click="openDistrictForm">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <template v-if="region.districts.length > 0">
                                <DataTable  :dataTable="region.districts"
                                            tableHeaderClass="table-dark">
                                    <template v-slot:header>
                                        <tr>
                                            <th>Назва</th>
                                            <th>Центр</th>
                                        </tr>
                                    </template>
                                    <template v-slot:default="slotProps">
                                        <tr     v-for="record in slotProps.paginatedData"
                                                :key="record.id">
                                            <td>
                                                <router-link :to="{name: 'DistrictsShow', params: { id: record.id }}">
                                                    <td>{{record.name}}</td>
                                                </router-link>
                                            </td>
                                            <td>{{ record.center }}</td>
                                        </tr>
                                    </template>
                                </DataTable>
                            </template>
                            <template v-else>
                                <div class="text-center text-muted">
                                    В данному регіоні райони не знайдені
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <RegionForm :formData="regionFormData" action="update"/>
    <DistrictForm :formData="districtFormData" @refreshData="$store.dispatch('Regions/fetchRegion', id)" :disabled-fields="['region_id']"/>

</template>

<script>
import { Modal } from 'bootstrap';
import { computed } from 'vue';
import { mapGetters } from 'vuex';

import DataTable from '../../components/ui/DataTable.vue';
import RegionForm from './Form.vue';
import DistrictForm from '../Districts/Form.vue';

export default {
    name: 'RegionsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true,
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle), //'Редагувати регіон',
            modalSubmitCaption: computed(() => this.modalSubmitCaption) //'Зберегти',
        }
    },
    data() {
        return {
            regionFormData: {
                name: '',
                center: '',
                id: null
            },
            districtFormData: {
                region_id: this.id,
                name: '',
                center: '',
            },
            modalTitle: '',
            modalSubmitCaption: ''
        }
    },
    methods: {
        openRegionForm() {
            let myModal = new Modal(document.getElementById('RegionForm'))

            this.modalTitle         = 'Редагувати регіон';
            this.modalSubmitCaption = 'Зберегти';

            this.regionFormData.name      = this.region.name;
            this.regionFormData.center    = this.region.center;
            this.regionFormData.id        = this.region.id;

            myModal.show();
        },
        openDistrictForm() {
            let myModal = new Modal(document.getElementById('DistrictForm'))

            this.modalTitle         = 'Новий район в регіоні';
            this.modalSubmitCaption = 'Додати';

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('Regions', ['region']),
    },
    created() {
        this.$store.dispatch('Regions/fetchRegion', this.id);
    },
    components:{
        DataTable,
        RegionForm,
        DistrictForm
    }
}
</script>
