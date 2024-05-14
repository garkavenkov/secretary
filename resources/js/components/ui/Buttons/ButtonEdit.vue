<template>
    
    <IconButton :class="buttonClass" :title="title" :size="size" :mdiPath="path"  @click="$emit('click', $event)" >
        <template v-slot:default>
            <slot />
        </template>
    </IconButton>
    
</template>

<script>

import { mdiPencil }    from '@mdi/js';
import IconButton       from './IconButton.vue';

export default {
    name: 'ButtonEdit',
    props: {
        size: {
            type: Number,
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: 'Редагувати данні'
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
            path: mdiPencil
        }
    },  
    components: {        
        IconButton
    },
}
</script>