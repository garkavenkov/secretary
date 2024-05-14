<template>

    <IconButton :class="buttonClass" :title="title" :size="size" :mdiPath="path"  @click="$emit('click', $event)" >
        <template v-slot:default>
            <span   class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                v-if="selectedRecordsCount > 0">
            {{ selectedRecordsCount }}
        </span>        
        </template>
    </IconButton>

</template>

<script>

import IconButton from './IconButton.vue';
import { 
    mdiCheckboxMultipleOutline,
    mdiCloseBoxMultipleOutline
} from '@mdi/js';

export default {
    name: 'ButtonSelectRecords',
    props: {
        title: {
            type: String,
            required: false,
            default: ''
        },
        selectedRecordsCount: {
            type: Number,
            required: false,
            default: 0
        },
        inSelectMode: {
            type: Boolean,
            required: true
        },
        buttonClass: {
            type: [Array, String],
            required: false,
            default: ''
        },
        size: {
            type: [String, Number],
            required: false,
            default: 18
        },
    },
    emits: ['click'],    
    computed: {
        path() {
            return this.inSelectMode ? mdiCloseBoxMultipleOutline : mdiCheckboxMultipleOutline;
        }
    },
    components: {        
        IconButton
    }
}
</script>