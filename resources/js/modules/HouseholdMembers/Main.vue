<template>

    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            <div class="dictionary-name__wrapper">
                <span>Члени домогосподарств</span>
                <button class="btn btn-sm btn-outline-primary ms-2" @click="$store.dispatch('HouseholdMembers/fetchRecords')" title="Оновити дані">
                    <span class="mdi mdi-refresh"></span>
                </button>
            </div>
            <div>
                <button :class="['btn btn-sm btn-outline-secondary', filter.isFiltered ? 'active' : '' ]"
                        @click.exact="openFilterForm"
                        @click.ctrl="resetFilter"
                        title="Фільтр членів домогосподарств">
                    <span class="mdi mdi-filter-outline"></span>
                </button>
            </div>
        </div>
        <div class="card-body">
            <DataTable
                    v-if="members.length > 0"
                    :dataTable="members"
                    tableHeaderClass="table-dark">
                <template v-slot:header>
                    <tr>
                        <th></th>
                        <th>Призвіще ім'я по батькові</th>
                        <th class="text-center">Дата народження</th>
                        <!-- <th>Призвіще</th>
                        <th>Ім'я</th>
                        <th>По Батькові</th> -->
                        <th>Адреса</th>
                        <th class="text-center">Домогосподарство</th>
                    </tr>
                </template>
                <template v-slot:default="slotProps">
                    <tr     v-for="record in slotProps.paginatedData"
                            :key="record.id">
                        <td>
                            <router-link :to="{name: 'household.members.show', params: { id: record.id }}">
                                <span class="mdi mdi-eye-outline"></span>
                            </router-link>
                        </td>
                        <td>{{record.full_name}}</td>
                        <td class="text-center">{{record.birthdate_formatted}}</td>
                        <!-- <td>{{record.surname}}</td>
                        <td>{{record.name}}</td>
                        <td>{{record.patronymic}}</td> -->
                        <td>{{record.address}}</td>
                        <td class="text-center">
                            <router-link :to="{name: 'households.show.info', params: { id: record.household_id }}">
                                <!-- <span class="mdi mdi-eye-outline"></span> -->
                                {{record.household_number}}
                            </router-link>
                        </td>
                        <!-- <td>{{record.address}}</td> -->
                    </tr>
                </template>
            </DataTable>
            <div v-else class="text-muted text-center p-3">
                Немає даних для відображення.
            </div>
        </div>
    </div>

    <MembersFilterForm  @resetFilter="resetFilter"/>

</template>

<script>
import { mapGetters }       from 'vuex';
import { Modal }            from 'bootstrap'

import DataTable            from '../../components/ui/DataTable.vue';
import MembersFilterForm    from './MembersFilterForm.vue';

export default {
    name: 'HouseholdMembersMain',
    data() {
        return {
        }
    },
    provide() {
        return {
            modalTitle: 'Фільтр членів домогосподарств',
            modalSubmitCaption: 'Застосувати',
        }
    },
    methods: {
        openFilterForm() {
            // this.modalTitle = 'Фільтр членів домогосподарств';
            // this.modalSubmitCaption = 'Застосувати';

            let filterForm = new Modal(document.getElementById('MembersFilterForm'));
            filterForm.show();
        },
        resetFilter() {
            this.filter.settlement_id = 0;
            this.filter.isFiltered = false;
            this.$store.dispatch('HouseholdMembers/applyFilter', this.filter);
        },
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['members', 'filter']),
    },
    components: {
        DataTable,
        MembersFilterForm
    }

}

</script>
