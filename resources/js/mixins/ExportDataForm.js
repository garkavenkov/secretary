import { Modal }  from 'bootstrap';

export default {
    methods: {
        openExportRecordForm() {
            this.modalTitle = 'Експорт даних';
            this.modalSubmitCaption = 'Експорт';
            let exportRecordForm = new Modal(document.getElementById('ExportRecordForm'));
            exportRecordForm.show();
        }
    }
}