<template>
 
    <button class="btn"
            :class="buttonClass"
            :title="title"
            @click="$emit('click', $event)">
        <SvgIcon type="mdi" :path="mdiPath" :size="size" />
        <span v-if="caption.length > 0" :class="captionClass">
            {{ caption }}
        </span>
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
        caption: {
            type: String,
            required: false,
            default: ''
        },
        buttonClass: {
            type: Array,
            required: false,
            default: () => []
        },
        captionClass: {
            type: Array,
            required: false,
            default: () => []
        }
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

    span {
        margin-left: 8px;
    }
}

</style>