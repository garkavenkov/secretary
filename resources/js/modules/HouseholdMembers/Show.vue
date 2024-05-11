<template>

    <breadcrumbs  v-if="member?.id" />

    <div class="card" v-if="member?.id">
        <div class="card-header">
            <div>
                <h5>{{ member.full_name }} </h5>
                <h6>
                    {{ member.full_address }} |
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
                        <router-link :to="{name: 'household-member.info'}" class="nav-link">
                            <span class="mdi mdi-account-details-outline me-1"></span>
                            Головна інформація
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="{name: 'household-member.lands'}" class="nav-link">
                            <span class="mdi mdi-land-fields me-1"></span>
                            Земля
                        </router-link>
                    </li>
                    <li class="nav-item" >
                        <router-link :to="{name: 'household-member.movements'}" class="nav-link">
                            <span class="mdi mdi-transit-transfer me-1"></span>
                            Реєстрація / Переміщення
                        </router-link>
                    </li>                   
                    <li class="nav-item">
                        <router-link :to="{name: 'household-member.additional-data'}" class="nav-link">
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
    
    <Page404 v-else
        :message="`Член домогосподарства з id:${id} відсутній`" 
        resource="img/404/member.png" 
        fallbackUrl="household-members" 
        fallbackUrlMessage="Повернутись до переліку членів домогосподарств"/>
    

</template>

<script>

import { mapGetters } from 'vuex';
import { mapActions } from 'vuex/dist/vuex.cjs.js';

import Page404 from '../../components/Page404.vue';

export default {
    name: 'HouseholdMembersShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    components: {
        Page404
    },
    data() {
        return {
            notFoundMessage: ''
        }
    },
    methods: {
        ...mapActions('HouseholdMembers', ['fetchRecord']),
        // fetchMember() {
        //     let memberId = this.$route.params.memberId;
        //     axios.get(`/api/v1/household-members/${this.id}`)
        //         .then(res => {
        //             this.member = res.data.data;
        //         })
        // },
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['member'])
    },  
    created() {
        // this.$store.dispatch('HouseholdMembers/fetchRecord', this.id);
                
        this.fetchRecord(this.id)
            // .catch(err => console.log(err));

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
