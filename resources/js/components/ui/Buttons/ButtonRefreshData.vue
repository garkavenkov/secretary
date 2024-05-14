<template>    
    
    <IconButton :class="buttonClass" :title="title" :size="size" :mdiPath="path"  @click="$emit('click', $event)" >
        <template v-slot:default>
            <slot />
        </template>
    </IconButton>
    
</template>

<script>

import IconButton       from './IconButton.vue';
import { mdiRefresh }   from '@mdi/js';

export default {
    name: 'ButtonRefreshData',        
    props: {
        size: {
            type: Number,
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: 'Оновити дані'
        },
        buttonClass: {
            type: String,
            required: false,
            default: ''
        }
    },
    emits: ['click'],
    data() {
        return {
            path: mdiRefresh
        }
    },
    components: {        
        IconButton
    },
}
</script>