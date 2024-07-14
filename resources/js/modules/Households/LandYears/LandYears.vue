<template>
    <div class="pt-4">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-sm table-bordered table-years">
                    <thead class="bg-body-secondary">
                        <tr>
                            <th class="align-middle">
                               
                                <ButtonAdd 
                                        @click="newYearData($event)" 
                                        buttonClass="btn-outline-primary btn-transparent px-2 py-1"
                                        title="Додати інформацію за рік">
                                    Додати рік
                                </ButtonAdd>

                            </th>
                            <th v-for="year in years" :key="year.year">         

                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="year">{{year.year}}</div>
                                    <DropDownMenu
                                        buttonClass="btn-outline-secondary btn-transparent"
                                        :showToggler="false"
                                        @edit="editYear(year)" 
                                        @delete="deleteYear(year)" />

                                </div>
                                                             
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <TableRow   :years="years"
                                    field="total"
                                    rowTitle="<b>Площа земельних ділянок - усього, <small>га</small></b>" />
                        <tr>
                            <td :colspan="(years.length+1)">з неї за цільовим призначенням <i>(відповідно до документів):</i></td>
                        </tr>
                        <TableRow   :years="years"
                                    field="maintenance"
                                    rowTitle="для будівництва і обслуговування житлового будинку, <small>га</small>"
                                    rowTitleClass="ps-3"/>
                        <TableRow   :years="years"
                                    field="personal_agriculture"
                                    rowTitle="для ведення особистого селянського господарства, <small>га</small>"
                                    rowTitleClass="ps-3"/>
                        <TableRow   :years="years"
                                    field="commercial_agriculture"
                                    rowTitle="для ведення товарного сільськогосподарського виробництва, <small>га</small>"
                                    rowTitleClass="ps-3"/>
                        <!-- <TableRow :years="years" field="arable" rowTitle="рілля" rowTitleClass="ps-5" />
                        <TableRow :years="years" field="perennial_plantations" rowTitle="багаторічні насадження" rowTitleClass="ps-5" />
                        <TableRow :years="years" field="pastures" rowTitle="сіножатні, пасовища" rowTitleClass="ps-5" /> -->
                        <!-- <tr>
                            <td :colspan="(years.length+1)"><b>Наявність</b><i>(проставляється "так" або "ні")</i></td>
                        </tr> -->
                        <!-- <TableRow :years="years" field="water_supply" rowTitle="водопроводу" rowTitleClass="ps-5" :fieldValue="true">
                        <TableRow :years="years" field="hot_water_supply" rowTitle="горячого водопостачання" rowTitleClass="ps-5" :fieldValue="true"></TableRow> -->
                    </tbody>
                </table>
                <YearsPaginator
                    v-if="years.length > 0"
                    v-model="perPage"
                    :meta="meta"
                    @fetchYears="fetchYears" />
            </div>
            <div class="col-md-3">
                <div class="card rounded-0">
                    <div class="card-header thin-header align-items-center">                        
                        <h6>Додаткова інформація</h6>

                        <ButtonEdit 
                                @click="openLandAdditionalDataForm" 
                                :size="16"
                                buttonClass="btn-light btn-transparent p-2"
                                title="Редагувати додаткову інформацію" />
                        
                    </div>
                    <div class="card-body" v-if="info && (info.length > 0)">
                        <template v-if="landInfo('land_additional_data') !== ''">
                            {{ landInfo('land_additional_data') }}
                        </template>
                        <template v-else>
                            <div class="text-center" style="color: var(--bs-gray-600);">інформація відсутня</div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <LandYearForm
            :formData="yearData"
            :action="action"
            @refreshData="fetchYears" />

    <LandAdditionalDataForm
            :formData="additionalData"
            @refreshLandInfo="fetchLandInfo" />

</template>

<script>

import { computed }             from 'vue';
import { mapGetters }           from 'vuex';
import { Modal }                from 'bootstrap';

import LandYearForm             from './LandYearForm.vue';
import LandAdditionalDataForm   from './LandAdditionalDataForm.vue';

import TableRow                 from '../../../components/ui/TableRow.vue';
import YearsPaginator           from '../../../components/ui/YearsPaginator.vue';
import DropDownMenu             from '../../../components/ui/DropDownMenu.vue';

import NumberFormat             from '../../../mixins/NumberFormat';
import YearsCUD                 from '../../../mixins/YearsCUD';

export default {
    name: 'HouseholdLandYears',
    mixins: [NumberFormat, YearsCUD],
    data() {
        return {
            yearData: {
                household_id: null,
                year:new Date().getFullYear(),
                maintenance: 0,
                personal_agriculture: 0,
                commercial_agriculture: 0
            },
            additionalData: {
                owner: 'App\\Models\\Household',
                owner_id: null,
                land_additional_data: '',
            },
            info: [],
            modalTitle: '',
            modalSubmitCaption: '',
            action: '',
            owner: 'household_id',
            yearFormId: 'LandYearForm',
            apiUrl: '/api/v1/household-lands',
            meta: {},
            years: [],
            perPage: 5            
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        openLandAdditionalDataForm() {
            this.modalTitle = 'Додаткова інформація';
            this.modalSubmitCaption = 'Зберегти'

            this.additionalData.owner_id = this.owner_id;
            this.additionalData.land_additional_data = this.landInfo('land_additional_data');

            var additionalDataForm = new Modal(document.getElementById('LandAdditionalDataForm'))
            additionalDataForm.show()
        },
        fetchYears(url) {
            if (url == undefined) {
                url = `/api/v1/households/${this.$route.params.id}/land-years?per_page=${this.perPage}`;
            }
            axios.get(url)
                .then(res => {
                    this.years = res.data.data.reverse();
                    this.meta = res.data.meta;
                });
        },
        fetchLandInfo() {
            axios.get(`/api/v1/households/${this.$route.params.id}/land-info`)
                .then(res => {
                    this.info = res.data
                });
        },
        landInfo(param) {
            let additionalParam = this.info.find(i => i.code == param)
            return additionalParam.value ? additionalParam.value : '';
        }
    },
    computed: {
        ...mapGetters('Households', {'owner_id': 'household_id'})
    },
    created() {
        this.fetchYears();
        this.fetchLandInfo();
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
    },
    components: {
        TableRow,
        LandYearForm,
        LandAdditionalDataForm,
        YearsPaginator,        
        DropDownMenu,
    }
}
</script>
