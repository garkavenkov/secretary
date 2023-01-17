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
                    <span class="icon">
                        <span class="mdi mdi-monitor-dashboard"></span>
                        <!-- <svg-icon type="mdi" :path="mdiMonitorDashboard"></svg-icon> -->
                    </span>
                    <span class="nav-title">Робочий стіл</span>
                </router-link>
            </li>
            <li title="Облікові картки">
                <router-link to="/household-cards">
                    <span class="icon">
                        <!-- <i class="bi bi-card-heading"></i> -->
                        <span class="mdi mdi-folder-home"></span>
                    </span>
                    <span class="nav-title">Облікові картки</span>
                </router-link>
            </li>
            <li class="has-submenu">
                <a>
                    <span class="icon">
                        <span class="mdi mdi-inbox-multiple"></span>
                    </span>
                    <span class="nav-title">Довідники</span>
                    <!-- <i class="bi bi-chevron-down"></i> -->
                    <span class="mdi mdi-chevron-down"></span>
                </a>
                <ul class="sub-menu">
                    <li class="sub-menu-title"><span>Довідники</span></li>
                    <li>
                        <router-link to="/regions">
                            <span class="icon">
                                <!-- <i class="bi bi-globe"></i> -->
                                <span class="mdi mdi-map"></span>
                            </span>
                            <span class="nav-title">Регіони</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/districts">
                            <span class="icon">
                                <!-- <i class="bi bi-buildings"></i> -->
                                <span class="mdi mdi-domain"></span>
                            </span>
                            <span class="nav-title">Райони</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/communities">
                            <span class="icon">
                                <!-- <i class="bi bi-people"></i> -->
                                <!-- <span class="mdi mdi-home-group"></span> -->
                                <span class="mdi mdi-home-city"></span>
                            </span>
                            <span class="nav-title">Громади</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/councils">
                            <span class="icon">
                                <!-- <i class="bi bi-puzzle"></i> -->
                                <span class="mdi mdi-bank"></span>
                            </span>
                            <span class="nav-title">Міськи / сільські ради</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/settlements">
                            <span class="icon">
                                <!-- <i class="bi bi-houses"></i> -->
                                <!-- <span class="mdi mdi-account-group-outline"></span> -->
                                <span class="mdi mdi-home-group"></span>
                            </span>
                            <span class="nav-title">Населені пункти</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a>
                    <span class="icon">
                        <!-- <i class="bi bi-gear"></i> -->
                        <span class="mdi mdi-table-cog"></span>
                    </span>
                    <span class="nav-title">Системні довідники</span>
                    <!-- <i class="bi bi-chevron-down"></i> -->
                    <span class="mdi mdi-chevron-down"></span>
                </a>
                <ul class="sub-menu">
                    <li class="sub-menu-title"><span>Системні довідники</span></li>
                    <li>
                        <router-link to="/household-types">
                            <span class="icon">
                                <!-- <i class="bi bi-house-gear"></i> -->
                                <span class="mdi mdi-home-circle-outline"></span>
                            </span>
                            <span class="nav-title">Типи погосподарського обліку</span>
                        </router-link>
                    </li>
                    <!-- <li class="combined-icons"> -->
                    <li>
                        <router-link to="/settlement-types">
                            <span class="icon">
                                <!-- <i class="bi bi-houses"></i> -->
                                <span class="mdi mdi-store-cog"></span>
                            </span>
                            <!-- <i class="bi bi-gear-fill"></i> -->
                            <span class="nav-title">Типи населеного пункту</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/work-places">
                            <span class="icon">
                                <!-- <i class="bi bi-person-gear"></i> -->
                                <span class="mdi mdi-wrench-cog"></span>
                            </span>
                            <span class="nav-title">Коди місця роботи (заняття)</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/family-relationships">
                            <span class="icon">
                                <!-- <i class="bi bi-diagram-3"></i> -->
                                <!-- <span class="mdi mdi-sitemap-outline"></span> -->
                                <span class="mdi mdi-family-tree"></span>
                            </span>
                            <span class="nav-title">Родинні стосунки</span>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>

    </section>

</template>

<script>
// import SvgIcon from '@jamescoyle/vue-icon';
// import { mdiMonitorDashboard } from '@mdi/js';

export default {
    name: 'SideBarMenu',
    data() {
        return {
            // mdiMonitorDashboard,
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
    },
}
</script>

<style lang="scss" scoped>
// a {
//     padding-right: 0.5rem;
// }





</style>
