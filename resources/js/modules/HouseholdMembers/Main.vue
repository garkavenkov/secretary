<template>

    <breadcrumbs />


        <div class="card">
            <div class="card-header">
                <div class="dictionary-name__wrapper">
                    <span>Облікові картки</span>
                    <button class="btn btn-sm btn-primary" @click="addMember">
                        <span class="mdi mdi-plus"></span>
                    </button>
                    <button class="btn btn-sm btn-outline-primary ms-2" @click="$store.dispatch('Households/fetchRecords')" title="Оновити дані">
                        <span class="mdi mdi-refresh"></span>
                    </button>
                </div>
                <!-- <div>
                    <button :class="['btn btn-sm btn-outline-secondary', filter.isFiltered ? 'active' : '' ]"
                            @click.exact="openFilterForm"
                            @click.ctrl="resetFilter"
                            title="Фільтр облікових карток">
                        <span class="mdi mdi-filter-outline"></span>
                    </button>
                </div> -->
            </div>
            <div class="card-body">
                <DataTable
                        v-if="members.length > 0"
                        :dataTable="members"
                        tableHeaderClass="table-dark">
                    <template v-slot:header>
                        <tr>
                            <th></th>
                            <th>Призвіще</th>
                            <th>Ім'я</th>
                            <th>По Батькові</th>
                            <th>Адреса</th>
                            <th>Домогосподарство</th>
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
                            <td>{{record.surname}}</td>
                            <td>{{record.name}}</td>
                            <td>{{record.patronymic}}</td>
                            <td>{{record.address}}</td>
                            <td>
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


</template>

<script>
import DataTable            from '../../components/ui/DataTable.vue';

export default {
    name: 'HouseholdMembersMain',
    data() {
        return {
            members: [
                // {
                //     id: 1,
                //     fio: 'Іваненко Микола Іванович',
                //     address: 'с. Шаповалівка, вул. Центральна, буд. 1',
                //     household: '01-2131-1'
                // },
                // {
                //     id: 2,
                //     fio: 'Іваненко Галина Степанівна',
                //     address: 'с. Шаповалівка, вул. Центральна, буд. 1',
                //     household: '01-2131-1'
                // },
                // {
                //     id: 3,
                //     fio: 'Іваненко Федір Миколайович',
                //     address: 'с. Шаповалівка, вул. Центральна, буд. 1',
                //     household: '01-2131-1'
                // },
                // {
                //     id: 4,
                //     fio: 'Іваненко Софія Петрівна',
                //     address: 'с. Шаповалівка, вул. Центральна, буд. 1',
                //     household: '01-2131-1'
                // }
            ]
        }
    },
    methods: {
        addMember() {},
        fetchMembers() {
            axios.get('api/v1/household-members')
                .then(res => {
                    this.members = res.data.data;
                })
        }
    },
    created() {
        this.fetchMembers();
    },
    components: {
        DataTable
    }

}

</script>
