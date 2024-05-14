<template>
          
    <IconButton :class="buttonClass" :title="title" :size="size" :mdiPath="path"  @click="$emit('click', $event)" >
        <template v-slot:default>
            <slot />
        </template>
    </IconButton>
    
</template>

<script>

import IconButton               from './IconButton.vue';
import { mdiFileCogOutline }    from '@mdi/js';

export default {
    name: 'ButtonDocumentGenerationForm',        
    props: {
        size: {
            type: [String, Number],
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: "Генерація документів"
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
            path: mdiFileCogOutline
        }
    },
    components: {
        IconButton
    },
}
</script>