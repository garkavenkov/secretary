import { computed } from 'vue';
import { Modal } from 'bootstrap'

export default {
    data() {
        return {           
            action: '',
            modalTitle: '',
            modalSubmitCaption: '',
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        openFormForAdd() {
            let myModal = new Modal(document.getElementById(this.formId));

            this.modalTitle = this.modalTitleCreate;
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            myModal.show();
        },
        openFormForEdit(record) {
            let myModal = new Modal(document.getElementById(this.formId));

            this.modalTitle = this.modalTitleUpdate;
            this.modalSubmitCaption = 'Зберегти';
            
            Object.assign(this.formData, record);
            
            this.action = 'update';

            myModal.show();
        }
    },
}
