<template>
    
    <ul class="nav nav-tabs" :class="navigationClass">    
        <template v-if="tabType == 'link'">
            <li class="nav-item" :class="tabClass" v-for="(tab,index) in tabs" :key="index">        
                <router-link :to="{name: tab.routeName}" class="nav-link" :class="linkClass">            
                    <SvgIcon type="mdi" :path="tab.iconPath" :size="iconSize"/>
                    <span>{{ tab.title }}</span>
                </router-link>
            </li>
        </template>
        <template v-else-if="tabType == 'button'">
            <li class="nav-item" :class="tabClass" v-for="(tab,index) in tabs" :key="index">        
                <button class="nav-link" :class="[linkClass, tab.activeTab ? 'active' : '']" @click="$emit('click', tab.tabName)">
                    <SvgIcon type="mdi" :path="tab.iconPath" :size="iconSize"/>
                    <span>{{ tab.title }}</span>
                </button>
            </li>
        </template>
    </ul>

</template>

<script>
import SvgIcon          from '@jamescoyle/vue-icon';

export default {
    name: 'NavigationTabs',
    props: {
        tabs: {
            type: Array,
            required: true
        },
        tabType: {
            type: String,
            required: false,
            default: 'link',
            validator(value) {                
                return ['link', 'button'].includes(value)
            }
        },
        iconSize: {
            type: Number,
            required: false,
            default: 18
        },
        navigationClass: {
            type: Array,
            required: false,
            default: () => []
        },
        tabClass: {
            type: Array,
            required: false,
            default: () => []
        },
        linkClass: {
            type: Array,
            required: false,
            default: () => []
        }
    },
    emits: ['click'],
    components: {
        SvgIcon
    }
}

</script> 


<style lang="scss" scoped>
.nav-link {
    display: flex;
    align-items: center;

    span {
        margin-left: 0.25rem;
    }
}
a.router-link-exact-active {
    background: linear-gradient(#e9ecef, #f8fafc);
    color: var(--bs-nav-tabs-link-active-color);
    border-color: var(--bs-nav-tabs-link-active-border-color) !important;
}
</style>
