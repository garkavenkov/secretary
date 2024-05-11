<template>

    <button type="button"
            class="btn btn-sm btn-outline-primary"
            :class="buttonClass"
            :title="title"
            @click="$emit('click')">
        <SvgIcon type="mdi" :path="path" :size="size" />
    </button>                        
             
</template>

<script>
import SvgIcon                  from '@jamescoyle/vue-icon'
import { mdiFileCogOutline }    from '@mdi/js';
export default {
    name: 'ButtonDocumentGenerationForm',        
    props: {
        size: {
            type: Number,
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: "Генерація документів"
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
            path: mdiFileCogOutline
        }
    },
    components: {
        SvgIcon
    },
}
</script>