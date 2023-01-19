<template>
    <tr>
        <td :class="rowTitleClass" v-html="rowTitle"></td>
        <td v-for="year in years"
            :key="(year.year+'-'+year[field])"
            class="table-cell-bordered">
                <template v-if="fieldValue">
                    <template v-if="year[field]">
                        так
                    </template>
                    <template v-else>
                        ні
                    </template>
                </template>
                <template v-else>
                    {{year[field]}}
                </template>
        </td>
    </tr>

</template>

<script>
export default {
    name: 'TableRow',
    props: {
        'rowTitle': {
            type: String,
            required: true
        },
        'rowTitleClass': {
            type: String,
            required: false,
            default: ''
        },
        'field': {
            type: String,
            required: true
        },
        'fieldValue': {
            type: Boolean,
            required: false,
            default: () => false
        },
        'years': {
            type: Array,
            required: true
        },
    },
    data() {
        return {}
    }
}
</script>


<style lang="scss" scoped>
tr td:not(:first-child),
tr th:not(:first-child) {
    text-align: center;
}
td.table-cell-bordered {
    border-left: 1px solid #dee2e6;
    border-right: 1px solid #dee2e6;
}
</style>
