<template>       
    
    <button class="btn btn-sm btn-outline-secondary"
            :class="[buttonClass, isFiltered ? 'active': '' ]"            
            @click.exact="$emit('click.exact')"
            @click.ctrl="$emit('click.ctrl')"    
            :title="title">        
        <SvgIcon type="mdi" :path="path" :size="size" />
    </button>        
        
</template>

<script>
import SvgIcon              from '@jamescoyle/vue-icon'
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
            type: String,
            required: false,
            default: ''
        },
        isFiltered: {
            type: Boolean,
            required:true,
            default: () => false
        }
    },
    emits: ['click.exact', 'click.ctrl'],
    // emits: ['click'],
    data() {
        return {
            path: mdiFilterOutline
        }
    },
    components: {
        SvgIcon
    },
}
</script>