<template>

    <ModalForm  formId="FamilyCompositionReportForm"
                @submitData="submitData"
                @closeForm="closeForm"
                modalClass="modal-lg">

        <!-- <div class="row mb-3">
            <div class="col">
                <label for="reportInitiator" class="form-label">Член родини</label>
                <label for="reportInitiator" class="form-label">{{info.fullName}}</label>
            </div>
        </div> -->
        <!-- rest members of the family -->
        <div class="row">
            <div class="relatives" v-if="info.relatives && info.relatives.length > 0">
                <h6>Перелік родичів</h6>
                <table class="table table-sm table-bordered table-600">
                    <thead class="table-secondary">
                        <tr>
                            <th>
                                <input type="checkbox" title="Обрати усіх" v-model="allSelected" class="form-check-input">
                            </th>
                            <th>Відносини</th>
                            <th>Прізвище І.Б.</th>
                            <th>Рік народження</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="relative in info.relatives" :key="relative.id" :class="{'text-muted': !relative.selected}">
                            <td>
                                <input type="checkbox" v-model="relative.selected" class="form-check-input">
                            </td>
                            <td>{{ relative.relation }}</td>
                            <td>{{ relative.surname }} {{ relative.name }} {{ relative.patronymic }}</td>
                            <td>{{ relative.formatted_birthdate }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <div class="text-center text-muted p-5">
                    Родичі відсутні, або не встановленні родинні зв'язки
                </div>
            </div>
        </div>
    </ModalForm>

</template>

<script>

import ModalForm                from '../../../components/ui/ModalForm.vue';
import PrepareDataForDownload   from '../../../mixins/PrepareDataForDownload';

export default {
    name: 'FamilyCompositionReportForm',
    props: {
        'selectedMember': {
            type: [String, Number],
            required: false,
            default: 0
        }
    },
    mixins: [PrepareDataForDownload],
    data() {
        return {
            memberId: this.selectedMember,
            info: {},
            allSelected: false
        }
    },
    methods: {
        fetchRelatives() {
            axios.get(`/api/v1/household-members/${this.memberId}/relatives`)
                .then(res => {
                    this.info = res.data.data
                });
        },
        submitData() {
            let data = {
                report: 'familyComposition',
                member_id: this.memberId,
                relatives: ''
            }

            data.relatives = this.info.relatives.filter(r => r.selected).map(r => r.id).join(',');

            axios.post('/api/v1/generate-report', data,    { responseType: 'arraybuffer'} )
                .then(res => {
                    
                    // const url = window.URL.createObjectURL(new Blob([res.data]));
                    // const link = document.createElement('a');

                    // link.href = url;
                    let fileName = `${this.info.surname} ${this.info.name} ${this.info.patronymic}. Довідка про склад родини.docx`;
                    // link.setAttribute('download', fileName);
                    // document.body.appendChild(link);

                    // link.click();
                    this.prepareDataForDownload(res, fileName);
                    
                    this.closeForm();
                })
        },
        closeForm() {
            this.memberId =  0;
            this.allSelected = false;
            this.$emit('closeFamilyCompositionReportForm')
        }
    },
    watch: {
        'allSelected'(newVal) {
            if (newVal) {
                this.info.relatives.forEach(r => r.selected = true)
            } else if (this.info.relatives.length > 0) {
                this.info.relatives.forEach(r => r.selected = false)
            }
        }
    },
    created() {
        this.fetchRelatives();
    },
    beforeUpdate() {
        this.memberId = this.selectedMember;
    },
    components: {
        ModalForm
    }
}
</script>

<style lang="scss" scoped>

table {
    tr {
        td:first-child,
        td:last-child,
        th:first-child,
        th:last-child
        {
            text-align: center;
        }
    }
}

</style>
