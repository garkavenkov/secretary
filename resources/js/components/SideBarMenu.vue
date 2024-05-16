<template>
    <section class="sidebar-menu">
        <div class="logo__wrapper">
            <!-- <img src="/img/logo.svg" alt="" class="logo" style="height:48px"> -->
            <!-- <img src="/img/household_logo.png" alt="" class="logo" style="height:48px"> -->
            <img src="/img/icons/household_logo.png" alt="" class="logo" style="height:48px">
            <span>Погосподарський облік</span>
            <!-- <a class="navbar-brand" href="{{ url('/') }}"> -->
                <!-- {{ config('app.name', 'Laravel') }} -->
            <!-- </a> -->
        </div>
        <ul class="sidebar-menu__wrapper">
            <li>
                <router-link to="/">
                    <span>
                        <SvgIcon type="mdi" :path="pathMdiMonitorDashboard"/>
                    </span>
                    <span class="nav-title">Робочий стіл</span>
                </router-link>
            </li>
            <li title="Облікові картки" >
                <router-link to="/households" :class="[{'router-link-active': $route.path.indexOf('households/') > -1 }]">                    
                    <span>
                        <SvgIcon type="mdi" :path="pathMdiFolderHome"/>
                    </span>
                    <span class="nav-title">Облікові картки</span>
                </router-link>
            </li>
            <li title="Члени домогосподарств">
                <router-link to="/household-members" :class="[{'router-link-active': $route.path.indexOf('household-members/') > -1 }]">                    
                    <span>
                        <SvgIcon type="mdi" :path="pathMdiHumanFemaleFemaleChild" />
                    </span>
                    <span class="nav-title">Члени домогосподарств</span>
                </router-link>
            </li>
            <li class="has-submenu">
                <a>
                    <span>
                        <SvgIcon type="mdi" :path="pathMdiAbacus" />                    
                    </span>
                    <span class="nav-title">Аналітика</span>
                    <SvgIcon type="mdi" :path="pathMdiChevronDown" :size="16" />
                </a>
                <ul class="sub-menu">
                    <li class="sub-menu-title"><span>Аналітика</span></li>
                    <li>
                        <router-link to="/members-by-age">
                            <SvgIcon type="mdi" :path="pathMdiAccountQuestionOutline" :size="18" />
                            <span class="nav-title">Вікові групи населення</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/adulds-and-children">
                            <SvgIcon type="mdi" :path="pathMdiHumanFemaleFemaleChild" :size="18" />                            
                            <span class="nav-title">Дорослі і діти</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/reports-manager">
                            <SvgIcon type="mdi" :path="pathMdiFileCogOutline" :size="18" />
                            <span class="nav-title">Менеджер звітів</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a>
                    <span>
                        <SvgIcon type="mdi" :path="pathMdiInboxMultiple" />
                    </span>
                    <span class="nav-title">Довідники</span>
                    <SvgIcon type="mdi" :path="pathMdiChevronDown" :size="16" />
                </a>
                <ul class="sub-menu">
                    <li class="sub-menu-title"><span>Довідники</span></li>
                    <li>
                        <router-link to="/regions">
                            <SvgIcon type="mdi" :path="pathMdiMap" :size="18" />
                            <span class="nav-title">Регіони</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/districts">
                            <SvgIcon type="mdi" :path="pathMdiDomain" :size="18" />
                            <span class="nav-title">Райони</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/communities">
                            <SvgIcon type="mdi" :path="pathMdiHomeCity" :size="18" />
                            <span class="nav-title">Громади</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/councils">
                            <SvgIcon type="mdi" :path="pathMdiBank" :size="18" />
                            <span class="nav-title">Міськи / сільські ради</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/settlements">
                            <SvgIcon type="mdi" :path="pathMdiHomeGroup" :size="18" />
                            <span class="nav-title">Населені пункти</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a>
                    <span>
                        <SvgIcon type="mdi" :path="pathMdiCog" />
                    </span>
                    <span class="nav-title">Налаштування</span>
                    <SvgIcon type="mdi" :path="pathMdiChevronDown" :size="16" />
                </a>
                <ul class="sub-menu">
                    <li class="sub-menu-title"><span>Налаштування</span></li>
                    <li>
                        <router-link to="/users">
                            <SvgIcon type="mdi" :path="pathMdiAccountSupervisorOutline" :size="18" />
                            <span class="nav-title">Користувачі</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/roles">
                            <SvgIcon type="mdi" :path="pathMdiShieldAccountVariant" :size="18" />
                            <span class="nav-title">Ролі</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/permissions">
                            <SvgIcon type="mdi" :path="pathMdiShieldKeyOutline" :size="18" />
                            <span class="nav-title">Дозволи</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/permission-rights">
                            <SvgIcon type="mdi" :path="pathMdiAccountKeyOutline" :size="18" />
                            <span class="nav-title">Керування правами дозволу</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="has-submenu">
                <a>
                    <span>
                        <SvgIcon type="mdi" :path="pathMdiTableCog" />
                    </span>
                    <span class="nav-title">Системні довідники</span>
                    <SvgIcon type="mdi" :path="pathMdiChevronDown" :size="16" />
                </a>
                <ul class="sub-menu">
                    <li class="sub-menu-title"><span>Системні довідники</span></li>
                    <li>
                        <router-link to="/household-types">
                            <SvgIcon type="mdi" :path="pathMdiHomeCircleOutline" :size="18" />
                            <span class="nav-title">Типи погосподарського обліку</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/settlement-types">
                            <SvgIcon type="mdi" :path="pathMdiStoreCog" :size="18" />
                            <span class="nav-title">Типи населеного пункту</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/work-places">
                            <SvgIcon type="mdi" :path="pathMdiWrenchCog" :size="18" />
                            <span class="nav-title">Коди місця роботи (заняття)</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link to="/family-relationship-types">
                            <SvgIcon type="mdi" :path="pathMdiFamilyTree" :size="18" />
                            <span class="nav-title">Типи родинних стосунків</span>
                        </router-link>
                    </li>
                    <!-- <li>
                        <router-link to="/positions">
                            <span class="icon">
                                <span class="mdi mdi-badge-account-outline"></span>
                            </span>
                            <span class="nav-title">Посади</span>
                        </router-link>
                    </li> -->
                    <li>
                        <router-link to="/additional-params">
                            <SvgIcon type="mdi" :path="pathMdiTagMultiple" :size="18" />
                            <span class="nav-title">Додаткові параметри</span>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="app-version" v-if="appVersion">
            <span>Версія : {{ appVersion }}</span>
        </div>
    </section>

