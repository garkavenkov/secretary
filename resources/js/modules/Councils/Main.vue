<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник "Міські / сільські ради"</span>
                <button class="btn btn-sm btn-primary" @click="openCouncilForm">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-funnel"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="councils"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Громада</th>
                        <!-- <th>Тип</th> -->
                        <th>Назва </th>
                        <th>Адреса</th>
                        <th>ЕДРПОУ</th>
                        <th>КОАТУУ</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'CouncilsShow', params: { id: record.id }}">
                                <i class="bi bi-eye"></i>
                            </router-link>
                        </td>
                        <td>{{record.community.name}}</td>
                        <!-- <td>{{record.council_type.name}}</td> -->
                        <td>{{record.name}}</td>
                        <td>{{record.address}}</td>
                        <td>{{record.edrpou}}</td>
                        <td>{{record.koatuu}}</td>
                    </tr>
                </template>
            </DataTable>
        </div>
    </div>

    <CouncilForm
            :formData="formData"
            @refreshData="$store.dispatch('Councils/fetchRecords')" />

</template>

<script>
import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap';

import DataTable    from '../../components/ui/DataTable.vue';
import CouncilForm  from './Form.vue';

export default {
    name: 'CouncilsMain',
    components: {
        DataTable,
        CouncilForm
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
            // districts: [],
            // communities: [],
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
    },
    computed: {
        ...mapGetters('Councils', ['councils']),
    },
}
</script>
