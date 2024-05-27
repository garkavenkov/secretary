<template>
    
    <div class="card h-100">                
        <div class="card-header align-items-center">
            <div class="d-flex align-items-center">
                <div class="chart-name me-2">
                    {{ chartName }}
                </div>
                <DropDownMenu   v-if="activeChart == 'membersByAge'"
                                :showActionItems="false"
                                :showToggler="false"
                                title="Налаштування діаграми"
                                buttonClass="btn-outline-secondary btn-transparent" 
                                :buttonSvgPath="pathChartSetting">
                    <li><h6 class="dropdown-header">Групувати данні по:</h6></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>    
                    <li>
                        <div class="dropdown-item chart-setting-item">
                            <input  type="checkbox" 
                                    name="groupBySettlement" 
                                    id="groupBySettlement" 
                                    class="me-2" 
                                    v-model="membersByAgeSetting.groupBySettlement">
                            <label  for="groupBySettlement">населенном пункту</label>
                        </div>
                    </li>                    
                    <li>
                        <div class="dropdown-item chart-setting-item">
                            <input  type="checkbox" 
                                    name="groupByGender" 
                                    id="groupByGender" 
                                    class="me-2" 
                                    v-model="membersByAgeSetting.groupByGender">
                            <label  for="groupByGender">статі</label>
                        </div>
                    </li>                    
                </DropDownMenu>
                <DropDownMenu   v-if="activeChart == 'householdsByTypes'"
                                :showActionItems="false"
                                :showToggler="false"
                                title="Налаштування діаграми"
                                buttonClass="btn-outline-secondary btn-transparent" 
                                :buttonSvgPath="pathChartSetting">
                    <li><h6 class="dropdown-header">Групувати данні по:</h6></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>    
                    <li>
                        <div class="dropdown-item chart-setting-item">
                            <input  type="checkbox" 
                                    name="groupBySettlement" 
                                    id="groupBySettlement" 
                                    class="me-2" 
                                    v-model="householdsByTypesSettings.groupBySettlement">
                            <label  for="groupBySettlement">населенном пункту</label>
                        </div>
                    </li>                  
                </DropDownMenu>
            </div>

            <div>
                <DropDownMenu   :showActionItems="false" 
                                buttonClass="btn-outline-primary btn-transparent" 
                                :buttonSvgPath="pathDropDownIcon">
                    <li>
                        <a  class="dropdown-item d-flex align-items-center" 
                            :class="[chartName == 'Домогосподарства по типу' ? 'active' : '' ]"
                            @click="chartHouseholdTypes">
                            <SvgIcon type="mdi" :path="pathHouseholdTypes" :size="16" class="me-2" />
                            <span>Домогосподарства по типу</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>                   
                    <li>
                        <a  class="dropdown-item d-flex align-items-center" 
                            :class="[chartName == 'Населення в розрізі вікових груп' ? 'active' : '' ]"                            
                            @click="chartMembersAges">
                            <SvgIcon type="mdi" :path="pathMemberByAge" :size="16" class="me-2" />
                            <span>Вікові групи населення</span>
                        </a>
                    </li>                    
                </DropDownMenu>
            </div>
        </div>
        <div class="card-body">
            <Bar
                    id="my-chart-id"
                    :options="chartOptions"
                    :data="chartData" />
        </div>
    </div>

</template>

<script>

import SvgIcon from '@jamescoyle/vue-icon';
import {     
    mdiChartBoxMultipleOutline,
    mdiAccountGroupOutline,
    mdiFolderHomeOutline,
    mdiTune
} from '@mdi/js';


import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ChartDataLabels);
ChartJS.defaults.set('plugins.datalabels', {
    color: '#000',
    anchor: 'end',
    align: 'end',
    offset: 2,
    font: {
        size: 12
    }
});


import DropDownMenu             from '../../components/ui/DropDownMenu.vue';

const COLORS = [
  '#4dc9f6',
  '#f67019',
  '#f53794',
  '#537bc4',
  '#acc236',
  '#166a8f',
  '#00a950',
  '#58595b',
  '#8549ba'
];


