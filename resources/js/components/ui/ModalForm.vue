<template>

    <div class="modal fade" :id="formId" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" :class="modalClass">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel" v-html="modalTitle"></h1>
                        <slot name="modalHeader"></slot>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="$emit('closeForm')"></button>
                </div>
                <div class="modal-body">
                   <slot></slot>
                </div>
                <div class="modal-footer" v-if="showFooter">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="$emit('closeForm')">Відмінити</button>
                    <button type="button" class="btn btn-primary" @click="$emit('submitData')">{{modalSubmitCaption}}</button>
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
        'showFooter': {
            type: Boolean,
            required: false,
            default: () => true
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
}
</script>
