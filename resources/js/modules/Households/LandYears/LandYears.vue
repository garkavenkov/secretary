<template>
    <div class="pt-4">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-sm table-bordered table-years">
                    <thead>
                        <tr>
                            <th>
                                <button type="button"
                                        class="btn btn-sm btn-outline-secondary btn-transparent"
                                        @click="newYearData">
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
                                        <li>
                                            <a class="dropdown-item" @click="editYear(year)">
                                                <span class="mdi mdi-pencil text-warning me-2"></span>
                                                Редагувати дані
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
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
                        <!-- <TableRow :years="years" field="purpose" rowTitle="з неї за цільовим призначенням <i>(відповідно до документів)</i>" /> -->
                        <tr>
                            <td :colspan="(years.length+1)">з неї за цільовим призначенням <i>(відповідно до документів):</i></td>
                        </tr>
                        <TableRow   :years="years"
                                    field="maintenance"
                                    rowTitle="для будівництва і обслуговування житлового будинку"
                                    rowTitleClass="ps-3"/>
                        <TableRow   :years="years"
                                    field="personal_agriculture"
                                    rowTitle="для ведення особистого селянського господарства"
                                    rowTitleClass="ps-3"/>
                        <TableRow   :years="years"
                                    field="commercial_agriculture"
                                    rowTitle="для ведення товарного сільськогосподарського виробництва"
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
                <div class="d-flex justify-content-between align-items-center" v-if="years.length > 0">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="me-1">Відображати</span>
                            <select name="per_Page"
                                    id="per_page"
                                    class="form-select form-select-sm"
                                    :disabled="years.length == 0"
                                    v-model="perPage">
                                <option v-for="(value, index) in [1,2,3,5]"
                                        :selected="perPage == value"
                                        :key="index"
                                        :value="value">
                                    {{value}}
                                </option>
                            </select>
                        </div>
                        <div class="text-muted ms-3">
                            Відображено з {{ meta.from }} по {{ meta.to }} із {{ meta.total }}
                        </div>
                    </div>
                    <ul class="pagination mb-0">
                       <li class="page-item" v-for="(link,index) in meta.links" :key="index">
                            <a  class='page-link'
                                :class="[link.active ? 'active' : '', link.url  ? '' : 'disabled' ]"
                                v-html="link.label"
                                @click="fetchYears(link.url)">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0">
                    <div class="card-header thin-header align-items-center">
                        <h6>Додаткова інформація</h6>
                        <button class="btn btn-sm btn-light btn-transparent"
                                @click="openLandAdditionalDataForm">
                            <span class="mdi mdi-pencil"></span>
                        </button>
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
            @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

</template>

<script>

import { computed }             from 'vue';
import { mapGetters }           from 'vuex';
import { Modal }                from 'bootstrap';

import TableRow                 from '../../../components/ui/TableRow.vue';
import LandYearForm             from './LandYearForm.vue';
import LandAdditionalDataForm   from './LandAdditionalDataForm.vue';

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
                household_id: null,
                land_additional_data: '',
            },
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

            this.additionalData.household_id = this.owner_id;
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
        landInfo(param) {
            let additionalParam = this.info.find(i => i.code == param)
            return additionalParam.value ? additionalParam.value : '';
        }
    },
    computed: {
        ...mapGetters('Households', {'owner_id': 'household_id', 'info': 'landInfo'})
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
    },
    components: {
        TableRow,
        LandYearForm,
        LandAdditionalDataForm
    }
}
</script>
