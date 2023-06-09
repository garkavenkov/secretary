<template>

    <VueModal   v-if="member.id"
                :title="member.full_name"
                :showFooter="false"
                @close="goToHouseholdMembers">

        <div class="row">
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

    </VueModal>

</template>

<script>

import VueModal             from '../../../components/ui/VueModal.vue';

import MainInfo             from './Tabs/MainInfo.vue';
import LandYears            from './Tabs/LandYears.vue';
import Movements            from './Tabs/Movements.vue';
import AdditionalParamsList from '../../AdditionalParams/AdditionalParamsList.vue'

export default {
    name: 'HouseholdMemberInfo',
    data() {
        return {
            currentTab: 'MainInfo',
            member: {}
        }
    },
    methods: {
        fetchMember() {
            let memberId = this.$route.params.memberId;
            axios.get(`/api/v1/household-members/${memberId}`)
                .then(res => {
                    this.member = res.data.data;
                })
        },
        goToHouseholdMembers() {
            this.$router.push({name: 'households.show.members', params: {id: this.$route.params.id}});
        }

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
        VueModal
    }
}
</script>


<style lang="scss" scoped>
.tab-content {
    min-height: 530px;
}
</style>
