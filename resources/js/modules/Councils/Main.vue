<template>    

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Міські / сільські ради'</span>
                <ButtonAdd buttonClass="btn-primary p-2" @click="openCouncilForm" />                
            </div>           
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="councils"
                    tableClass="table-bordered table-hover"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th class="show-record"></th>
                        <th>Назва </th>
                        <th>Громада</th>                        
                        <th>Адреса</th>
                        <th>ЕДРПОУ</th>
                        <th>КОАТУУ</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <template v-if="slotProps.paginatedData.length > 0">
                        <tr     v-for="record in slotProps.paginatedData"
                                :key="record.id">
                           
                            <td class="text-center">
                                <DictionaryShowRecordLink routeName="councils.show" :routeParamId="record.id" />
                            </td>                       
                            <td>{{record.name}}</td>
                            <td>{{record.community.name}}</td>
                            <td>{{record.address}}</td>
                            <td>{{record.edrpou}}</td>
                            <td>{{record.koatuu}}</td>
                        </tr>
                    </template>
                    <template v-else>
                        <DictionaryDataSearchEmptyResult cols="6" />
                    </template>
                </template>
            </DataTable>
        </div>
    </div>

    <CouncilForm
            :formData="formData"
            @refreshData="$store.dispatch('Councils/fetchRecords')" />

</template>

<script>
import { mapGetters }                   from 'vuex';
import { Modal }                        from 'bootstrap';

import CouncilForm                      from './Form.vue';
import DictionaryShowRecordLink         from '../../components/ui/DictionaryShowRecordLink.vue';
import DictionaryDataSearchEmptyResult  from '../../components/ui/DictionaryDataSearchEmptyResult.vue';

export default {
    name: 'CouncilsMain',
    components: {
        CouncilForm,
        DictionaryShowRecordLink,
        DictionaryDataSearchEmptyResult
    },
    data() {
        return {
            formData: {
                region_id:          0,
                district_id:        0,
                community_id:       0,
                council_type_id:    0,
                name:               '',
                address:            '',
                edrpou:             '',
                koatuu:             '',
            },
        }
    },
    provide() {
        return {
            modalTitle: 'Нова рада',
        }
    },
    methods: {
        openCouncilForm() {
            var myModal = new Modal(document.getElementById('CouncilForm'));
            myModal.show();
        },
        searchData(row, searchText) {
            return  row['name'].toLowerCase().includes(searchText.toLowerCase()) || 
                    row['community']['name'].toLowerCase().includes(searchText.toLowerCase());
        },
    },
    computed: {
        ...mapGetters('Councils', ['councils']),
    },
}
</script>
