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
                <NavigationTabs :tabs="tabs" :navigationClass="['px-3']"/>
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

import { mapGetters }   from 'vuex';
import { mapActions }   from 'vuex/dist/vuex.cjs.js';

import { 
    mdiAccountDetailsOutline,
    mdiLandFields,
    mdiTransitTransfer,
    mdiTagMultipleOutline    
} from '@mdi/js';

import Page404          from '../../components/Page404.vue';
import NavigationTabs   from '../../components/ui/NavigationTabs.vue';

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
        NavigationTabs
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
            ]
        }
    },
    methods: {
        ...mapActions('HouseholdMembers', ['fetchRecord']),       
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['member'])
    },  
    created() { 
        this.fetchRecord(this.id)            

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
