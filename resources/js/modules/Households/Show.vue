<template>
    <!-- <breadcrumbs v-if="household?.id"/> -->

    <div class="card" v-if="household?.id">
        <div class="card-header ">
            <div class="card-title">
                <span class="go-back-page" @click="$router.push({name: 'households'})">                  
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>Повернутись по переліку погосподарських карт</title>
                        <!-- <title>table-arrow-left</title> -->
                        <path d="M4 3H18C19.11 3 20 3.9 20 5V12.08C18.45 11.82 16.92 12.18 15.68 13H12V17H13.08C12.97 17.68 12.97 18.35 13.08 19H4C2.9 19 2 18.11 2 17V5C2 3.9 2.9 3 4 3M4 7V11H10V7H4M12 7V11H18V7H12M4 13V17H10V13H4M18.44 15V17H22.44V19H18.44V21L15.44 18L18.44 15" />
                    </svg>
                </span>
                <span>Облікова картка об'єкта погосподарського обліку:</span>
                <span class="household-card--number">{{ household.household_number }}</span>
            </div>
            <div class="dropdown" v-show="$route.name == 'households.show.info'">                
                
                <IconButton 
                        buttonClass="btn-outline-secondary btn-transparent dropdown-toggle p-2" 
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        :size="16"
                        :mdiPath="pathMdiCogs" />

                <ul class="dropdown-menu">
                    <li>
                        <a  class="dropdown-item d-flex align-items-center cursor-pointer"
                            @click="openHouseholdForm">
                                <SvgIcon type="mdi" :path="pathMdiPencil" :size="16" class="text-warning me-2" />
                                <span>Редагувати</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a  class="dropdown-item d-flex align-items-center cursor-pointer"
                            @click="deleteHouseholdCard(household.id)">                                
                                <SvgIcon type="mdi" :path="pathMdiTrashCan" :size="16" class="text-danger me-2" />
                                <span>Видалити</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">

            <div class="px-3 pt-3">             
                <NavigationTabs :tabs="tabs" :navigationClass="['px-3']"/>
                <div class="pt-4">
                    <router-view></router-view>
                </div>                
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
import SvgIcon          from '@jamescoyle/vue-icon';

import {
    mdiCogs,
    mdiLandFields,
    mdiInformationOutline,
    mdiHomeOutline,
    mdiAccountMultipleOutline,
    mdiPencil,
    mdiTrashCan
} from '@mdi/js';

import HouseholdForm    from './HouseholdForm.vue';

import Page404          from '../../components/Page404.vue';
import NavigationTabs   from '../../components/ui/NavigationTabs.vue';
import IconButton       from '../../components/ui/Buttons/IconButton.vue';

export default {
    name: 'ShowCard',
    inheritAttrs:false,
    components: {
        HouseholdForm,
        Page404,
        NavigationTabs,
        IconButton,
        SvgIcon
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
            tabs: [
                {
                    routeName: 'households.show.info',
                    iconPath: mdiInformationOutline,
                    title: 'Головна інформація' 
                },
                {
                    routeName: 'households.show.members',
                    iconPath: mdiAccountMultipleOutline,
                    title: 'Члени домогосподарства' 
                },
                {
                    routeName: 'households.show.house.years',
                    iconPath: mdiHomeOutline,
                    title: 'Будинок / Квартира' 
                },
                {
                    routeName: 'households.show.land.years',
                    iconPath: mdiLandFields,
                    title: 'Земля' 
                },
            ],

            pathMdiCogs: mdiCogs,
            pathMdiPencil: mdiPencil,
            pathMdiTrashCan: mdiTrashCan
        }
    },
    provide() {
        return {
            modalTitle: 'Редагування облікової картки',
            modalSubmitCaption: 'Зберегти',
        }
    },
    methods: {
        openHouseholdForm() {
            this.formData.id                = this.id,
            this.formData.settlement_id     = this.household.settlement_id,
            this.formData.household_type_id = this.household.household_type_id,
            this.formData.number            = this.household.number,
            this.formData.special_marks     = this.household.special_marks,
            this.formData.additional_data   = this.household.additional_data


            const address_part_names = ['address_street_type', 'address_street_name', 'address_house', 'address_corps', 'address_apartment'];
            const address_part_values = this.household.address.split(',');

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
    height: 50px;

    // h5 {
    //     margin: 1px 0;
    // }

    .card-title {
        display: flex;
        align-items: center;
        // gap: 1rem;
        font-size: 1.1rem;
        margin-bottom: 0;

        span.go-back-page {
            height: 30px;
            width: 30px;
            opacity: 0.5;
            font-size: 1.1rem;
            transition: all 0.3s;
            
            &:hover {
                opacity: 1;
                fill: var(--bs-primary);
            }
        }

        span:nth-of-type(2) {
            border-left: 1px solid #adb5bd;
            padding-left: 1rem;
            padding-right: 1rem;
            margin-left: 1rem;
        }

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

// .dropdown-menu {
//     .dropdown-item:hover {
//         background-color: var(--bs-secondary-bg);
//     }
// }

</style>
