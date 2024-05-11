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
import { mdiFileExportOutline } from '@mdi/js';
export default {
    name: 'ButtonExportRecordForm',        
    props: {
        size: {
            type: Number,
            required: false,
            default: 18
        },
        title: {
            type: String,
            required: false,
            default: 'Експорт поточних записів'
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
            path: mdiFileExportOutline
        }
    },
    components: {
        SvgIcon
    },
}
</script>