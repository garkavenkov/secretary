<template>

    <div class="modal fade" :id="formId" tabindex="-1"  data-bs-backdrop="static"  data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" :class="modalClass">
            <div class="modal-content" :class="modalContentClass">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h1 class="modal-title fs-5" v-html="modalFormTitle"></h1>
                        <slot name="modalHeader"></slot>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="$emit('closeForm')"></button>
                </div>
                <div class="modal-body">
                   <slot></slot>
                </div>
                <div class="modal-footer justify-content-between" v-if="showFooter">
                    <div>
                        <slot name="footer"></slot>
                    </div>
                    <div>
                        <button type="button" 
                                class="btn btn-secondary" 
                                data-bs-dismiss="modal" 
                                @click="$emit('closeForm')">
                            Відмінити
                        </button>
                        <button type="button" 
                                class="ms-4 btn" 
                                :class="[ sumbitIsDisabled ? 'btn-outline-primary' : 'btn-primary' ]"
                                @click="$emit('submitData')" 
                                :disabled="sumbitIsDisabled">
                            {{modalFormSubmitCaption}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'ModalForm',
    props: {
        'formId': {
            type: String,
            required: true
        },
        'modalClass': {
            type: String,
            required: false,
            default: ''
        },
        'modalContentClass': {
            type: String,
            required: false,
            default: ''
        },
        'showFooter': {
            type: Boolean,
            required: false,
            default: () => true
        },
        'sumbitIsDisabled': {
            type: Boolean,
            required: false,
            default: () => false
        },
        'title': {
            type: String,
            required: false,
            default: ''
        },
        'submitCaption': {
            type: String,
            required: false,
            default: ''
        }
    },
    inject: {
        modalTitle: {
            from: 'modalTitle',
            default: 'Новий запис'
        },
        modalSubmitCaption : {
            from: 'modalSubmitCaption',
            default: 'Додати'
        }
    },
    data() {
        return {}
    },
    computed: {
        modalFormTitle() {
            return this.title ? this.title : this.modalTitle;
        },
        modalFormSubmitCaption() {
            return this.submitCaption ? this.submitCaption : this.modalSubmitCaption;
        }
    }
}
</script>
