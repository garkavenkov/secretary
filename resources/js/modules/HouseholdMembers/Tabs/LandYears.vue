<template>

    <table class="table table-sm  table-bordered table-years">
        <thead class="bg-body-secondary">
            <tr>
                <th class="align-middle">
                    
                    <ButtonAdd 
                            @click="newYearData($event)" 
                            buttonClass="btn-sm btn-outline-primary btn-transparent"
                            title="Додати інформацію за рік">
                        Додати рік
                    </ButtonAdd>
                
                </th>
                <th v-for="year in years" :key="year.year">

                    <div class="d-flex align-items-center justify-content-end">

                        <span>{{year.year}}</span>
                        <DropDownMenu
                                buttonClass="btn-outline-secondary btn-transparent"
                                :showToggler="false"
                                @edit="editYear(year)" 
                                @delete="deleteYear(year)">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" @click="landOwnedReport(year.year)">                                    
                                    <SvgIcon type="mdi" :path="pathMdiLandFields" :size="16" class="text-success me-2" />
                                    <span>Звіт про склад земельної ділянки</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                        </DropDownMenu>
                        
                    </div>
                    
                </th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <TableRow   :years="years"
                        field="total"
                        rowTitle="<b>Площа земельних ділянок - усього, <small>га</small></b>" />
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
                :action="action"
                @closeYearForm="closeYearForm"
                @refreshData="fetchYears"/>
    </teleport>


</template>

<script>

import { mapGetters }           from 'vuex';
import SvgIcon                  from '@jamescoyle/vue-icon';

import {         
    mdiLandFields,    
} from '@mdi/js';

import LandYearForm             from './LandYearForm.vue';

import TableRow                 from '../../../components/ui/TableRow.vue';
import YearsPaginator           from '../../../components/ui/YearsPaginator.vue';
import IconButton               from '../../../components/ui/Buttons/IconButton.vue';
import DropDownMenu             from '../../../components/ui/DropDownMenu.vue';

import YearsCUD                 from '../../../mixins/YearsCUD';
import PrepareDataForDownload   from '../../../mixins/PrepareDataForDownload';

export default {
    name: 'MemberLandYearsTab',
    mixins: [YearsCUD, PrepareDataForDownload],
    components: {
        TableRow,
        LandYearForm,
        YearsPaginator,
        IconButton,
        SvgIcon,        
        DropDownMenu
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
            owner: 'member_id',
            yearFormId: 'LandYearForm',
            apiUrl: '/api/v1/household-member-lands',
            years: [],
            meta: [],
            perPage: 5,            
            // pathMdiPlusThick: mdiPlusThick,
            pathMdiLandFields: mdiLandFields,            
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
                    let fileName = `${this.member.surname} ${this.member.name} ${this.member.patronymic}. Довідка про склад земельної ділянки.docx`;
                    this.prepareDataForDownload(res, fileName);
                })
        },
        fetchYears(url) {
            if (url == undefined) {
                url = `/api/v1/household-members/${this.$route.params.id}/land-years?per_page=${this.perPage}`;
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
