<template>    
    <button type="button"
            class="btn btn-sm btn-primary"
            :class="buttonClass"
            :title="title"
            @click="$emit('click')">
        <SvgIcon type="mdi" :path="path" :size="size" />
    </button>
    
</template>

<script>
import SvgIcon      from '@jamescoyle/vue-icon'
import { mdiPlus }  from '@mdi/js';
export default {
    name: 'ButtonAdd',
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
            type: String,
            required: false,
            default: ''
        }
    },
    emits: ['click'],
    data() {
        return {
            path: mdiPlus
        }
    },
    components: {
        SvgIcon
    },
}
</script>