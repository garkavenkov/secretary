<template>

    <ModalForm  formId="FamilyCompositionReportForm"
                @submitData="submitData"
                @closeForm="closeForm"
                modalClass="modal-lg">

        <div class="row mb-3">
            <div class="col">
                <label for="reportInitiator" class="form-label">Член родини</label>
                <select class="form-control"
                        v-model="memberId"
                        :disabled="selectedMember != 0">
                    <option disabled value="0">Оберить члена родини</option>
                    <option :value="member.id" v-for="member in members" :key="member.id">
                        {{member.surname}} {{ member.name }} {{ member.patronymic }}
                    </option>
                </select>
            </div>
        </div>
        <!-- rest members of the family -->
        <div class="row">
            <div class="relatives">
                <table class="table table-sm table-bordered table-600" v-show="relatives.length > 0">
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
                        <tr v-for="relative in relatives" :key="relative.id" :class="{'text-muted': !relative.selected}">
                            <td>
                                <input type="checkbox" v-model="relative.selected" class="form-check-input">
                            </td>
                            <td>{{ relative.relation }}</td>
                            <td>{{ relative.surname }} {{ relative.name }} {{ relative.patronymic }}</td>
                            <td>{{ formatedDate(relative.birthdate) }}</td>
                        </tr>
                    </tbody>
                </table>
                <!-- <div class="relative" v-for="relative in relatives" :key="relative.id">
                    {{relative.relation}} - {{ relative.surname }} {{ relative.name }} {{ relative.patronymic }}, {{ relative.birthdate }} р.н.
                </div> -->
            </div>
        </div>
    </ModalForm>

</template>

<script>

import ModalForm    from '../../../components/ui/ModalForm.vue';
import DateFormate  from '../../../mixins/DateFormat';

export default {
    name: 'FamilyCompositionReportForm',
    props: {
        'members': {
            type: Array,
            required: true
        },
        'selectedMember': {
            type: [String, Number],
            required: false,
            default: 0
        }
    },
    mixins: [DateFormate],
    data() {
        return {
            memberId: this.selectedMember,
            relatives: [],
            allSelected: false
        }
    },
    methods: {
        submitData() {
            let data = {
                report: 'familyComposition',
                member_id: this.memberId,
                relatives: ''
            }

            data.relatives = this.relatives.filter(r => r.selected).map(r => r.relative_id).join(',');

            axios.post('/api/v1/generate-report', data,    { responseType: 'arraybuffer'} )
                .then(res => {

                    const url = window.URL.createObjectURL(new Blob([res.data]));
                    const link = document.createElement('a');

                    link.href = url;
                    let member = this.members.find(m => m.id == this.memberId);
                    let fileName = `${member.surname} ${member.name} ${member.patronymic}. Довідка про склад родини.docx`;
                    // link.setAttribute('download', "Довідка про стан родини.docx"); // set custom file name
                    link.setAttribute('download', fileName);
                    document.body.appendChild(link);

                    link.click();
                    this.closeForm();
                })
        },
        closeForm() {
            this.memberId =  0;
            this.relatives = [];
            this.allSelected = false;
            this.$emit('closeFamilyCompositionReportForm')
        }
    },
    computed: {
        // restMembers() {
        //     return this.members.filter(m => m.id !== this.formData.member_id);
        // },
        // relatives() {
        //     let member = this.members.find(m => m.id == this.formData.member_id);
        //     if (member) {
        //         return member.relatives
        //     } else {
        //         return []
        //     }
        //     // return this.members.find(m => m.id == this.formData.member_id).relatives;
        // }
    },
    watch: {
        'memberId'(newVal) {
            if (newVal != 0) {
                let member = this.members.find(m => m.id == this.memberId);
                if (member) {
                    this.relatives = member.relatives;
                    this.relatives.forEach(r => r.selected = true)
                    this.allSelected = true;
                } else {
                    this.relatives = []
                }
            } else {
                this.relatives = [];
            }
        },
        'allSelected'(newVal) {
            if (newVal) {
                this.relatives.forEach(r => r.selected = true)
            } else if (this.relatives.length > 0) {
                this.relatives.forEach(r => r.selected = false)
            }
        }
    },
    // mounted() {
    //     this.memberId = this.selectedMember;
    // },
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
