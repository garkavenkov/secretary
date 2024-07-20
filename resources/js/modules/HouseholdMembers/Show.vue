<template>

    <!-- <breadcrumbs  v-if="member?.id" /> -->

    <div class="card" v-if="member?.id">
        <div class="card-header">
            <div class="card-title">
                <span class="go-back-page" @click="$router.push({name: 'household-members'})">                  
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <title>Повернутись по переліку членів домогосподарств</title>                        
                        <path d="M4 3H18C19.11 3 20 3.9 20 5V12.08C18.45 11.82 16.92 12.18 15.68 13H12V17H13.08C12.97 17.68 12.97 18.35 13.08 19H4C2.9 19 2 18.11 2 17V5C2 3.9 2.9 3 4 3M4 7V11H10V7H4M12 7V11H18V7H12M4 13V17H10V13H4M18.44 15V17H22.44V19H18.44V21L15.44 18L18.44 15" />
                    </svg>
                </span>
                <span>Член домогосподарства:</span>
                <span class="household-card--number">{{  member.full_name }}</span>
            </div>
            <div class="dropdown" v-show="$route.name == 'household-member.info'">                
                
                <IconButton 
                        buttonClass="btn-outline-secondary btn-transparent dropdown-toggle p-2" 
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        :size="16"
                        :mdiPath="pathMdiCogs" />

                <ul class="dropdown-menu">
                    <li>
                        <a  class="dropdown-item d-flex align-items-center cursor-pointer"
                            @click="editHouseholdMember">
                                <SvgIcon type="mdi" :path="pathMdiPencil" :size="16" class="text-warning me-2" />
                                <span>Редагувати</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a  class="dropdown-item d-flex align-items-center cursor-pointer"
                            @click="deleteHouseholdMember">
                                <SvgIcon type="mdi" :path="pathMdiTrashCan" :size="16" class="text-danger me-2" />
                                <span>Видалити</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
            
        <div class="card-body">
            <div class="d-flex px-3 justify-content-between mb-2 border-bottom pb-2">
                <div>
                    Адреса: {{ member.full_address }} 
                </div>
                <div>
                    Домогосподарство:
                    <router-link                     
                            v-if="member.household_id"
                            :to="{ name: 'households.show.info', params: { id: member.household_id }}" 
                            @click.ctrl.prevent="$router.push({name: 'households.show.members', params: { id: member.household_id }})" 
                            class="ms-2">
                         {{ member.household_number }}
                    </router-link>
                </div>
            </div>
            <div class="pt-3">             
                <NavigationTabs :tabs="tabs" :navigationClass="['px-3']"/>
                <div class="py-3">
                    <router-view></router-view>
                </div>
            </div>
        </div>

    </div>   

    <Page404 v-else
        :message="`Член домогосподарства з id:${id} відсутній`" 
        resource="img/404/member.png" 
        fallbackUrl="household-members" 
        fallbackUrlMessage="Повернутись до переліку членів домогосподарств"/>
    
    <HouseholdMemberForm
        :formData="formData"
        :showDeathInfo="true"
        action="update"
        @refreshData="refreshData"/>



</template>

<script>

import { mapGetters }   from 'vuex';
import { mapActions }   from 'vuex/dist/vuex.cjs.js';
import { Modal }        from 'bootstrap';
import SvgIcon          from '@jamescoyle/vue-icon';
import { 
    mdiAccountDetailsOutline,
    mdiLandFields,
    mdiTransitTransfer,
    mdiTagMultipleOutline,
    mdiPencil,
    mdiCogs,    
    mdiHumanMaleFemaleChild,
    mdiTrashCanOutline,
} from '@mdi/js';

import Page404              from '../../components/Page404.vue';
import NavigationTabs       from '../../components/ui/NavigationTabs.vue';
import IconButton           from '../../components/ui/Buttons/IconButton.vue';
import HouseholdMemberForm  from '../Households/Members/HouseholdMemberForm.vue';

export default {
    name: 'HouseholdMembersShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    components: {
        Page404,                
        NavigationTabs,
        IconButton,
        SvgIcon,
        HouseholdMemberForm
    },
    data() {
        return {
            notFoundMessage: '',          

            tabs: [
                {
                    routeName: 'household-member.info',
                    iconPath: mdiAccountDetailsOutline,
                    title: 'Головна інформація' 
                },
                {
                    routeName: 'household-member.lands',
                    iconPath: mdiLandFields,
                    title: 'Земля' 
                },
                {
                    routeName: 'household-member.movements',
                    iconPath: mdiTransitTransfer,
                    title: 'Реєстрація / Переміщення' 
                },
                {
                    routeName: 'household-member.additional-data',
                    iconPath: mdiTagMultipleOutline,
                    title: 'Додаткові дані' 
                },
                {
                    routeName: 'household-member.relatives',
                    iconPath: mdiHumanMaleFemaleChild,
                    title: 'Родина' 
                },
            ],
            formData: {
                id: '',
                household_id: 0,
                surname: '',
                name: '',
                patronymic: '',
                sex: '',
                birthdate: null,
                family_relationship_type_id: 0,
                employment_information: '',
                social_information: '',
                additional_information: '',
                work_place_id: 0,
                death_date: null,
                death_register_number: '',
                death_register_office: '',
            },
            pathMdiPencil: mdiPencil,            
            pathMdiTrashCan: mdiTrashCanOutline,
            pathMdiCogs: mdiCogs,            
            modalTitle: '',
            modalSubmitCaption: ''
        }
    },
    provide() {
        return {
            modalTitle: 'Редагувати інформацію о члені домогосподарства',
            modalSubmitCaption: 'Змінити'
        }
    },
    methods: {
        ...mapActions('HouseholdMembers', ['fetchRecord']),
        editHouseholdMember() {                       
            this.formData.id                            =   this.member.id;
            this.formData.household_id                  =   this.member.household_id;
            this.formData.surname                       =   this.member.surname;
            this.formData.name                          =   this.member.name;
            this.formData.patronymic                    =   this.member.patronymic;
            this.formData.sex                           =   this.member.sex;
            this.formData.birthdate                     =   this.member.birthdate;
            this.formData.family_relationship_type_id   =   this.member.family_relationship_type_id;
            this.formData.employment_information        =   this.member.employment_information;
            this.formData.social_information            =   this.member.social_information;
            this.formData.additional_information        =   this.member.additional_information;
            this.formData.work_place_id                 =   this.member.work_place_id;
            this.formData.death_date                    =   this.member.death_date;
            this.formData.death_register_number         =   this.member.death_register_number;
            this.formData.death_register_office         =   this.member.death_register_office;
            
            let myModal = new Modal(document.getElementById('HouseholdMemberForm'))
            myModal.show();
        },
        deleteHouseholdMember() {
            this.$confirmDelete('Ви дійсно бажаєти видалити інформацію о члені домогосподарства')
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`/api/v1/household-members/${this.id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.$router.push({name: 'household-members'});
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити члена домогосподарства', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        },
        refreshData()
        {
            this.fetchRecord(this.id);
        }
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['member'])
    },  
    created() { 
        this.fetchRecord(this.id)            

    },
    watch: {
        '$route' (to, from) {                     
            // console.log(to, from);
            if ((to.params.id !== from.params.id)) { // && (to.name == from.name)) {                
                this.$store.dispatch('HouseholdMembers/fetchRecord', to.params.id,);
            }
        },
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
