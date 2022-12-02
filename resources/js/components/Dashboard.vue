<template>
    <!-- <div class="container-fluid"> -->
        <!-- <div class="row justify-content-center"> -->
        <div class="row">
            <div class="col">
                <router-link to="/regions">Регіони</router-link>
                <router-link to="/districts">Райони</router-link>
                <router-link to="/communities">Громади</router-link>
                <router-link to="/family-relationships">Родинні відносини</router-link>
                <router-link to="/household-types">Типи погосподарського обліку</router-link>
                <router-link to="/household-cards">Облікова картка</router-link>
            </div>
        </div>
    <!-- </div> -->
</template>

<script>
import { mapActions } from 'vuex'
    export default {
        mounted() {

        },
        methods: {
            // ...mapActions('Regions', {fetchRegions: 'fetchData'}),
            // ...mapActions('Districts', {fetchDistricts: 'fetchData'}),
        },
        created() {
            // this.fetchRegions();
            this.$store.dispatch('Regions/fetchData');
            this.$store.dispatch('Districts/fetchData');
            this.$store.dispatch('FamilyRelationships/fetchData');
            this.$store.dispatch('HouseholdTypes/fetchData');
        }
    }
</script>
