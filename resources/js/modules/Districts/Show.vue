<template>
    <breadcrumbs v-if="district.name" />

    <div class="row" v-if="district.name">        
    
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">

                        <span>Інформація</span>
                        <ButtonEdit @click="openDistrictForm" title="Редагувати дані" button class="btn-light btn-transparent p-2"/>
                        
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                Назва
                            </div>
                            <div class="col-md-7">
                                {{ district.name }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                Адміністративний центр
                            </div>
                            <div class="col-md-7">
                                {{ district.center }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                Регіон
                            </div>
                            <div class="col-md-7">
                                <router-link :to="{name: 'regions.show', params: {id: district.region_id}}">
                                    {{ district.region.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Громади в районі</span>
                        <ButtonAdd      
                                buttonClass="btn-light btn-transparent p-2"
                                title="Додати громаду"
                                @click="openCommunityForm" />                        
                    </div>
                </div>
                <div class="card-body">
                    <DataTable  :dataTable="district.communities"
                                tableClass="table-bordered"
                                tableHeaderClass="table-secondary">
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
                                        {{record.name}}
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
    <Page404 v-else
        :message="`Район з id:${id} відсутній`" 
        resource="img/404/dictionary.png"  
        fallbackUrl="districts" 
        fallbackUrlMessage="Повернутись до переліку районів" />
        
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

import DistrictForm     from './Form.vue';
import CommunityForm    from '../Communities/Form.vue';
import Page404          from '../../components/Page404.vue';
import DataTable        from '../../components/ui/DataTable.vue'
import ButtonEdit       from '../../components/ui/Buttons/ButtonEdit.vue';
import ButtonAdd        from '../../components/ui/Buttons/ButtonAdd.vue';

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
        CommunityForm,
        Page404,
        ButtonAdd,
        ButtonEdit
    }
}
</script>
