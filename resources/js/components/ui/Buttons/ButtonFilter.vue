<template>       

    <IconButton :class="buttonClass" :title="title" :size="size" :mdiPath="path"  @click="$emit('click', $event)" >
        <template v-slot:default>
            <slot />
        </template>
    </IconButton>

</template>

<script>

import IconButton           from './IconButton.vue';
import { mdiFilterOutline } from '@mdi/js';

export default {
    name: 'ButtonFilter',
    props: {
        size: {
            type: Number,
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: ''
        },
        buttonClass: {
            type: [String, Array],
            required: false,
            default: ''
        },       
    },
    emits: ['click'],
    data() {
        return {
            path: mdiFilterOutline
        }
    },
    components: {
        IconButton
    },
}
</script>