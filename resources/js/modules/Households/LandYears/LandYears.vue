<template>
    <div class="pt-4">
        <table class="table table-bordered1 table-sm">
            <thead>
                <tr>
                    <th>
                        <button type="button" class="btn btn-sm btn-primary" @click="newYearData">
                            Додати рік
                        </button>
                    </th>
                    <th v-for="year in years"
                        :key="year.year"
                        class="text-center">
                            {{year.year}}
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
            <tfoot v-if="years.length > 0">
                <tr>
                    <td></td>
                    <td v-for="year in years" :key="(year.year+'-'+'buttons')" class="border-start border-end">
                        <div  class="d-flex justify-content-around ">
                            <button class="btn btn-sm btn-outline-danger" @click="deleteYear(year)" title="Видалити дані">
                                <span class="mdi mdi-trash-can"></span>
                            </button>
                            <button class="btn btn-sm btn-outline-warning" @click="editYear(year)" title="Змінити дані">
                                <span class="mdi mdi-pencil"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <LandYearForm :formData="formData" :action="action" @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

</template>

<script>

import { computed }         from 'vue';
import { mapGetters }       from 'vuex';

import TableRow             from '../../../components/ui/TableRow.vue';
import LandYearForm         from './LandYearForm.vue';

import NumberFormat         from '../../../minixs/NumberFormat';
import HouseholdYearsCUD    from '../../../minixs/HouseholdYearsCUD';

export default {
    name: 'HouseholdLandYears',
    mixins: [NumberFormat, HouseholdYearsCUD],
    data() {
        return {
            formData: {
                household_id: null,
                year:new Date().getFullYear(),
                maintenance: 0,
                personal_agriculture: 0,
                commercial_agriculture: 0
            },
            modalTitle: '',
            modalSubmitCaption: '',
            action: '',
            yearFormId: 'LandYearForm',
            apiUrl: '/api/v1/household-lands'
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
    },
    computed: {
        ...mapGetters('Households', {'years':'landYears', 'household_id': 'household_id'})
    },
    components: {
        TableRow,
        LandYearForm
    }
}
</script>
