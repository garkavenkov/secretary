<template>

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>{{ title }}</span>
                <button class="btn btn-sm btn-primary" @click="$emit('newRecord')">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="dataTable"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th>Назва</th>
                        <th></th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>{{record.name}}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-secondary"
                                    @click="$emit('editRecord', record)"
                                    title="Редагувати інформацію">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

</template>

<script>

import DataTable from './DataTable.vue';

export default {
    name:'SystemDictionary',
    props: {
        'title': {
            type: String,
            required: true
        },
        'dataTable': {
            type: Array,
            required: true
        }
    },
    data() {
        return {

        }
    },
    components: {
        DataTable
    }
}
</script>


<style lang="scss" scoped>

table tr td:last-of-type {
    text-align: center;
    width: 5rem;
}

</style>
