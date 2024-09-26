<template>

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>{{ title }}</span>
                <ButtonAdd buttonClass="btn-primary p-2" @click="$emit('newRecord')" :title="newRecordTitle"/>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="dataTable"
                    tableClass="table-bordered table-hover table-sm"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>                        
                        <th v-for="(field,index) in fields" :key="index">
                            {{ field.title }}
                        </th>
                        <th></th>
                    </tr>
                </template>
                <template  v-slot:default="slotProps">
                    <template v-if="slotProps.paginatedData.length > 0">
                        <tr     v-for="record in slotProps.paginatedData"
                                :key="record.id">                        
                            <td v-for="(field,index) in fields" :key="index">
                                {{ record[field.name] }}
                            </td>
                            <td class="actions">
    
                                <ButtonEdit 
                                        buttonClass="btn-outline-warning btn-transparent p-2" 
                                        :title="editRecordTitle" 
                                        @click="$emit('editRecord', record)" />
    
                                <ButtonDelete
                                        buttonClass="btn-outline-danger btn-transparent ms-3 p-2"
                                        :title="deleteRecordTitle" 
                                        @click="$emit('deleteRecord', record)" />
                                        
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                        <DictionaryDataSearchEmptyResult :cols="fields.length + 1" />                        
                    </template>
                </template>
            </DataTable>
        </div>
    </div>

</template>

<script>

import DictionaryDataSearchEmptyResult from './DictionaryDataSearchEmptyResult.vue';

export default {
    name:'SystemDictionaryTable',
    props: {
        title: {
            type: String,
            required: true
        },
        dataTable: {
            type: Array,
            required: true
        },
        fields: {
            type: Array,
            required: true            
        },      
        newRecordTitle: {
            type: String,
            required: false,
            default: 'Додати новий запис'
        },
        editRecordTitle: {
            type: String,
            required: false,
            default: 'Редагувати запис'
        },
        deleteRecordTitle: {
            type: String,
            required: false,
            default: 'Видалити запис'
        },
    },
    components: {
        DictionaryDataSearchEmptyResult
    },
    emits:['newRecord', 'editRecord', 'deleteRecord'],
    data() {
        return {

        }
    },
    methods: {
        searchData(row, searchText) {
            return this.fields.some(field => row[field.name].toLowerCase().includes(searchText.toLowerCase()) );
        }
    }
}
</script>


<style lang="scss" scoped>

table {
    
    th:last-of-type {
        width: 7rem;
    }

    tr {
        vertical-align: middle;

        td.actions {    
            display: flex;
            justify-content: space-around;       
        }
    }
}

</style>
