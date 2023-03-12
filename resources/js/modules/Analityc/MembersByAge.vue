<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-3" v-show="!reportIsExpanded">
            <div class="card">
                <div class="card-header">
                    <h5>Параметри звіту</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="settlement" class="form-label">Населений пункт</label>
                        <select class='form-control'
                                id="settlement"
                                v-model="formData.settlementId">
                            <option value="0">Усі населені пункти</option>
                            <option :value="settlement.id" v-for="settlement in settlements" :key="settlement.id">
                                {{settlement.name}}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sex" class="form-label">Стать</label>
                        <select class='form-control'
                                id="sex"
                                v-model="formData.sex">
                            <option value="0">Чоловіки та жінки</option>
                            <option value="чоловіча">Чоловікі</option>
                            <option value="жіноча">Жінки</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label  for="reportDate" class="form-label">Сформувати звіт на дату</label>
                        <input  type="date"
                                class="form-control"
                                id="reportDate"
                                v-model="formData.date" />
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-outline-primary" @click="generateReport" :disabled="formData.date == ''">
                            Сформувати звіт
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div :class="[reportIsExpanded ? 'col-md-12' : 'col-md-9']">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <button class="btn btn-sm btn-outline-secondary me-3" :title="reportIsExpanded ? 'Сгорнути' : 'Розгорнути'" @click="reportIsExpanded = !reportIsExpanded">
                            <span :class="['mdi', reportIsExpanded ? 'mdi-arrow-expand-right' : 'mdi-arrow-expand-left']"></span>
                        </button>
                        <h5>Вікові групи населення <span v-if="(formData != '') && (report.length > 0)">станом на {{ formatedDate(formData.date) }}</span></h5>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-primary" @click="printReport" title="Роздрукувати звіт" :disabled="report.length == 0">
                            <span class="mdi mdi-printer"></span>
                        </button>
                    </div>
                </div>
                <div class="card-body" id="report">
                    <table class="table table-bordered ">
                        <thead class="table-secondary align-middle">
                            <tr>
                                <th rowspan="2">Назва населеного пункту</th>
                                <th rowspan="2">Кількість зареєстрованого населення</th>
                                <th colspan="8" class="text-center">Чоловіки</th>
                                <th colspan="8" class="text-center">Жінки</th>
                            </tr>
                            <tr>
                                <th class="text-center">до 18 років</th>
                                <th class="text-center">18 - 35 років</th>
                                <th class="text-center">36 - 59 років</th>
                                <th class="text-center">60 - 69 років</th>
                                <th class="text-center">70 - 79 років</th>
                                <th class="text-center">80 - 89 років</th>
                                <th class="text-center">90 + років</th>
                                <th class="text-center">усього</th>
                                <th class="text-center">до 18 років</th>
                                <th class="text-center">18 - 35 років</th>
                                <th class="text-center">36 - 59 років</th>
                                <th class="text-center">60 - 69 років</th>
                                <th class="text-center">70 - 79 років</th>
                                <th class="text-center">80 - 89 років</th>
                                <th class="text-center">90 + років</th>
                                <th class="text-center">усього</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in report" :key="index">
                                <td>{{ item.settlement }}</td>
                                <td class="text-center">{{ item.total }}</td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['0 - 17'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['18 - 35'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['36 - 59'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['60 - 69'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['70 - 79'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['80 - 89'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['> 90'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['чоловіча']">
                                        {{ item.data['чоловіча']['total'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['0 - 17'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['18 - 35'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['36 - 59'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['60 - 69'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['70 - 79'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['80 - 89'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['> 90'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                                <td class="text-center">
                                    <template v-if="item.data['жіноча']">
                                        {{ item.data['жіноча']['total'] }}
                                    </template>
                                    <template v-else>
                                        0
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters }   from 'vuex';
import DateFormat       from '../../mixins/DateFormat';

export default {
    name: 'Reports',
    mixins: [DateFormat],
    data() {
        return {
            formData: {
                report: 'membersByAge',
                sex: 0,
                settlementId: 0,
                date: new Date().toISOString().slice(0, 10)
            },
            reportIsExpanded: false,
            report: []
        }
    },
    methods: {
        generateReport() {
            axios.post('/api/v1/generate-report', this.formData)
                .then(res => {
                    this.report = res.data;
                })
        },
        printReport() {
            let reportDate = this.formatedDate(this.formData.date);
            let style = `
            <style>
                    @media print {
                        body {
                            padding-top: 3rem;
                            background: white;
                        }
                        table {
                            font-size: 0.8rem;
                            margin: 10mm 0;
                        }
                        table thead tr:last-of-type {
                            font-size: 0.6rem;
                        }

                    }
                    @media screen {
                        body {
                            padding:2rem;
                        }
                        table thead tr:last-of-type {
                            font-size: 0.8rem;
                        }
                    }

                    // .table {
                    //     width: 100%;
                    //     margin-bottom: 1rem;
                    //     color: #212529;
                    //     vertical-align: top;
                    //     border-collapse: collapse;
                    //     border-style: solid;
                    //     border-color: #cbccce;
                    //     border-width: 1px;
                    // }
                    // table thead {
                    //     vertical-align: middle;
                    //     color: black;
                    //     border-color: #cbccce;
                    //     border-style: solid;
                    //     border-width: 1px;
                    //     background-color: #e2e3e5;
                    // }

                    // table tr {
                    //     border-width: 1px 0;
                    //     border-style: solid;
                    //     border-color: #cbccce;
                    // }
                    // table tbody tr td:not(:first-of-type) {
                    //     text-align: center;
                    // }
                    // table th, table td {
                    //     border-width: 0 1px;
                    //     padding: 0.5rem;
                    //     border-style: solid;
                    //     border-color: #cbccce;
                    // }
                    .footer {
                        display:flex;
                        justify-content: space-evenly;
                        margin-top: 2rem;
                    }
                    .footer-col {
                        font-size: 0.8rem;
                        width: 2in;
                        text-align: center;
                        margin-top: 2rem;
                        border-top: 1px solid;
                    }
                    .footer-col span {
                        color:grey;
                    }
            </style>`
            let footer = `<div class="footer">
                    <div style="font-size:1rem;">Староста</div>
                    <div class="footer-col">
                        <span>підпис</span>
                    </div>
                    <div class="footer-col">
                        <span>Ініциали Прізвище</span>
                    </div>
                </div>`

            var prtContent = document.getElementById("report");

            // var WinPrint = window.open('', '', 'left=0,top=0,height=500,toolbar=0,scrollbars=0,status=0');
            var WinPrint = window.open('', '', 'left=50000,top=50000,width=0,height=0,toolbar=0,scrollbars=0,status=0');

            WinPrint.document.write('<html><head>');
            WinPrint.document.write('<meta name="viewport" content="width=device-width, initial-scale=1">');
            WinPrint.document.write('<link rel="stylesheet" href="css/app.css" media="all">');
            WinPrint.document.write(style);
            WinPrint.document.write('</head><body>');
            WinPrint.document.write('<div style="text-align:center; margin-bottom: 1rem;"><h4>');
            WinPrint.document.write(`Станом на ${reportDate}`);
            WinPrint.document.write('</h4></div>');
            // console.log(prtContent.innerHTML);
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.write(footer);

            WinPrint.document.write('</body></html>');
            // WinPrint.document.close();

            // WinPrint.addEventListener("load", (event) => {
            //     WinPrint.document.close();
            //     WinPrint.focus();
            //     WinPrint.print();
            //     WinPrint.close();
            //     console.log("page is fully loaded");
            // });
            // WinPrint.focus();

            setTimeout(function () {
                WinPrint.document.close();
                WinPrint.focus();
                WinPrint.print();
                WinPrint.close();
            }, 300);
        }
    },
    computed: {
        ...mapGetters('Settlements', ['settlements'])
    }
}
</script>

<style lang="scss" scoped>
table thead tr:last-of-type {
    font-size: 0.8rem;
}
</style>
