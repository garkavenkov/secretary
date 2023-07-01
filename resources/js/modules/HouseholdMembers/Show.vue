<template>

    <breadcrumbs />
    <!-- <div class="row">
        <div class="col-md-10 mx-auto"> -->
            <div class="card">
                <div class="card-header">
                    <div>
                        <h5>{{ member.full_name }} </h5>
                        <!-- <h6>
                            {{ member.address }} |
                            <router-link :to="{ name: 'households.show.info', params: { id: member.household_id }}" v-if="member.household_id">
                                {{ member.household_number }}
                            </router-link>
                        </h6> -->
                    </div>
                    <!-- <div class="dropdown" v-show="$route.name == 'households.show.info'"> -->
                    <div class="dropdown">
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
                            <!-- <li>
                                <a  class="dropdown-item"
                                    @click="deleteHouseholdCard(household.id)">
                                        <span class="mdi mdi-trash-can text-danger me-1"></span>
                                        Видалити
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button :class="['nav-link', currentTab == 'MainInfo' ? 'active' : '']"
                                        id="main-tab"
                                        @click="currentTab = 'MainInfo'"
                                        type="button">
                                    <span class="mdi mdi-account-details-outline me-1"></span>
                                    Головна інформація
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button :class="['nav-link', currentTab == 'LandYears' ? 'active' : '']"
                                        id="main-tab"
                                        @click="currentTab = 'LandYears'"
                                        type="button">
                                    <span class="mdi mdi-land-fields me-1"></span>
                                    Земля
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button :class="['nav-link', currentTab == 'Movements' ? 'active' : '']"
                                        id="movement-tab"
                                        @click="currentTab = 'Movements'"
                                        type="button">
                                    <span class="mdi mdi-transit-transfer me-1"></span>
                                    Реєстрація / Переміщення
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button :class="['nav-link', currentTab == 'AdditionalParamsList' ? 'active' : '']"
                                        id="movement-tab"
                                        @click="currentTab = 'AdditionalParamsList'"
                                        type="button">
                                        <span class="mdi mdi-tag-multiple me-1"></span>
                                    Додаткова параметри
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content p-3">
                            <KeepAlive>
                                <component  :is="currentTab"
                                            v-bind="componentProps"
                                            @refreshData="fetchMember">
                                </component>
                            </KeepAlive>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div>
    </div> -->

</template>

<script>

import MainInfo             from '../Households/Members/Tabs/MainInfo';
import LandYears            from '../Households/Members/Tabs/LandYears.vue';
import Movements            from '../Households/Members/Tabs/Movements.vue';
import AdditionalParamsList from '../AdditionalParams/AdditionalParamsList.vue';

export default {
    name: 'HouseholdMemebrsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            currentTab: 'MainInfo',
            member: {}
        }
    },
    methods: {
        fetchMember() {
            let memberId = this.$route.params.memberId;
            axios.get(`/api/v1/household-members/${this.id}`)
                .then(res => {
                    this.member = res.data.data;
                })
        },
    },
    computed: {
        componentProps() {
            if (this.currentTab == 'MainInfo') {
                return {
                    formData: Object.assign({}, this.member),
                }
            }
            if (this.currentTab == 'LandYears') {
                let member = {
                    id: this.member.id,
                    surname: this.member.surname,
                    name: this.member.name,
                    patronymic: this.member.patronymic,
                }
                return {
                    member: member,
                    years: this.member.land,
                }
            }
            if (this.currentTab == 'Movements') {
                return {
                    member_id: this.member.id,
                    movements: this.member.movements,
                }
            }
            if (this.currentTab == 'AdditionalParamsList') {
                return {
                    ownerId: this.member.id,
                    owner: 'App\\Models\\HouseholdMember',
                    additionalParams: this.member.additional_params,
                }
            }
        },
    },
    created() {
        this.fetchMember();
    },
    components: {
        MainInfo,
        LandYears,
        Movements,
        AdditionalParamsList,
    }
}

</script>
