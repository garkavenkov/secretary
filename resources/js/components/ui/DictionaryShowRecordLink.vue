<template>
    
    <router-link :to="{name: routeName, params: {id: routeParamId}}" :title="title">
        <SvgIcon 
            type="mdi" 
            :path="path" 
            :size="size" />
    </router-link>

</template>

<script>

import SvgIcon              from '@jamescoyle/vue-icon';
import { 
    mdiFolderEyeOutline 
}   from '@mdi/js';

export default {
    name: 'DictionaryShowRecordLink',
    props: {
        size: {
            type: [String, Number],
            required: false,
            default: 16,
        },
        routeName: {
            type: String,
            required: true
        },
        routeParamId: {
            type: [String, Number],
            required: true
        },
        title: {
            type: String,
            required: false,
            default: 'Перейти до інформації'
        },
        mdiIconPath: {
            type: String,
            required: false,
            default: ''
        }
    },
    components: {
        SvgIcon
    },
    computed: {
        path() {
            return this.mdiIconPath !== '' ? this.mdiIconPath : mdiFolderEyeOutline
        }
    }
}
</script>