export default {
    name: 'ChartWidget',
    components: {    
        SvgIcon,  
        DropDownMenu,
        Bar
    },
    data() {
        return {
            pathDropDownIcon: mdiChartBoxMultipleOutline,
            pathMemberByAge: mdiAccountGroupOutline,
            pathHouseholdTypes: mdiFolderHomeOutline,            
            pathChartSetting: mdiTune,
            
            activeChart: 'householdsByTypes',

            membersByAgeSetting: {                    
                groupBySettlement: true,                
                groupByGender: true,                    
            },

            householdsByTypesSettings: {                    
                groupBySettlement: true,                
            },
            
            
            result: {
                labels: [],
                datasets: []
            },

            chartOptions: {
                responsive: true,
                // scales: {
                //     x: {
                //         stacked: true,
                //     },
                //     y: {
                //         stacked: true
                //     }
                // }
                // plugins: {
                //     datalabels: {
                //         color: '#36A2EB'
                //     } 
                // }
                /*
                plugins: {
                    legend: {
                        display: true,
                        // labels: {
                        //     color: 'rgb(255, 99, 132)'
                        // },
                        position: 'right'
                    }
                }
                */
            }
        }
    },
    methods: {
        color(index) {
            return COLORS[index % COLORS.length];
        },
        chartMembersAges() {            
            this.activeChart = 'membersByAge'            
            this.result.labels = [
                    "0-17",
                    "18-59",
                    "> 60",
                ];

            let groupBy = [];

            if (this.membersByAgeSetting.groupByGender) {
                groupBy.push('gender')
            }
            if (this.membersByAgeSetting.groupBySettlement) {
                groupBy.push('settlement')
            }

            let data = {
                ranges: {
                    "0-17": [0,17],
                    "18-59":[18,59],
                    '> 60': [60,200]
                },            
                groupBy: groupBy
            }
            axios.post('api/v1/household-members-by-age-ranges', data)
                .then(res => {
                    
                    this.result.datasets = [];
                    let colorIndex = 0;
                    let label = '';

                    res.data.forEach(row => {
                        
                        // let ageRangeData = [];

                        // this.result.labels.forEach(range => {
                        //     if (row[range]) {
                        //         ageRangeData.push(row[range]);
                        //     } else {
                        //         ageRangeData.push(0);
                        //     }
                        // })
                        

                        if (this.membersByAgeSetting.groupBySettlement) {
                            label = `${row.settlement}`
                            delete row['settlement'];
                        }

                        if (this.membersByAgeSetting.groupByGender) {
                            label += (this.membersByAgeSetting.groupBySettlement ? '. ' : '') + ((row.gender == 'чоловіча') ? 'чоловіки' : 'жінки');
                            delete row['gender'];
                        }

                        if (!this.membersByAgeSetting.groupByGender && !this.membersByAgeSetting.groupBySettlement) {
                            label = 'Загальна кількість мешканців по вікових групах';
                        }

                        this.result.datasets.push({
                            label: label,
                            backgroundColor: this.color(colorIndex++),
                            data: Object.values(row),
                        });                        
                    })                  
                });          
          
        },
        chartHouseholdTypes() {
            this.activeChart = 'householdsByTypes'
            
            this.result.labels = [ 
                    ['з реєстрацією', 'місця проживання'], 
                    ['з реєстрацією', 'місця перебування'], 
                    'домоволодіння', 
                    'землеволодіння', 
                    'закинутий об\'єкт' 
                ];
            
            let groupBy = [];
                
            if (this.householdsByTypesSettings.groupBySettlement) {
                groupBy.push('settlement')
            }

            /*
            // Cannot be used because server may not be return data when chart is created,
            // so householdTypes may be an empty array.
            // Alternatevly it possible to call API request for household-types form here...??
            let type_ids = this.$store.getters['HouseholdTypes/householdTypes']; //.map(types => type.id);
            console.log(type_ids);
            */

            axios.post('/api/v1/households-by-type', {
                    groupBy: groupBy
                })
                .then(res => {
                    
                    this.result.datasets = [];
                    let colorIndex = 0;
                    let label = '';
                    
                    res.data.forEach(row => {

                            if (this.householdsByTypesSettings.groupBySettlement) {
                                label = row.settlement;
                                delete row['settlement'];
                            } else {
                                label = 'Загальна кількість домогосподарств по типу';
                            }

                            this.result.datasets.push({
                                label: label,
                                backgroundColor: this.color(colorIndex++),
                                data: Object.values(row)
                            });                            
                    })
                   
                });
                
        }
    },
    computed: {
        chartData() {
            return {
                labels: this.result.labels,
                datasets: this.result.datasets
            }
        },
        chartName() {
            if (this.activeChart == 'membersByAge') {
                return 'Населення в розрізі вікових груп';
            } else if (this.activeChart == 'householdsByTypes') {
                return 'Домогосподарства по типу';
            }            
        }
    },
    watch: {
        'membersByAgeSetting.groupByGender'() {
            this.chartMembersAges();
        },
        'membersByAgeSetting.groupBySettlement'() {
            this.chartMembersAges();
        },
        'householdsByTypesSettings.groupBySettlement'() {
            this.chartHouseholdTypes();
        },
    },
    created() {
        this.chartHouseholdTypes();
    }
}

</script>

<style lang="scss" scoped>

.chart-name {
    font-size: 1.1rem;
}

.chart-setting-item {
    min-height: 1.5rem;
    display: flex;
    align-items: center;

}

</style>