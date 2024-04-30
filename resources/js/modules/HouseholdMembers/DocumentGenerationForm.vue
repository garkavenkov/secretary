<template>

    <ModalForm formId="DocumentGenerationForm" @submitData="submitData" :sumbitIsDisabled="reportName == ''">
        <!-- <div class="d-flex gap-3">
            <div class="report" @click="generateReport('members_list_1')">
                <span>
                    Звіт про склад земельної ділянки
                </span>
            </div>
            <div class="report" @click="generateReport('familyComposition')">
                <span>
                    Довідка про стан родини
                </span>
            </div>
        </div> -->
        <div class="row mb-3">
            <div class="col">
                <label for="reportName" class="form-label">Назва документу</label>
                <select class="form-control"
                        id="reportName"
                        v-model="reportName">
                    <option value="" disabled>Оберіть документ</option>

                    <option v-for="report in reports" 
                            :key="report.id"
                            :value="report.code">
                        {{report.name}}
                    </option>                    
                </select>                
            </div>      
        </div>
        <!-- {{ params }} -->
        <div class="row mb-3" v-if="params.length > 0">            
            <div class="col">   
                <div>
                    Заповніть параметри для звіту
                </div>             
                <div v-for="param in params" :key="param.id">
                    {{ param.name }}
                </div>
            </div>    
        </div>
    </ModalForm>

</template>

<script>

import ModalForm    from '../../components/ui/ModalForm.vue';

export default {
    name: 'DocumentGenerationForm',
    props: {
        records: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            reportName: '',
            // available reports for HouseholdMembers get from api/available-reports?model=HouseholdMember&multiselect=true
            reports: [
                {
                    id: 1,
                    code: "familyComposition",
                    name: "Довідка про стан родини",
                    params: []
                },
                {
                    id: 2,
                    code: "landOwned",
                    name: "Звіт про склад земельної ділянки",
                    params: [
                        {
                            id: 1,
                            code: "landYear",
                            name: 'Рік',
                            type: 'number',
                            mask: /[1-9][0-9]{3}/,
                            default: 2023
                        }
                    ]
                },
            ],
            params: []
        }
    },
    methods: {
        submitData() {
            axios.post(
                'api/v1/generate-report', 
                {
                    report: this.reportName, 
                    member_id: this.records.map(r => r.id).join(',')
                },
                { responseType: 'arraybuffer'} 
            )
            .then(res => {
                    const url = window.URL.createObjectURL(new Blob([res.data]));
                    const link = document.createElement('a');

                    link.href = url;
                    let fileName = `familyCompositions.zip`;
                    link.setAttribute('download', fileName);
                    document.body.appendChild(link);

                    link.click();
            })
        },        
    },
    watch: {
        'reportName'(newVal) {
            console.log(newVal)
            if (newVal !== 0) {
                let report = this.reports.find(r => r.code == newVal);
                if (report) {
                    this.params = [...report.params];
                }
            }
        }
    },
    components: {
        ModalForm
    }
}

</script>

<style lang="scss" scoped>

.report {
    max-width: 20ch;    
    min-width: 20ch;    
    border: 1px solid #d7d7d7;
    border-radius: 0.2rem;
    padding: 0.5rem;
    box-shadow: 0px 1px 0px 2px #eee;

    span {
        display: inline-block;
        text-wrap: balance;
        text-align: center;
    }
}

</style>