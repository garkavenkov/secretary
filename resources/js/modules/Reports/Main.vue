<template>

    <div class="card">
        <div class="card-header">
            <h6>Менеджер звітів</h6>
            <ButtonAdd buttonClass="btn-primary p-2" @click="openReportForm" title="Додати новий звіт" />
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-secondary">
                    <tr>
                        <th class="show-record"></th>
                        <th>Назва</th>
                        <th>Описа</th>
                        <th>Файл</th>
                        <th>Модель</th>
                        <th>Іконка</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="report in reports" :key="report.id">
                        <td class="text-center">
                            <DictionaryShowRecordLink 
                                    routeName="reports.manager.show" 
                                    :routeParamId="report.id"
                                    title="Перейти до інформації по звіту" />                           
                        </td>
                        <td>{{ report.name }}</td>
                        <td>{{ report.description }}</td>
                        <td>{{ report.file_name }}</td>
                        <td>{{ report.model }}</td>
                        <td>{{ report.icon }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <ReportForm
        :formData="formData"
        :action="action"
        :models="models" />


</template>


<script>

import { Modal }                from 'bootstrap';
import { computed }             from 'vue';

import ReportForm               from './ReportForm.vue';

import DictionaryShowRecordLink from '../../components/ui/DictionaryShowRecordLink.vue';

export default {
    name: 'ReportsMain',
    data() {
        return {
            reports: [
                {
                    id              :   1,
                    icon            :  'mdi mdi-file-outline',
                    name            :  "Довідка про стан сім\'ї",
                    description     :  "Довідка про стан сім\'ї",
                    file_name       :  "family_composition.docx",
                    model           :  "App\\Models\\HouseholdMember"
                },
                {
                    id              :   2,
                    icon            :  'mdi mdi-file-outline',
                    name            :  "Земельна ділянка",
                    description     :  "Довідка про наявність земельної ділянки",
                    file_name       :  "member_land.docx",
                    model           :  "App\\Models\\HouseholdMember"
                }
            ],
            models: [
                {
                    id: 1,
                    name: 'Член домогосподарства',
                    code: 'App\\Models\\HouseholdMember',
                },
                {
                    id: 2,
                    name: 'Домогосподарство',
                    code: 'App\\Models\\Household',
                },
            ],
            formData: {
                name: '',
                description: '',
                model: '',
                icon: ''
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
        openReportForm() {
            this.modalTitle = 'Новий документ';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            let reportForm = new Modal(document.getElementById('ReportForm'));
            reportForm.show();
        }
    },
    components: {
        ReportForm,
        DictionaryShowRecordLink
    }
}
</script>
