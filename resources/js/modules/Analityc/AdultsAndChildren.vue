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
                        <thead class="align-middle">
                            <tr>
                                <th rowspan="3">Назва населеного пункту</th>
                                <th rowspan="3" class="vertical-text">Кількість дворів</th>
                                <th rowspan="3" class="vertical-text">Кількість жилих дворів</th>
                                <th rowspan="3" class="vertical-text">Кількість фактично <br>проживаючого населення</th>
                                <th rowspan="3" class="vertical-text">Кількість зареєстрованого <br>населення</th>
                                <th colspan="6" class="text-center">Дорослі, у тому числі:</th>
                                <th colspan="8" class="text-center">Діти, у тому числі:</th>
                                <th rowspan="3" class="vertical-text">Люди, які обслуговуються службами<br>соціальної допомоги на дому</th>
                                <th rowspan="3" class="vertical-text">Одинокі матері (батькі)</th>
                                <th rowspan="3" class="vertical-text">Одинокі багатодітні матері (батькі)</th>
                                <th rowspan="3" class="vertical-text">Багатодітні сім'ї</th>
                                <th rowspan="3" class="vertical-text">Неповні сім'ї</th>
                            </tr>
                            <tr>
                                <th rowspan="2" class="vertical-text">Всього</th>
                                <th rowspan="2" class="vertical-text">Працездатного віку</th>
                                <th rowspan="2" class="vertical-text">Пенсіонери</th>
                                <th colspan="3" class="text-center">з них:</th>
                                <th rowspan="2" class="vertical-text">Всього</th>
                                <th rowspan="2" class="vertical-text">від 0 до 6 років</th>
                                <th rowspan="2" class="vertical-text">від 6 до 14 років</th>
                                <th rowspan="2" class="vertical-text">від 14 до 18 років</th>
                                <th colspan="4" class="text-center">з них:</th>
                            </tr>
                            <tr>
                                <th class="vertical-text">Інваліди ВВВ</th>
                                <th class="vertical-text">Учасники бойових дій</th>
                                <th class="vertical-text">Інваліди всіх груп</th>
                                <th class="vertical-text">Діти з неповних сімей</th>
                                <th class="vertical-text">Діти з багатодітних сімей</th>
                                <th class="vertical-text">Діти інваліди</th>
                                <th class="vertical-text">Діти сіроти</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">2</td>
                                <td class="text-center">3</td>
                                <td class="text-center">4</td>
                                <td class="text-center">5=6+12</td>
                                <td class="text-center">6=7+8</td>
                                <td class="text-center">7</td>
                                <td class="text-center">8</td>
                                <td class="text-center">9</td>
                                <td class="text-center">10</td>
                                <td class="text-center">11</td>
                                <td class="text-center">12=13+14+15</td>
                                <td class="text-center">13</td>
                                <td class="text-center">14</td>
                                <td class="text-center">15</td>
                                <td class="text-center">16</td>
                                <td class="text-center">17</td>
                                <td class="text-center">18</td>
                                <td class="text-center">19</td>
                                <td class="text-center">20</td>
                                <td class="text-center">21</td>
                                <td class="text-center">22</td>
                                <td class="text-center">23</td>
                                <td class="text-center">24</td>
                            </tr>
                            <tr v-for="(item,index) in report" :key="index">
                                <td>{{ item.settlement }}</td>
                                <td class="text-center">{{ item.households_total }}</td>
                                <td class="text-center">{{ item.households_living }}</td>
                                <td class="text-center">{{ item.adults.total + item.children.total }}</td>
                                <td class="text-center">{{ item.adults.total + item.children.total }}</td>
                                <td class="text-center">{{ item.adults.total }}</td>
                                <td class="text-center">{{ item.adults['18-60'] }}</td>
                                <td class="text-center">{{ item.adults['>60'] }}</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">{{ item.children.total }}</td>
                                <td class="text-center">{{ item.children['0-5'] }}</td>
                                <td class="text-center">{{ item.children['6-13'] }}</td>
                                <td class="text-center">{{ item.children['14-17'] }}</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
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
    name: 'AdultsAndChildrenReport',
    mixins: [DateFormat],
    data() {
        return {
            formData: {
                report: 'adultsAndChildren',
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
                        table thead tr:nth-of-type(2) {
                            font-size: 0.75rem;
                        }
                        table tbody tr:first-of-type {
                            font-size: 6px;
                        }
                        .vertical-text {
                            writing-mode: vertical-rl;
                            font-size: 0.75rem;
                            transform: rotate(180deg);
                            text-align: center;
                            padding: 0.3rem;
                            width: 2.5%;
                        }

                    }
                    @media screen {
                        body {
                            padding:2rem;
                        }
                        table thead tr:last-of-type {
                            font-size: 0.8rem;
                        }
                        table tbody tr:first-of-type {
                            font-size: 6px;
                        }
                        .vertical-text {
                            writing-mode: vertical-rl;
                            font-size: 0.8rem;
                            transform: rotate(180deg);
                            text-align: center;
                            padding: 0.5rem;
                        }
                    }

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

            var WinPrint = window.open('', '', 'left=0,top=0,height=500,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write('<html><head>');
            WinPrint.document.write('<meta name="viewport" content="width=device-width, initial-scale=1">');
            WinPrint.document.write('<link rel="stylesheet" href="css/app.css" media="all">');
            WinPrint.document.write(style);
            WinPrint.document.write('</head><body>');
            WinPrint.document.write('<div style="text-align:center; margin-bottom: 1rem;"><h4>');
            WinPrint.document.write(`Станом на ${reportDate}`);
            WinPrint.document.write('</h4></div>');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.write(footer);

            WinPrint.document.write('</body></html>');

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
table thead tr:nth-of-type(2) {
    font-size: 0.8rem;
}
table tbody tr:first-of-type {
    font-size: 6px;
}
.vertical-text {
    writing-mode: vertical-rl;
    font-size: 0.8rem;
    transform: rotate(180deg);
    text-align: center;
    padding: 0.4rem;
}
</style>
