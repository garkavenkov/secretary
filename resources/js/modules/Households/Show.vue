<template>
    <breadcrumbs v-if="household?.id"/>

    <div class="card" v-if="household?.id">
        <div class="card-header">
            <h5>Облікова картка об'єкта погосподарського обліку <span class="household-card--number">{{ household.number }}</span></h5>
            <div class="dropdown" v-show="$route.name == 'households.show.info'">
                <button class="btn btn-sm btn-outline-secondary btn-transparent dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <span class="mdi mdi-cogs"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a  class="dropdown-item"
                            @click="openHouseholdForm">
                                <span class="mdi mdi-pencil text-warning me-1"></span>
                                Редагувати
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a  class="dropdown-item"
                            @click="deleteHouseholdCard(household.id)">
                                <span class="mdi mdi-trash-can text-danger me-1"></span>
                                Видалити
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">

            <div class="px-3 pt-3">
                <ul class="nav nav-tabs px-3">
                    <li class="nav-item">
                        <router-link :to="{name: 'households.show.info'}" class="nav-link">
                            <span class="mdi mdi-information-outline"></span>
                            Основна інформація
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'households.show.members'}" class="nav-link">
                            <span class="mdi mdi-account-multiple-outline"></span>
                            Члени домогосподарства
                        </router-link>
                    </li>
                    <li class="nav-item" >
                        <router-link :to="{name: 'households.show.house.years'}" class="nav-link">
                            <span class="mdi mdi-home-outline"></span>
                            Будинок / Квартира
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'households.show.land.years'}" class="nav-link">
                            <span class="mdi mdi-land-fields"></span>
                            Земля
                        </router-link>
                    </li>
                </ul>
                <router-view></router-view>
            </div>
        </div>
    </div>    
    <Page404 v-else
        :message="`Домогосподарство з id:${id} відсутне`" 
        resource="img/404/house.png"  
        fallbackUrl="households" 
        fallbackUrlMessage="Повернутись до переліку домогосподарств" />
        

    <HouseholdForm
            :formData="formData"
            action="update"
            @refreshData="refreshData" />

</template>

<script>

import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap';

import HouseholdForm    from './HouseholdForm.vue';
import Page404          from '../../components/Page404.vue';

export default {
    name: 'ShowCard',
    inheritAttrs:false,
    components: {
        HouseholdForm,
        Page404
    },
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            formData: {
                id: this.id,
                settlement_id: 0,
                household_type_id: 0,
                number: '',
                address_street_type: '',
                address_street_name: '',
                address_house: '',
                address_corps: '',
                address_apartment: '',
                special_marks: '',
                additional_data: ''
            },
        }
    },
    provide() {
        return {
            modalTitle: 'Редагування облікових картки',
            modalSubmitCaption: 'Зберегти',
        }
    },
    methods: {
        openHouseholdForm() {
            this.formData.id                = this.id,
            this.formData.settlement_id     = this.household.info.settlement_id,
            this.formData.household_type_id = this.household.info.household_type_id,
            this.formData.number            = this.household.info.number,
            this.formData.special_marks     = this.household.info.special_marks,
            this.formData.additional_data   = this.household.info.additional_data


            const address_part_names = ['address_street_type', 'address_street_name', 'address_house', 'address_corps', 'address_apartment'];
            const address_part_values = this.household.info.raw_address.split(',');

            address_part_values.forEach((value, index) => {
                this.formData[address_part_names[index]] = value;
            });

            let householdForm = new Modal(document.getElementById('HouseholdForm'));
            householdForm.show();
        },
        deleteHouseholdCard(id) {
            this.$confirmDelete('Ви дійсно бажаєти видалити облікову картку')
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`/api/v1/households/${id}`)
                            .then(res => {
                                this.$store.dispatch('Households/fetchRecords');
                                this.$toast(res.data.message);
                                this.$router.push({name: 'households'});
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити картку', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        },
        refreshData() {
            this.$store.dispatch('Households/fetchRecord', this.id);
            this.$store.dispatch('Households/fetchRecords');
        }
    },
    computed: {
        ...mapGetters('Households', ['household'])
    },
    watch: {
        '$route' (to, from) {            
            if ((to.params.id !== from.params.id) && (to.name == from.name)) {
                this.$store.dispatch('Households/fetchRecord', to.params.id,);
            }
        },
    },
    created() {
        this.$store.dispatch('Households/fetchRecord', this.id);

    }
}
</script>


<style lang="scss" scoped>
.card-header {
    h5 {
        margin: 1px 0;
    }
}

a.router-link-exact-active {
    background: linear-gradient(#e9ecef, #f8fafc);
    color: var(--bs-nav-tabs-link-active-color);
    border-color: var(--bs-nav-tabs-link-active-border-color) !important;
}

.household-card-number {
    font-weight: 600;
    margin-left: 0.5rem;
}

.dropdown-menu {
    .dropdown-item:hover {
        background-color: var(--bs-secondary-bg);
    }
}

</style>
