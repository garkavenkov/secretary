<template>
 
    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Населенні пункти'</span>
                <ButtonAdd buttonClass="btn-primary p-2" @click="openSettlementForm" />                
            </div>         
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="settlements"
                    tableClass="table-bordered table-hover"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th class="show-record"></th>
                        <th>Назва</th>
                        <th>Тип</th>
                        <th>Сільська рада</th>
                        <th>Індекс</th>
                        <th>КАТОТТГ</th>
                        <th></th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <template v-if="slotProps.paginatedData.length > 0">
                        <tr     v-for="record in slotProps.paginatedData"
                                :key="record.id">
                            <td class="text-center">
                                <DictionaryShowRecordLink routeName="settlements.show" :routeParamId="record.id" />
                            </td>
                            <td>{{ record.name }}</td>
                            <td>{{ record.settlement_type.name }}</td>
                            <td>{{ record.council.name }}</td>
                            <td>{{ record.postcode }}</td>
                            <td>{{ record.katottg }}</td>
                            <td></td>
                        </tr>
                    </template>
                    <template v-else>
                        <DictionaryDataSearchEmptyResult cols="7" />
                    </template>
                </template>
            </DataTable>
        </div>
    </div>

    <SettlementForm
            :formData="formData"
            @refreshData="$store.dispatch('Settlements/fetchRecords')" />

</template>

<script>
import { mapGetters }                   from 'vuex';
import { Modal }                        from 'bootstrap'

import SettlementForm                   from './Form.vue';
import DictionaryShowRecordLink         from '../../components/ui/DictionaryShowRecordLink.vue';
import DictionaryDataSearchEmptyResult  from '../../components/ui/DictionaryDataSearchEmptyResult.vue';

export default {
    name: 'SettlementsMain',
    components: {
        SettlementForm,
        DictionaryShowRecordLink,
        DictionaryDataSearchEmptyResult
    },
    data() {
        return {
            formData: {
                region_id           : 0,
                district_id         : 0,
                community_id        : 0,
                council_id          : 0,
                settlement_type_id  : 0,
                name                :'',
                postcode            :'',
                inner_code          :'',
                katottg             :'',
            }
        }
    },
    provide() {
        return {
            modalTitle: 'Новий населений пункт',
        }
    },
    methods: {
        openSettlementForm() {
            var settlementForm = new Modal(document.getElementById('SettlementForm'));
            settlementForm.show();
        },
        searchData(row, searchText) {
            return row['name'].toLowerCase().includes(searchText.toLowerCase());
        },
    },
    computed: {
        ...mapGetters('Settlements', ['settlements']),
    },
}
</script>

