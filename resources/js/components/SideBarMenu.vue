<template>
    <section class="sidebar-menu">
        <div class="logo__wrapper">
            <img src="/img/logo.svg" alt="" class="logo" style="height:48px">
            <span>Secretary</span>
            <!-- <a class="navbar-brand" href="{{ url('/') }}"> -->
                <!-- {{ config('app.name', 'Laravel') }} -->
            <!-- </a> -->
        </div>
        <ul class="sidebar-menu__wrapper">
            <li>
                <router-link to="/">
                    <i class="bi bi-laptop"></i>
                    <span>Dashboard</span>
                </router-link>
            </li>
            <li>
                <router-link to="/regions">
                    <i class="bi bi-globe"></i>
                    <span>Регіони</span>
                </router-link>
            </li>
            <li>
                <router-link to="/districts">
                    <i class="bi bi-buildings"></i>
                    <span>Райони</span>
                </router-link>
            </li>
            <li>
                <router-link to="/communities">
                    <i class="bi bi-people"></i>
                    <span>Громади</span>
                </router-link>
            </li>
            <li>
                <router-link to="/councils">
                    <i class="bi bi-puzzle"></i>
                    <span>Міськи / сільські ради</span>
                </router-link>
            </li>
            <li>
                <router-link to="/settlements">
                    <i class="bi bi-houses"></i>
                    <span>Населені пункти</span>
                </router-link>
            </li>
            <li>
                <router-link to="/household-types">
                    <i class="bi bi-house-gear"></i>
                    <span>Типи погосподарського обліку</span>
                </router-link>
            </li>
            <li class="combined-icons">
                <router-link to="/settlement-types">
                    <i class="bi bi-houses"></i>
                    <i class="bi bi-gear-fill"></i>
                    <span>Типи населеного пункту</span>
                </router-link>
            </li>
            <li>
                <router-link to="/work-places">
                    <i class="bi bi-person-gear"></i>
                    <span>Коди місця роботи (заняття)</span>
                </router-link>
            </li>
            <li>
                <router-link to="/family-relationships">
                    <i class="bi bi-diagram-3"></i>
                    <span>Родинні стосунки</span>
                </router-link>
            </li>
            <li>
                <router-link to="/household-cards">
                    <i class="bi bi-card-heading"></i>
                    <span>Облікова картка</span>
                </router-link>
            </li>
        </ul>

    </section>

</template>

<script>
export default {
    name: 'SideBarMenu',
    data() {
        return {

        }
    },
    created() {
        this.$store.dispatch('Regions/fetchRecords');
        this.$store.dispatch('Districts/fetchRecords');
        this.$store.dispatch('FamilyRelationships/fetchRecords');
        this.$store.dispatch('HouseholdTypes/fetchRecords');
        this.$store.dispatch('WorkPlaces/fetchRecords');
        this.$store.dispatch('SettlementTypes/fetchRecords');
        this.$store.dispatch('Settlements/fetchRecords');
        this.$store.dispatch('Councils/fetchRecords');
        this.$store.dispatch('CouncilTypes/fetchData');
        this.$store.dispatch('Communities/fetchRecords');
    }
}
</script>

<style lang="scss" scoped>
a {
    padding-right: 0.5rem;
}
</style>
