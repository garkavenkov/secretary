<script>

import HouseholdMembers from './HouseholdMembers.vue';
import HouseInfo        from './HouseInfo.vue';
import LandInfo         from './LandInfo.vue';
import HouseholdInfo    from './HouseholdInfo.vue';
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
            // householdCard: {}
        }
    },
    methods: {
        ...mapActions('Households', ['fetchHousehold']),
        // fetchHouseholdCard() {
        //     axios.get(`/api/v1/households/${this.id}`)
        //         .then(res => {
        //             this.householdCard = res.data.data;
        //         })
        // }
    },
    computed: {
        componentProps() {
            if (this.currentTab == 'HouseholdInfo') {
                if (this.household.info) {
                    return {
                        // info: {
                        //     type: this.household.info.household_type.name,
                        //     address: this.household.info.address,
                        //     owners: this.household.info.owners
                        // }
                        info: {...this.household.info}
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
            }
        },
        ...mapGetters('Households', ['household'])
    },
    watch: {
        '$route' (to, from) {
            // console.log(to, from);
            this.fetchHousehold(to.params.id);
        },

    },
    created() {
        this.fetchHousehold(this.id);
    }
}
</script>

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
                            <i class="bi bi-info-circle"></i>
                            Основна інформація
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{'active': currentTab == 'HouseholdMembers'}" aria-current="page" @click="currentTab='HouseholdMembers'">
                            <i class="bi bi-people-fill"></i>
                            Члени домогосподарства
                        </a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" :class="{'active': currentTab == 'HouseInfo'}" @click="currentTab='HouseInfo'">
                            <i class="bi bi-house-gear-fill"></i>
                            Будинок / Квартира
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" :class="{'active': currentTab == 'LandInfo'}" @click="currentTab='LandInfo'">
                            <i class="bi bi-globe"></i>
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

<style lang="scss" scoped>
a.nav-link.active {
    background: linear-gradient(#e9ecef, #f8fafc);
}

.household-card__number {
    font-weight: 600;
    margin-left: 0.5rem;
}

</style>
