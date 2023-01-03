<template>

    <div class="modal fade" :id="formId" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel" v-html="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="$emit('closeForm')"></button>
                </div>
                <div class="modal-body">
                   <slot></slot>
                </div>
                <div class="modal-footer">
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
