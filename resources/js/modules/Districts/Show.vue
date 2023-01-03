<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="district.name">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація</span>
                        <button class="btn btn-sm btn-light" @click="editDistrict" title="Редагувати дані">
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
                                <router-link :to="{name: 'RegionsShow', params: {id: district.region_id}}">
                                    {{ district.region.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                                <span>Громади в районі</span>
                                <button class="btn btn-sm btn-light" title="Додати громаду">
                                    <i class="bi bi-plus-lg"></i>
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
                                            <router-link :to="{name: 'CommunitiesShow', params: { id: record.id }}">
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

    <DistrictForm :formData="districtFormData" action="update"/>

</template>

<script>
import { Modal } from 'bootstrap';
import DataTable from '../../components/ui/DataTable.vue'
import DistrictForm from './Form.vue';
import { mapGetters } from 'vuex';

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
            }
        }
    },
    provide() {
        return {
            modalTitle: 'Редагувати регіон',
            modalSubmitCaption: 'Зберегти',
        }
    },
    methods: {
        editDistrict() {
            var myModal = new Modal(document.getElementById('DistrictForm'))

            this.districtFormData.id        = this.district.id;
            this.districtFormData.region_id = this.district.region_id;
            this.districtFormData.name      = this.district.name;
            this.districtFormData.center    = this.district.center;

            myModal.show();
        }
    },
    computed: {
        ...mapGetters('Districts', ['district'])
    },
    created() {
        this.$store.dispatch('Districts/fetchDistrict', this.id);
    },
    components: {
        DataTable,
        DistrictForm
    }
}
</script>
