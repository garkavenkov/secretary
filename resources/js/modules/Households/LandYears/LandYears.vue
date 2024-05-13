<template>
    <div class="pt-4">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-sm table-bordered table-years">
                    <thead class="bg-body-secondary">
                        <tr>
                            <th>                                
                                <IconButton 
                                    :buttonClass="['btn-sm btn-outline-primary btn-transparent']"                             
                                    title="Додати інформацію за рік"
                                    @click="newYearData($event)"
                                    :size="16"
                                    :mdiPath="pathMdiPlusThick" 
                                    :captionClass="['lh-24']"
                                    caption="Додати рік"/>
                            </th>
                            <th v-for="year in years" :key="year.year">                                
                                <div class="d-flex align-items-center justify-content-end">
                                    <span style="line-height: 24px;">{{year.year}}</span>
                                    <div class="dropdown">

                                        <IconButton 
                                                :buttonClass="['btn-sm btn-light btn-transparent ms-1 me-1 p-2']" 
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                                :size="16"
                                                title="Операції з даними за рік"
                                                :mdiPath="pathMdiCog" />
    
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" @click="editYear(year)">                                    
                                                    <SvgIcon type="mdi" :path="pathMdiPencil" :size="16" class="text-warning me-2" />
                                                    <span>Редагувати дані</span>                                    
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center" @click="deleteYear(year)">                                    
                                                    <SvgIcon type="mdi" :path="pathMdiTrashCan" :size="16" class="text-danger me-2" />
                                                    <span>Видалити дані</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
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
                <YearsPaginator
                    v-if="years.length > 0"
                    v-model="perPage"
                    :meta="meta"
                    @fetchYears="fetchYears" />
            </div>
            <div class="col-md-3">
                <div class="card rounded-0">
                    <div class="card-header thin-header align-items-center p-2">
                        <h6>Додаткова інформація</h6>                        
                        <IconButton 
                                :buttonClass="['btn-sm btn-light btn-transparent p-1']"
                                title="Редагувати додаткову інформацію"
                                @click="openLandAdditionalDataForm"
                                :size="16"
                                :mdiPath="pathMdiPencil" />
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
            @refreshData="$store.dispatch('Households/fetchRecord', owner_id)" />

</template>

<script>

import { computed }             from 'vue';
import { mapGetters }           from 'vuex';
import { Modal }                from 'bootstrap';
import SvgIcon                  from '@jamescoyle/vue-icon';
import { 
    mdiCog, 
    mdiPlusThick,    
    mdiPencil,
    mdiTrashCan
} from '@mdi/js';


import TableRow                 from '../../../components/ui/TableRow.vue';
import LandYearForm             from './LandYearForm.vue';
import LandAdditionalDataForm   from './LandAdditionalDataForm.vue';
import YearsPaginator           from '../../../components/ui/YearsPaginator.vue';

import NumberFormat             from '../../../mixins/NumberFormat';
import YearsCUD                 from '../../../mixins/YearsCUD';
import IconButton               from '../../../components/ui/Buttons/IconButton.vue';

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
            perPage: 5,
            pathMdiPlusThick: mdiPlusThick,
            pathMdiCog: mdiCog,         
            pathMdiPencil: mdiPencil,
            pathMdiTrashCan: mdiTrashCan,
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
        LandAdditionalDataForm,
        YearsPaginator,
        IconButton,
        SvgIcon
    }
}
</script>
