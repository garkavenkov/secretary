<template>

    <button type="button"
            class="position-relative ms-2 btn btn-sm"
            :class="btnClass"
            @click="$emit('click')"
            :title="title">
        
        <SvgIcon type="mdi" :path="pathCheckBox" :size="size" v-if="!inSelectMode" />
        <SvgIcon type="mdi" :path="pathCloseBox" :size="size" v-else />

        <span   class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                v-if="selectedRecordsCount > 0">
            {{ selectedRecordsCount }}
        </span>        
    </button>

</template>

<script>

import SvgIcon                  from '@jamescoyle/vue-icon'
import { 
    mdiCheckboxMultipleOutline,
    mdiCloseBoxMultipleOutline
} from '@mdi/js';

export default {
    name: 'ButtonSelectRecords',
    props: {
        'title': {
            type: String,
            required: false,
            default: ''
        },
        'selectedRecordsCount': {
            type: Number,
            required: false,
            default: 0
        },
        'inSelectMode': {
            type: Boolean,
            required: true
        },
        'btnClass': {
            type: [String, Array],
            required: false,
            default: ''
        },
        'size': {
            type: Number,
            required: false,
            default: 18
        },
    },
    emits: ['click'],
    data() {
        return {
            pathCheckBox: mdiCheckboxMultipleOutline,
            pathCloseBox: mdiCloseBoxMultipleOutline
        }
    },
    components: {
        SvgIcon
    }
}
</script>