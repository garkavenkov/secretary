<template>    

    <IconButton :class="buttonClass" :title="title" :size="size" :mdiPath="path"  @click="$emit('click', $event)" >
        <template v-slot:default>
            <slot />
        </template>
    </IconButton>

</template>

<script>

import IconButton               from './IconButton.vue';
import { mdiFileExportOutline } from '@mdi/js';

export default {
    name: 'ButtonExportRecordForm',        
    props: {
        size: {
            type: [String, Number],
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: 'Експорт поточних записів'
        },
        buttonClass: {
            type: [String, Array],
            required: false,
            default: ''
        }
    },
    emits: ['click'],
    data() {
        return {
            path: mdiFileExportOutline
        }
    },
    components: {
        IconButton
    },
}
</script>