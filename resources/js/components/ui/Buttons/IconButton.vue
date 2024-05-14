<template>
 
    <button class="btn"
            :class="buttonClass"
            :title="title"
            @click="$emit('click', $event)">
        <SvgIcon type="mdi" :path="mdiPath" :size="size" />        
        <slot />
    </button>

</template>

<script>
import SvgIcon  from '@jamescoyle/vue-icon'

export default {
    name: 'IconButton',        
    props: {
        mdiPath: {
            required: true
        },
        size: {
            type: [String, Number],
            required: false,
            default: 16
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
    components: {
        SvgIcon
    },
}
</script>

<style lang="scss" scoped>

button {
    display: flex;
    align-items: center;
    gap: 0.25rem;   
}

</style>