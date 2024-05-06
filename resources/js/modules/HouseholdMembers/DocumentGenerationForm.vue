<template>

    <ModalForm formId="DocumentGenerationForm" @submitData="submitData" :sumbitIsDisabled="reportName == ''" @closeForm="closeForm">
      
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
        
        <div class="row mb-3" v-if="reportParams.length > 0">            
            <div class="col">   
                <div>
                    Заповніть параметри для звіту
                </div>             
                <div v-for="param in reportParams" :key="param.id">
                    <div class="row">
                        <label :for="param.code" class="col col-form-label">{{ param.name }}</label>
                        <div class="col">
                            <input class="form-control" :id="param.code" type="number" v-model="paramsValue[param.code]" autocomplete="false">
                        </div>
                    </div>
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
                            required: true,
                            code: "year",
                            name: 'Рік звітності',
                            type: 'number',
                            mask: /[1-9][0-9]{3}/, // ???
                            default: (new Date()).getFullYear(),
                        }
                    ]
                },
            ],
            reportParams: [],
            paramsValue: {},            
        }
    },
    methods: {
        submitData() {
            let data = {
                report: this.reportName, 
                member_id: this.records.map(r => r.id).join(','),
                ...this.paramsValue
            }            
            axios.post(
                'api/v1/generate-report', 
                data,
                { responseType: 'arraybuffer'} 
            )
            .then(res => {
                    const url = window.URL.createObjectURL(new Blob([res.data]));
                    const link = document.createElement('a');                    
                    link.href = url;                    
                    let fileName = this.getFileName();
                    link.setAttribute('download', fileName);
                    document.body.appendChild(link);
                    link.click();
            })
        },
        getFileName() {
            let document_name = this.reports.find(r => r.code == this.reportName)['name'];
            let persons = this.records.length;
            if ( persons > 1)  {
                let cnt = (persons < 5) ? cnt = 'особи' : ( (persons > 11 && persons % 10 == 1) ? 'особа' : 'осіб' );                    
                return `${document_name}(${persons} ${cnt}).zip`;
            } else {
                let member_name = this.records[0].full_name;                
                return `${member_name}.${document_name}.docx`;
            }
        },
        closeForm() {
            this.reportParams = [];
            this.paramsValue = Object.assign({});
            this.reportName  = '';
        }
    },
    
    watch: {
        'reportName'(newVal) {            
            if (newVal !== 0) {
                let report = this.reports.find(r => r.code == newVal);
                this.paramsValue = Object.assign({}); 
                if (report) {
                    this.reportParams = [...report.params];                    
                    let required = this.reportParams.filter(p => p.required);

                    if (required.length > 0) {                        
                        required.forEach(r => {
                            console.log(r.code, r.default);
                            this.paramsValue[r.code] = r.default
                        });
                    }
                } else {
                    this.reportParams = [];                    
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