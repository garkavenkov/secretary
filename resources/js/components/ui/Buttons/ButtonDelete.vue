<template>
    
    <IconButton :class="buttonClass" :title="title" :size="size" :mdiPath="path"  @click="$emit('click', $event)" >
        <template v-slot:default>
            <slot />
        </template>
    </IconButton>
    
</template>

<script>

import IconButton       from './IconButton.vue';
import { mdiTrashCan }  from '@mdi/js';

export default {
    name: 'ButtonDelete',
    props: {
        size: {
            type: [String, Number],
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: ''
        },
        buttonClass: {
            type: [Array, String],
            required: false,
            default: ''
        }
    },
    emits: ['click'],
    data() {
        return {
            path: mdiTrashCan
        }
    },  
    components: {        
        IconButton
    },
}
</script>