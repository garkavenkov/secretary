<template>
    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Довідник 'Громади'</span>
                <button class="btn btn-sm btn-primary" title="Додати громаду" @click="openCommunityForm">
                    <span class="mdi mdi-plus"></span>
                </button>
            </div>
            <div>
                <button class="btn btn-sm btn-outline-secondary">
                    <span class="mdi mdi-filter-outline"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    :dataTable="communities"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Район</th>
                        <th>Назва громади</th>
                        <th>Адреса</th>
                        <th>ЕДРПОУ</th>
                        <th>КОАТУУ</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'communities.show', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{record.district.name}}</td>
                        <td>
                            <router-link :to="{name: 'communities.show', params: { id: record.id }}">
                                {{record.name}}
                            </router-link>
                        </td>
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
import { mapGetters }   from 'vuex';
import { Modal }        from 'bootstrap';

import DataTable        from '../../components/ui/DataTable.vue';
import CommunityForm    from './Form.vue';

export default {
    name: 'DistrictsMain',
    components: {
        DataTable,
        CommunityForm
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
        }
    },
    computed: {
        ...mapGetters('Communities', ['communities'])
    }

}
</script>
