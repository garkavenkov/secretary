<template>
    <breadcrumbs v-if="region.name"/>

    <!--
    <div class="row" v-if="region.name">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація</span>

                        <ButtonEdit 
                                buttonClass="btn-light btn-transparent p-2"
                                @click="openRegionForm"
                                title="Редагувати дані" />
                        
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

                                <ButtonAdd 
                                        buttonClass="btn-light btn-transparent p-2"
                                        title="Додати район"
                                        @click="openDistrictForm" />
                                
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
                                                <router-link :to="{name: 'districts.show', params: { id: record.id }}">
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
    -->
    <div class="row" v-if="region.name">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація</span>

                        <ButtonEdit 
                                buttonClass="btn-light btn-transparent p-2"
                                @click="openRegionForm"
                                title="Редагувати дані" />
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                Назва
                            </div>
                            <div class="col-md-6">
                                {{ region.name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                Адміністративний центр
                            </div>
                            <div class="col-md-6">
                                {{ region.center }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper flex-grow-1 justify-content-between">
                        <span>Районі в регіоні</span>

                        <ButtonAdd 
                            buttonClass="btn-light btn-transparent p-2"
                            title="Додати район"
                            @click="openDistrictForm" />
                                
                    </div>
                </div>
                <div class="card-body">
                    <template v-if="region.districts.length > 0">
                        <DataTable  :dataTable="region.districts"
                                    tableClass="table-bordered"
                                    tableHeaderClass="table-secondary">
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
                                        <router-link :to="{name: 'districts.show', params: { id: record.id }}">
                                            {{record.name}}
                                        </router-link>
                                    </td>
                                    <td>{{ record.center }}</td>
                                </tr>
                            </template>
                        </DataTable>
                    </template>
                    <template v-else>
                        <div class="text-center text-muted">
                            Відсутня інформація по районах в данному данному регіоні
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <Page404 v-else
        :message="`Регіон з id:${id} відсутній`" 
        resource="img/404/dictionary.png"  
        fallbackUrl="regions" 
        fallbackUrlMessage="Повернутись до переліку регіонів" />
        

    <RegionForm
            :formData="regionFormData"
            action="update"/>

    <DistrictForm
            :formData="districtFormData"
            @refreshData="$store.dispatch('Regions/fetchRegion', id)"
            :disabled-fields="['region_id']"/>

</template>

<script>
import { Modal }        from 'bootstrap';
import { computed }     from 'vue';
import { mapGetters }   from 'vuex';

import RegionForm       from './Form.vue';
import DistrictForm     from '../Districts/Form.vue';

import Page404          from '../../components/Page404.vue';


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

            this.modalTitle         = 'Редагувати інформацію о регіоні';
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
        this.$store.dispatch('Regions/fetchRecord', this.id);
    },
    components:{        
        RegionForm,
        DistrictForm,
        Page404
    }
}
</script>
