<script>

import HouseholdMembers from './HouseholdMembers.vue';
import HouseInfo        from './HouseInfo.vue';
import LandInfo         from './LandInfo.vue';
import HouseholdInfo    from './HouseholdInfo.vue';

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'HouseholdCardsMain',
    components: {
        DataTable,
        HouseholdMembers,
        HouseInfo,
        LandInfo,
        HouseholdInfo
    },
    data() {
        return {
            currentTab: 'HouseholdInfo'
        }
    },
    methods: {

    },
    computed: {
        // ...mapGetters('HouseholdTypes', ['householdTypes'])
    },
    created() {
        // this.fetchData();
    }
}
</script>

<template>
    <h4>
        Облікова картка о'єкта погосподарського обліку <span>01-0001-1</span>
    </h4>
    <div>
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link" :class="{'active': currentTab == 'HouseholdInfo'}" aria-current="page" @click="currentTab='HouseholdInfo'">Основна інформація</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{'active': currentTab == 'HouseholdMembers'}" aria-current="page" @click="currentTab='HouseholdMembers'">Члени домогосподарства</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" :class="{'active': currentTab == 'HouseInfo'}" @click="currentTab='HouseInfo'">Будинок / Квартира</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" :class="{'active': currentTab == 'LandInfo'}" @click="currentTab='LandInfo'">Земля</a>
                </li>
            </ul>
            <KeepAlive>
                <component :is="currentTab"></component>
            </KeepAlive>
        </div>
    </div>
</template>
