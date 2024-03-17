<template>

    <table class="table table-sm  table-bordered table-years">
        <thead class="bg-body-secondary">
            <tr>
                <th>
                    <button type="button"
                            class="btn btn-sm btn-outline-secondary btn-transparent"
                            @click="newYearData($event)">
                        <span class="mdi mdi-plus-thick"></span>
                        Додати рік
                    </button>
                </th>
                <th v-for="year in years"
                    :key="year.year">
                    {{year.year}}
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light btn-transparent"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                title="Операції з даними за рік">
                            <span class="mdi mdi-cog"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!--
                                ---- place widget for available reports ??????

                                <li v-for="report in reports" :key=`year+report.id`>
                                    <a class="dropdown-item" @click="report.code">  // arguments in report ????
                                        <span :class="['me-2', report.icon]" style="color:green;"></span>
                                        {{report.name}}
                                    </a>
                                </li>
                             -->
                            <li>
                                <a class="dropdown-item" @click="landOwnedReport(year.year)">
                                    <span class="mdi mdi-land-fields me-2" style="color:green;"></span>
                                    Звіт про склад земельної ділянки
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" @click="editYear(year)">
                                    <span class="mdi mdi-pencil text-warning me-2"></span>
                                    Редагувати дані
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" @click="deleteYear(year)">
                                    <span class="mdi mdi-trash-can text-danger me-2"></span>
                                    Видалити дані
                                </a>
                            </li>
                        </ul>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <TableRow   :years="years"
                        field="total"
                        rowTitle="<b>Площа земельних ділянок - усього</b>" />
            <TableRow   :years="years"
                        field="maintenance"
                        rowTitle="під забудовою"
                        rowTitleClass="ps-3"/>
            <TableRow   :years="years"
                        field="personal_agriculture"
                        rowTitle="для ведення  <abbr title='особистого селянського господарства'>ОСГ</abbr>"
                        rowTitleClass="ps-3"/>
            <TableRow   :years="years"
                        field="hay_cutting"
                        rowTitle="сінокосіння"
                        rowTitleClass="ps-3"/>
            <TableRow   :years="years"
                        field="pastures"
                        rowTitle="пасовища"
                        rowTitleClass="ps-3"/>
            <TableRow   :years="years"
                        field="land_share"
                        rowTitle="земельний пай"
                        rowTitleClass="ps-3"/>
            <TableRow   :years="years"
                        field="property_share"
                        rowTitle="майновий пай"
                        rowTitleClass="ps-3"/>
        </tbody>
    </table>
    <YearsPaginator
            v-if="years.length > 0"
            v-model="perPage"
            :meta="meta"
            @fetchYears="fetchYears" />

    <teleport to="body">
        <LandYearForm
                :formData="yearData"
                :title="title"
                :submitCaption="submitCaption"
                :action="action"
                @closeYearForm="closeYearForm"
                @refreshData="fetchYears"/>
    </teleport>


</template>

<script>

import { Modal }        from 'bootstrap';
import { mapGetters }   from 'vuex';

import TableRow         from '../../../components/ui/TableRow.vue';
import LandYearForm     from './LandYearForm.vue';
import YearsPaginator   from '../../../components/ui/YearsPaginator.vue';

import YearsCUD         from '../../../mixins/YearsCUD';

export default {
    name: 'MemberLandYearsTab',
    mixins: [YearsCUD],
    components: {
        TableRow,
        LandYearForm,
        YearsPaginator
    },
    data() {
        return {
            yearData: {
                id: null,
                member_id: null,
                year: new Date().getFullYear(),
                maintenance: 0,
                personal_agriculture: 0,
                hay_cutting: 0,
                pastures: 0,
                land_share: 0,
                property_share: 0
            },
            action: '',
            title: '',
            submitCaption: '',
            owner: 'member_id',
            yearFormId: 'LandYearForm',
            apiUrl: '/api/v1/household-member-lands',
            years: [],
            meta: [],
            perPage: 5
        }
    },
    methods: {
        closeYearForm() {
            this.yearData.id = null;
            this.yearData.year = new Date().getFullYear();
            this.yearData.maintenance = 0;
            this.yearData.personal_agriculture = 0;
            this.yearData.hay_cutting = 0;
            this.yearData.pastures = 0;
            this.yearData.land_share = 0;
            this.yearData.property_shar = 0;
        },
        landOwnedReport(year) {
            let data = {
                report: 'landOwned',
                year: year,
                // member_id: this.ownerId
                member_id: this.$route.params.id
            }

            axios.post('/api/v1/generate-report', data,    { responseType: 'arraybuffer'} )
                .then(res => {

                    const url = window.URL.createObjectURL(new Blob([res.data]));
                    const link = document.createElement('a');

                    link.href = url;
                    let fileName = `${this.member.surname} ${this.member.name} ${this.member.patronymic}. Довідка про склад земельної ділянки.docx`;
                    link.setAttribute('download', fileName);
                    document.body.appendChild(link);

                    link.click();
                })
        },
        fetchYears(url) {
            if (url == undefined) {
                url = `/api/v1/household-members/${this.$route.params.id}/land?per_page=${this.perPage}`;
            }
            axios.get(url)
                .then(res => {
                    this.years = res.data.data.reverse();
                    this.meta = res.data.meta;
                });
        },
    },
    computed: {
        ...mapGetters('HouseholdMembers',  {'owner_id': 'memberId', 'member': 'member'}),
    },
    created() {
        this.fetchYears();
    },
    watch: {
        '$route' (to, from) {
            if (to.params.id !== from.params.id) {
                this.fetchYears();
            }
        },
        'perPage' (newVal, oldVal) {
            if (newVal) {
                this.fetchYears();
            }
        }
    }

}

</script>
