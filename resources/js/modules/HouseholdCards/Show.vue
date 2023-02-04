<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <h5>Облікова картка об'єкта погосподарського обліку <span class="household-card__number">{{ household.number }}</span></h5>
            <div class="dropdown" v-if="currentTab == 'HouseholdInfo'">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="mdi mdi-cogs"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" @click="openHouseholdForm">
                            <span class="mdi mdi-pencil me-1"></span>
                            Редагувати
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" @click="deleteHouseholdCard(household.id)">
                            <span class="mdi mdi-trash-can me-1"></span>
                            Видалити
                        </a>
                    </li>
                </ul>
            </div>
            <!-- <button class="btn btn-sm btn-light" title="Редагувати облікову картку" @click="openHouseholdForm" v-if="currentTab == 'HouseholdInfo'">
                <span class="mdi mdi-pencil"></span>
            </button> -->
        </div>
        <div class="card-body">

            <div class="px-3 pt-3">
                <ul class="nav nav-tabs px-3">
                    <li class="nav-item">
                        <a class="nav-link" :class="{'active': currentTab == 'HouseholdInfo'}" aria-current="page" @click="currentTab='HouseholdInfo'">
                            <span class="mdi mdi-information-outline"></span>
                            Основна інформація
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{'active': currentTab == 'HouseholdMembers'}" aria-current="page" @click="currentTab='HouseholdMembers'">
                            <span class="mdi mdi-account-multiple-outline"></span>
                            Члени домогосподарства
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" :class="{'active': currentTab == 'HouseInfo'}" @click="currentTab='HouseInfo'">
                            <span class="mdi mdi-home-outline"></span>
                            Будинок / Квартира
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{'active': currentTab == 'LandInfo'}" @click="currentTab='LandInfo'">
                            <span class="mdi mdi-land-fields"></span>
                            Земля
                        </a>
                    </li>
                </ul>
                <KeepAlive>
                    <component :is="currentTab" v-bind="componentProps"></component>
                </KeepAlive>
            </div>
        </div>
    </div>

    <HouseholdForm
            :formData="formData"
            action="update"
            @refreshData="$store.dispatch('Households/fetchRecord', id)" />

</template>

<script>

import HouseholdMembers from './Member/HouseholdMembers.vue';
import HouseInfo        from './House/HouseInfo.vue';
import LandInfo         from './Land/LandInfo.vue';
import HouseholdInfo    from './Info/HouseholdInfo.vue';
import HouseholdForm    from './HouseholdForm.vue';

import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap';

export default {
    name: 'ShowCard',
    components: {
        HouseholdMembers,
        HouseInfo,
        LandInfo,
        HouseholdInfo,
        HouseholdForm
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
                address: '',
                special_marks: '',
                additional_data: ''
            },
            currentTab: 'HouseholdInfo',
        }
    },
    provide() {
        return {
            modalTitle: 'Редагування обліковох картки',
            modalSubmitCaption: 'Зберегти',
        }
    },
    methods: {
        openHouseholdForm() {
            this.formData.id                = this.id,
            this.formData.settlement_id     = this.household.info.settlement_id,
            this.formData.household_type_id = this.household.info.household_type_id,
            this.formData.address           = this.household.info.address,
            this.formData.special_marks     = this.household.info.special_marks,
            this.formData.additional_data   = this.household.info.additional_data

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
                                this.$router.push({name: 'HouseholdCards'});
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити картку', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        }
    },
    computed: {
        componentProps() {
            if (this.currentTab == 'HouseholdInfo') {
                if (this.household.info) {
                    return {
                        info: {...this.household.info, household_id: this.id}
                    }
                }
            } else if (this.currentTab == 'HouseholdMembers') {
                return {
                    members: this.household.members,
                    household_id: this.id
                }
            } else if (this.currentTab == 'HouseInfo') {
                return {
                    years: this.household.houseYears,
                    household_id: this.id
                }
            } else if (this.currentTab == 'LandInfo') {
                return {
                    years: this.household.landYears,
                    household_id: this.id
                }
            }
        },
        ...mapGetters('Households', ['household'])
    },
    watch: {
        '$route' (to, from) {
            this.$store.dispatch('Households/fetchRecord', to.params.id,);
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
a.nav-link.active {
    background: linear-gradient(#e9ecef, #f8fafc);
}

.household-card__number {
    font-weight: 600;
    margin-left: 0.5rem;
}

.dropdown-menu {
    .dropdown-item:hover {
        // color: var(--bs-dropdown-link-active-color);
        background-color: var(--bs-secondary-bg);
    }
}

</style>
