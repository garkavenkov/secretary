<template>

<div class="d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <div class="d-flex align-items-center">
            <span class="me-1">Відображати</span>
            <select name="per_Page"
                    id="per_page"
                    class="form-select form-select-sm"
                    @change="$emit('update:modelValue', $event.target.value)">
                    <!-- @change="$emit('perPageChanged', $event.target.value)" -->
                <option v-for="(value, index) in perPageItems"
                        :selected="modelValue == value"
                        :key="index"
                        :value="value">
                    {{value}}
                </option>
            </select>
        </div>
        <div class="text-muted ms-3">
            Відображено з {{ meta.from }} по {{ meta.to }} із {{ meta.total }}
        </div>
    </div>
    <ul class="pagination mb-0">
       <li class="page-item" v-for="(link,index) in meta.links" :key="index">
            <a  class='page-link'
                :class="[link.active ? 'active' : '', link.url  ? '' : 'disabled' ]"
                v-html="link.label"
                @click="$emit('fetchYears', link.url)">
            </a>
        </li>
    </ul>
</div>

</template>


<script>

export default {
    name: 'YearsPaginator',
    props: {
        'modelValue': {
            type: [Number, String],
            default: false
        },
        'perPageItems': {
            type: Array,
            required: false,
            default() {
                return [
                    1,
                    2,
                    3,
                    5
                ];
            }
        },
        'meta': {
            type: Object,
            required: true
        }
    },
    data() {
        return {}
    }
}

</script>
