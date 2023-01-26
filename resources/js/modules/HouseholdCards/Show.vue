<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <h5>Облікова картка об'єкта погосподарського обліку <span class="household-card__number">{{ household.number }}</span></h5>
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


</template>

<script>

import HouseholdMembers from './Member/HouseholdMembers.vue';
import HouseInfo        from './House/HouseInfo.vue';
import LandInfo         from './Land/LandInfo.vue';
import HouseholdInfo    from './Info/HouseholdInfo.vue';
import { mapActions, mapGetters } from 'vuex';

export default {
    name: 'ShowCard',
    components: {
        HouseholdMembers,
        HouseInfo,
        LandInfo,
        HouseholdInfo,
    },
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            currentTab: 'HouseholdInfo',
        }
    },
    methods: {},
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
            // console.log(to, from);
            // this.fetchRecord(to.params.id);
            this.$store.dispatch('Households/fetchRecord', to.params.id,);
        },

    },
    created() {
        // this.$store.dispatch('Households/fetchRecord', this.id, '/api/v1/houshold-cards');
        this.$store.dispatch('Households/fetchRecord', this.id);

    }
}
</script>


<style lang="scss" scoped>
a.nav-link.active {
    background: linear-gradient(#e9ecef, #f8fafc);
}

.household-card__number {
    font-weight: 600;
    margin-left: 0.5rem;
}

</style>
