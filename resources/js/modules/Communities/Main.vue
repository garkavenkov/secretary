<template>

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Громади'</span>                
                <ButtonAdd buttonClass="btn-primary p-2" title="Додати громаду" @click="openCommunityForm"/>                
            </div>            
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="communities"
                    tableClass="table-bordered table-hover"                    
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th class="show-record"></th>
                        <th>Назва громади</th>
                        <th>Адміністративний центр</th>
                        <th>Район</th>
                        <th>Адреса</th>
                        <th>ЕДРПОУ</th>
                        <th>КОАТУУ</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        
                        <td class="text-center">
                            <DictionaryShowRecordLink routeName="communities.show" :routeParamId="record.id" />
                        </td>                                               
                        <td>{{record.name}}</td>
                        <td>{{record.center}}</td>
                        <td>{{record.district.name}}</td>
                        <td>{{record.address}}</td>
                        <td>{{record.edrpou}}</td>
                        <td>{{record.koatuu}}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <CommunityForm
            :formData="communityFormData"
            @refreshData="$store.dispatch('Communities/fetchRecords')"/>

</template>

<script>
import { mapGetters }           from 'vuex';
import { Modal }                from 'bootstrap';

import CommunityForm            from './Form.vue';
import DictionaryShowRecordLink from '../../components/ui/DictionaryShowRecordLink.vue';

export default {
    name: 'DistrictsMain',
    components: {
        CommunityForm,
        DictionaryShowRecordLink
    },
    data() {
        return {
            communityFormData: {
                region_id: 0,
                district_id: 0,
                name:   '',
                center: '',
                address:'',
                edrpou: '',
                koatuu: ''
            }
        }
    },
    provide() {
        return {
            modalTitle: 'Нова громада',
        }
    },
    methods: {
        openCommunityForm() {
            let communitForm = new Modal(document.getElementById('CommunityForm'))
            communitForm.show();
        },
        searchData(row, searchText) {
            return  row['name'].toLowerCase().includes(searchText.toLowerCase()) || 
                    row['center'].toLowerCase().includes(searchText.toLowerCase());
        },
    },
    computed: {
        ...mapGetters('Communities', ['communities'])
    }

}
</script>
