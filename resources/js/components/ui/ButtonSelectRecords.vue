<template>

    <button type="button"
            class="position-relative ms-2 btn btn-sm"
            :class="btnClass"
            @click="$emit('toggleSelectMode')"
            :title="title">
        <span class="mdi mdi-checkbox-multiple-outline"></span>
        <span   class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                v-if="selectedRecordsCount > 0">
            {{ selectedRecordsCount }}
        </span>
    </button>

</template>

<script>

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
        'btnClass': {
            type: [String, Array],
            required: false,
            default: ''
        }
    }
}
</script>