<script>
import { Modal } from 'bootstrap';
import { computed } from 'vue';

import TableRow from '../../../components/ui/TableRow.vue';
import LandForm from './LandForm.vue';

import NumberFormat from '../../../minixs/NumberFormat';

export default {
    name: 'LandInfo',
    props: {
        'years': {
            type: Array,
            required: true
        },
        'household_id': {
            type: [String, Number],
            required: true
        }
    },
    mixins: [NumberFormat],
    data() {
        return {
            formData: {
                household_id: this.household_id,
                year:new Date().getFullYear(),
                maintenance: 0,
                personal_agriculture: 0,
                commercial_agriculture: 0
            },
            modalTitle: '',
            modalSubmitCaption: '',
            action: ''

        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        newYearData(e) {
            this.modalTitle = 'Додати дані на новий рік';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';
            if (e.ctrlKey) {
                if (this.years.length > 0) {
                    this.formData = Object.assign({}, this.years[this.years.length-1]);
                    this.formData.year = parseInt(this.formData.year) + 1;
                    this.modalTitle = `Додати дані на <b>${this.formData.year}</b> рік`;
                }
            }
            let modalForm = new Modal(document.getElementById('LandForm'))
            modalForm.show();
        },
        deleteYear(id) {
            axios.delete(`/api/v1/household-lands/${id}`)
                .then(res => {
                    this.$store.dispatch('Households/fetchRecord', this.household_id);
                })
        },
        editYear(id) {
            let _year = this.years.find(y => y.id == id)
            Object.assign(this.formData, _year);
            this.modalSubmitCaption = 'Зберегти';
            this.modalTitle = `Редагувати дані за ${_year.year} рік`;
            this.action = 'update';

            let modalForm = new Modal(document.getElementById('LandForm'))
            modalForm.show();
        }
    },
    components: {
        TableRow,
        LandForm
    }
}
</script>

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
                    <th v-for="year in years" :key="year.year" class="text-center">
                        <!-- <button class="btn btn-sm btn-outline-danger" @click="deleteYear(year.id)" title="Видалити дані">
                                <span class="mdi mdi-trash-can"></span>
                            </button> -->
                            <!-- <span> -->
                                {{year.year}}
                            <!-- </span>
                            <button class="btn btn-sm btn-outline-warning" @click="editYear(year.id)" title="Змінити дані">
                                <span class="mdi mdi-pencil"></span>
                            </button> -->
                    </th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <TableRow :years="years" field="total" rowTitle="<b>Площа земельних ділянок - усього</b>" />
                <!-- <TableRow :years="years" field="purpose" rowTitle="з неї за цільовим призначенням <i>(відповідно до документів)</i>" /> -->
                <tr>
                    <td :colspan="(years.length+1)">з неї за цільовим призначенням <i>(відповідно до документів):</i></td>
                </tr>
                <TableRow :years="years" field="maintenance" rowTitle="для будівництва і обслуговування житлового будинку" rowTitleClass="ps-3"/>
                <TableRow :years="years" field="personal_agriculture" rowTitle="для ведення особистого селянського господарства" rowTitleClass="ps-3"/>
                <TableRow :years="years" field="commercial_agriculture" rowTitle="для ведення товарного сільськогосподарського виробництва" rowTitleClass="ps-3"/>
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
                            <button class="btn btn-sm btn-outline-danger" @click="deleteYear(year.id)" title="Видалити дані">
                                <span class="mdi mdi-trash-can"></span>
                            </button>
                            <button class="btn btn-sm btn-outline-warning" @click="editYear(year.id)" title="Змінити дані">
                                <span class="mdi mdi-pencil"></span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <LandForm :formData="formData" :action="action" @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />

</template>
