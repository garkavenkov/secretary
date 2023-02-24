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
                <th v-for="year in years.sort((a, b) => a.year - b.year)"
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

    <LandYearForm
            :formData="yearData"
            :title="title"
            :submitCaption="submitCaption"
            :action="yearDataAction"
            @closeYearForm="closeYearForm"
            @refreshData="$emit('refreshData')"/>


</template>

<script>

import { Modal }        from 'bootstrap';

import TableRow     from '../../../../components/ui/TableRow.vue';
import LandYearForm from './LandYearForm.vue';


export default {
    name: 'MemberLandYearsTab',
    props: {
        'years': {
            type: Array,
            required: true
        },
        'member': {
            type: Object,
            required: true
        }
    },
    components: {
        TableRow,
        LandYearForm
    },
    emits:['refreshData'],
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
            yearDataAction: '',
            title: '',
            submitCaption: '',
            apiUrl: '/api/v1/household-member-lands'
        }
    },
    methods: {
        newYearData(e) {
            this.title = 'Додати дані';
            this.submitCaption = 'Додати';
            this.yearDataAction = 'create';

            this.yearData.member_id = this.member.id;

            if (e.ctrlKey) {
                if (this.years.length > 0) {
                    this.yearData = Object.assign({}, this.years[this.years.length-1]);
                    this.yearData.year = parseInt(this.yearData.year) + 1;
                }
                this.modalTitle = `Додати дані на <b>${this.yearData.year}</b> рік`;
            }

            let landYearForm = new Modal(document.getElementById('LandYearForm'))
            landYearForm.show();
        },
        editYear(year) {
            Object.assign(this.yearData, year);
            this.yearData.member_id = this.member.id;

            this.title = `Редагувати дані за ${year.year} рік`;
            this.submitCaption = 'Зберегти';
            this.yearDataAction = 'update';

            var landYearForm = new Modal(document.getElementById('LandYearForm'))
            landYearForm.show()
        },
        deleteYear(year) {
            this.$confirmDelete(`Ви дійсно бажаєти видалити дані за ${year.year} рік`)
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`${this.apiUrl}/${year.id}`)
                            .then(res => {
                                // this.$store.dispatch('Households/fetchRecord', this.household_id);
                                this.$emit('refreshData')
                                this.$toast(res.data.message);
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити дані', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        },
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
                member_id: this.member.id
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
        // refreshData() {
        //     this.$emit('refreshData');
        // }
    }
}

</script>
