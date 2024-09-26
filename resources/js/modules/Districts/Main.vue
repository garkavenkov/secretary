<template>    

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Райони'</span>

                <ButtonAdd 
                    @click="openDistrictForm"
                    buttonClass="btn-primary p-2"
                    title="Додати новий район" />
               
                <ButtonRefreshData 
                    buttonClass="btn-outline-primary ms-2 p-2"   
                    @click="$store.dispatch('Districts/fetchRecords')" />
           
            </div>            
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="districts"
                    tableClass="table-bordered table-hover"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th class="show-record"></th>
                        <th>Назва района</th>
                        <th>Адміністративний центр</th>
                        <th>Область</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <template v-if="slotProps.paginatedData.length > 0">
                        <tr     v-for="record in slotProps.paginatedData"
                                :key="record.id">
                            <td class="text-center">
                                <DictionaryShowRecordLink routeName="districts.show" :routeParamId="record.id" />
                            </td>                       
                            <td>{{record.name}}</td>
                            <td>{{record.center}}</td>
                            <td>{{record.region.name}}</td>
                        </tr>
                    </template>
                    <template v-else>
                        <DictionaryDataSearchEmptyResult cols="4" />
                    </template>
                </template>
            </DataTable>
        </div>
    </div>

    <DistrictForm
            :formData="districtFormData"
            @refreshData="$store.dispatch('Districts/fetchRecords')"/>

</template>

<script>
import { mapGetters }                   from 'vuex';
import { Modal }                        from 'bootstrap';

import DistrictForm                     from './Form.vue';
import ButtonRefreshData                from '../../components/ui/Buttons/ButtonRefreshData.vue';
import DictionaryShowRecordLink         from '../../components/ui/DictionaryShowRecordLink.vue';
import DictionaryDataSearchEmptyResult  from '../../components/ui/DictionaryDataSearchEmptyResult.vue';

export default {
    name: 'DistrictsMain',
    components: {        
        DistrictForm,        
        ButtonRefreshData,
        DictionaryShowRecordLink,
        DictionaryDataSearchEmptyResult
    },
    data() {
        return {
            districtFormData: {
                region_id: 0,
                name: '',
                center: ''
            }
        }
    },
    provide() {
        return {
            modalTitle: 'Новий район',
        }
    },
    methods: {
        openDistrictForm() {
            var myModal = new Modal(document.getElementById('DistrictForm'))
            myModal.show();
        },
        searchData(row, searchText) {
            return  row['name'].toLowerCase().includes(searchText.toLowerCase()) || 
                    row['center'].toLowerCase().includes(searchText.toLowerCase());
        },
    },
    computed: {
        ...mapGetters('Districts', ['districts'])
    },
}
</script>
