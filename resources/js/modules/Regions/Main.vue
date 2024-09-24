<template>    

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Регіони'</span>
                <ButtonAdd 
                    @click="addRegion"
                    buttonClass="btn-primary p-2"
                    title="Додати новий регіон" />                
               
                <ButtonRefreshData 
                    buttonClass="btn-outline-primary ms-2 p-2"   
                    @click="$store.dispatch('Regions/fetchRecords')" />

            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="regions"
                    tableClass="table-bordered table-hover"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th class="show-record"></th>
                        <th>Назва</th>
                        <th>Обласний центр</th>
                        <th></th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td class="text-center">
                            <DictionaryShowRecordLink routeName="regions.show" :routeParamId="record.id" />                         
                        </td>
                        <td>{{record.name}}</td>
                        <td>{{record.center}}</td>
                        <td></td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <RegionForm
            :formData="form"
            @refreshData="$store.dispatch('Regions/fetchRecords')"/>

</template>


<script>
import { mapGetters }           from 'vuex';
import { Modal }                from 'bootstrap';

import RegionForm               from './Form.vue';

import ButtonRefreshData        from '../../components/ui/Buttons/ButtonRefreshData.vue';
import DictionaryShowRecordLink from '../../components/ui/DictionaryShowRecordLink.vue';

export default {
    components: {
        RegionForm,        
        ButtonRefreshData,
        DictionaryShowRecordLink
    },
    data() {
        return {
            form: {
                name: '',
                center: ''
            },            
        }
    },
    provide() {
        return {
            modalTitle: 'Новий регіон',
        }
    },
    methods: {
        addRegion() {
            var myModal = new Modal(document.getElementById('RegionForm'))
            myModal.show();
        },
        searchData(row, searchText) {
            return  row['name'].toLowerCase().includes(searchText.toLowerCase()) || 
                    row['center'].toLowerCase().includes(searchText.toLowerCase());
        },
    },
    computed: {
        ...mapGetters('Regions', ['regions']),
    },
}
</script>
