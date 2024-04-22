<template>
    <breadcrumbs  v-if="settlement.name"/>

    <div class="row"  v-if="settlement.name">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper d-flex justify-content-between flex-grow-1">
                        <span>Інформація о поселенні</span>
                        <button class="btn btn-sm btn-light" @click="openSettlementForm" title="Редагувати дані">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                    </div>
                <div>
            </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Назва
                            </div>
                            <div class="col-md-9">
                                {{ settlement.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Тип поселення
                            </div>
                            <div class="col-md-9">
                                {{ settlement.settlement_type.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Внутрішній код
                            </div>
                            <div class="col-md-9">
                                {{ settlement.inner_code }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Індекс
                            </div>
                            <div class="col-md-9">
                                {{ settlement.postcode }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                КАТОТТГ
                            </div>
                            <div class="col-md-9">
                                {{ settlement.katottg }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Міська / сільська рада
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'councils.show', params: {id: settlement.council_id}}">
                                    {{ settlement.council.name }}
                                </router-link>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Громада
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'communities.show', params: {id: settlement.council.community_id}}">
                                    {{ settlement.council.community.name }}
                                </router-link>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Район
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'districts.show', params: {id: settlement.council.community.district_id}}">
                                    {{ settlement.council.community.district.name }}
                                </router-link>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Регіон
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'regions.show', params: {id: settlement.council.community.district.region_id}}">
                                    {{ settlement.council.community.district.region.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Page404 v-else
        :message="`Населенний пункт з id:${id} відсутній`" 
        resource="img/404/dictionary.png"  
        fallbackUrl="settlements" 
        fallbackUrlMessage="Повернутись до переліку населенних пунктів" />
    
    <SettlementForm
            :formData="settlementFormData"
            @refreshData="$store.dispatch('Settlements/fetchRecord', id)"
            :disabledFields="['region_id', 'district_id', 'community_id', 'council_id']"
            action="update" />

</template>

<script>
import { mapGetters }   from 'vuex'
import { Modal }        from 'bootstrap';

import SettlementForm   from './Form.vue';
import Page404          from '../../components/Page404.vue';

export default {
    name: 'SettlementsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            settlementFormData: {
                region_id           : 0,
                district_id         : 0,
                community_id        : 0,
                council_id          : 0,
                settlement_type_id  : 0,
                name                :'',
                postcode            :'',
                inner_code          :'',
                katottg             :'',
            },
            modalTitle: '',
            modalSubmitCaption: ''
        }
    },
    provide() {
        return {
            modalTitle: 'Редагувати поселення',
            modalSubmitCaption: 'Зберегти',
        }
    },
    methods: {
        openSettlementForm() {
            let settlementForm = new Modal(document.getElementById('SettlementForm'))

            this.settlementFormData.id                  =   this.settlement.id;
            this.settlementFormData.region_id           =   this.settlement.council.community.district.region_id;
            this.settlementFormData.district_id         =   this.settlement.council.community.district_id;
            this.settlementFormData.community_id        =   this.settlement.council.community_id;
            this.settlementFormData.council_id          =   this.settlement.council_id;
            this.settlementFormData.settlement_type_id  =   this.settlement.settlement_type_id;
            this.settlementFormData.name                =   this.settlement.name;
            this.settlementFormData.postcode            =   this.settlement.postcode;
            this.settlementFormData.inner_code          =   this.settlement.inner_code;
            this.settlementFormData.katottg             =   this.settlement.katottg;

            settlementForm.show();
        }
    },
    computed: {
        ...mapGetters('Settlements', ['settlement']),
    },
    created() {
        this.$store.dispatch('Settlements/fetchRecord', this.id)
    },
    components: {
        SettlementForm,
        Page404
    }
}
</script>
