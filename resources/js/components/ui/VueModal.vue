<template>

    <div class="vue-modal-overlay" @click.self="close">
        <div class="vue-modal" style="width:1000px;">
            <div class="vue-modal-header">
                <span class="title">{{title}}</span>
                <button class="close" @click="close"></button>
            </div>
            <div class="vue-modal-content">
                <slot></slot>
            </div>
            <div class="vue-modal-footer" v-if="showFooter">
                <div>
                    <slot name="footer"></slot>
                </div>
                <div>
                    <button class="btn-close-modal" @click="close"></button>
                </div>
            </div>
        </div>
    </div>



</template>


<script>

export default {
    name: 'VueModal',

    props: {
        'title': {
            type: String,
            required: false,
            default: 'Title'
        },
        'showFooter': {
            type: Boolean,
            required: false,
            default: true
        },
        'isVisible': {
            type: Boolean,
            required: false,
            default: true
        }
    },
    data() {
        return {}
    },
    emits: ['close'],
    methods: {
        close() {
            this.$emit('close');
        }
    }
}

</script>

<style lang="scss" scoped>

.vue-modal-overlay {
    position: fixed;
    z-index: 1030;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    display: flex;
    justify-content: center;
    // background-color: #000000da;

    background: rgba(0,0,0,.5);
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
    transition: opacity 0.2s linear;

    // &:not(.show) {
    //     opacity: 0;
    // }
    // &.show {
    //     opacity: 1;
    // }

    .vue-modal {
        width: 600px;
        position: fixed;
        top: 60px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        flex-direction: column;
        background: #f8fafc;
        z-index: 1031;
        border: 1px solid rgba(0,0,0,.175);
        border-radius: 0.5rem;
        outline: 0;
        background-clip: border-box;
        pointer-events: auto;
        box-shadow: 2px 3px 10px rgba(0,0,0,.2);

        &-header {
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #e7e7e7;
            align-items: center;
            line-height: 1.6;

            .title {
                font-size: 1.1rem;
            }

            .close {
                background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 0 1 1.414 0L8 6.586 14.293.293a1 1 0 1 1 1.414 1.414L9.414 8l6.293 6.293a1 1 0 0 1-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 0 1-1.414-1.414L6.586 8 .293 1.707a1 1 0 0 1 0-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
                color: #000;
                opacity: 0.5;
                box-sizing: content-box;
                width: 1em;
                height: 1em;
                padding: 0.25em 0.25em;
                border: 0;
                border-radius: 0.175rem;

                &:hover {
                    opacity: 0.75;
                }

                &:focus {
                    opacity: 1;
                    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
                }
                // --bs-btn-close-disabled-opacity: 0.25;
                // --bs-btn-close-white-filter: invert(1) grayscale(100%) brightness(200%);
            }

        }

        &-content {
            padding: 1rem;
        }

        &-footer {
            border-top: 1px solid #e7e7e7;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
        }
    }
}


</style>