</template>

<script>

import SvgIcon from '@jamescoyle/vue-icon';
import { 
    mdiMonitorDashboard,
    mdiFolderHome,
    mdiHumanFemaleFemaleChild,
    mdiAbacus,
    mdiChevronDown,
    mdiChevronUp,
    mdiAccountQuestionOutline,
    mdiFileCogOutline,
    mdiInboxMultiple,
    mdiMap,
    mdiDomain,
    mdiHomeCity,
    mdiBank,
    mdiHomeGroup,
    mdiCog,
    mdiAccountSupervisorOutline,
    mdiShieldAccountVariant,
    mdiShieldKeyOutline,
    mdiAccountKeyOutline,
    mdiTableCog,
    mdiHomeCircleOutline,
    mdiStoreCog,
    mdiWrenchCog,
    mdiFamilyTree,
    mdiTagMultiple
} from '@mdi/js';

export default {
    name: 'SideBarMenu',
    components: {
        SvgIcon
    },
    data() {
        return {
            appVersion: '',
            pathMdiMonitorDashboard: mdiMonitorDashboard,
            pathMdiFolderHome :mdiFolderHome,
            pathMdiHumanFemaleFemaleChild: mdiHumanFemaleFemaleChild,
            pathMdiAbacus: mdiAbacus,
            pathMdiChevronDown: mdiChevronDown,
            pathMdiChevronUp: mdiChevronUp,
            pathMdiAccountQuestionOutline: mdiAccountQuestionOutline,
            pathMdiFileCogOutline: mdiFileCogOutline,
            pathMdiInboxMultiple: mdiInboxMultiple,
            pathMdiMap: mdiMap,
            pathMdiDomain: mdiDomain,
            pathMdiHomeCity: mdiHomeCity,
            pathMdiBank: mdiBank,
            pathMdiHomeGroup: mdiHomeGroup,
            pathMdiCog: mdiCog,
            pathMdiAccountSupervisorOutline: mdiAccountSupervisorOutline,
            pathMdiShieldAccountVariant: mdiShieldAccountVariant,
            pathMdiShieldKeyOutline: mdiShieldKeyOutline,
            pathMdiAccountKeyOutline: mdiAccountKeyOutline,
            pathMdiTableCog: mdiTableCog,
            pathMdiHomeCircleOutline :mdiHomeCircleOutline,
            pathMdiStoreCog: mdiStoreCog,
            pathMdiWrenchCog: mdiWrenchCog,
            pathMdiFamilyTree: mdiFamilyTree,
            pathMdiTagMultiple: mdiTagMultiple
        }
    },
    created() {
        this.appVersion = window.app.version;

        this.$store.dispatch('FamilyRelationshipTypes/fetchRecords');
        this.$store.dispatch('HouseholdTypes/fetchRecords');
        this.$store.dispatch('WorkPlaces/fetchRecords');
        this.$store.dispatch('Settlements/fetchRecords');

        this.$store.dispatch('Regions/fetchRecords');
        this.$store.dispatch('Districts/fetchRecords');
        this.$store.dispatch('SettlementTypes/fetchRecords');
        this.$store.dispatch('Councils/fetchRecords');
        this.$store.dispatch('CouncilTypes/fetchData');
        this.$store.dispatch('Communities/fetchRecords');
    },
}
</script>
