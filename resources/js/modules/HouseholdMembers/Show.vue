<template>

    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div>
                <h5>{{ member.full_name }} </h5>
                <h6>
                    {{ member.address }} |
                    <router-link 
                            v-if="member.household_id"
                            :to="{ name: 'households.show.info', params: { id: member.household_id }}" 
                            @click.ctrl.prevent="$router.push({name: 'households.show.members', params: { id: member.household_id }})"
                            >
                        {{ member.household_number }}
                    </router-link>
                </h6>
            </div>
        </div>
        <div class="card-body">
            <div class="px-3 pt-3">
                <ul class="nav nav-tabs px-3">
                    <li class="nav-item">
                        <router-link :to="{name: 'HouseholdMember.info'}" class="nav-link">
                            <span class="mdi mdi-account-details-outline me-1"></span>
                            Головна інформація
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'HouseholdMember.lands'}" class="nav-link">
                            <span class="mdi mdi-land-fields me-1"></span>
                            Земля
                        </router-link>
                    </li>
                    <li class="nav-item" >
                        <router-link :to="{name: 'HouseholdMember.movements'}" class="nav-link">
                            <span class="mdi mdi-transit-transfer me-1"></span>
                            Реєстрація / Переміщення
                        </router-link>
                    </li>                   
                    <li class="nav-item">
                        <router-link :to="{name: 'HouseholdMember.additional-data'}" class="nav-link">
                            <span class="mdi mdi-tag-multiple me-1"></span>
                            Додаткові дані
                        </router-link>
                    </li>
                </ul>
                <div class="pt-2">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import { mapGetters } from 'vuex';

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
        ...mapGetters('HouseholdMembers', ['member'])
    },
    created() {
        this.$store.dispatch('HouseholdMembers/fetchRecord', this.id);

    },
    watch: {
        '$route' (to, from) {                     
            if ((to.params.id !== from.params.id) && (to.name == from.name)) {                
                this.$store.dispatch('HouseholdMembers/fetchRecord', to.params.id,);
            }
        },
    }
}

</script>


<style lang="scss" scoped>

a.router-link-exact-active {
    background: linear-gradient(#e9ecef, #f8fafc);
    color: var(--bs-nav-tabs-link-active-color);
    border-color: var(--bs-nav-tabs-link-active-border-color) !important;
}

</style>
