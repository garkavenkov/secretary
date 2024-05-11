<template>
 
    <button type="button"
            class="btn btn-sm btn-outline-primary"
            :class="buttonClass"
            :title="title"
            @click="$emit('click')">
        <SvgIcon type="mdi" :path="mdiPath" :size="size" />
    </button>                        
             
</template>

<script>
import SvgIcon  from '@jamescoyle/vue-icon'

export default {
    name: 'SvgButton',        
    props: {
        mdiPath: {
            required: true
        },
        size: {
            type: Number,
            required: false,
            default: 24
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
    components: {
        SvgIcon
    },
}
</script>