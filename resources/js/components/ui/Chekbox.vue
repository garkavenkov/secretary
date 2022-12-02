<template>
    <div    class="toggler-wrapper"
            :class="{ 'isChecked': modelValue }"
            :style="cssStyles"
            @click="$emit('update:modelValue', !this.modelValue)"
            :title="title">
        <div
            class="toggler"
            :class="{ 'isChecked': modelValue }">
        </div>
    </div>
</template>

<script>
export default {
    name: 'Checkbox',
    props: {
        id: {
            type: String,
            required: true
        },
        // caption: {
        //     type: String,
        //     required: false,
        //     default: () => ''
        // },
        title: {
            type: String,
            required: false,
            default: ''
        },
        image: {
            type: String,
        },
        modelValue: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {

        }
    },
    computed: {
        cssStyles() {
            return {
                '--image-url': 'url('+this.image+')'
            }
        }
    }
}
</script>

<style lang="scss" scoped>

label {
    display: flex;
    align-items: center;
}

/* input[type="checkbox"] */
div.toggler-wrapper
{
    position: relative;
    width: 84px;
    height: 42px;
    -webkit-appearance: none;
    background-color:#f8f9fa;
    outline: none;
    border-radius: 0.375rem;
    box-shadow: inset 0 0 5px rgba(0,0,0,.2);
    transition: 0.5s;

    &.isChecked
    {
        background: #03a9f4;
    }

}

div.toggler {
    background-image: var(--image-url);
    background-position: center;
    background-repeat: no-repeat;
    background-size: 32px 32px;
    background-blend-mode: luminosity;
    background-color: #fff;
    position: absolute;
    width: 42px;
    height: 42px;
    transition: 0.5s;
    border-radius: 0.375rem;
    top: 0;
    left: 0;
    box-shadow: 0 0px 4px 2px rgba(0, 0, 0, 0.2);
    transform: scale(1.1);

    &.isChecked {
        left: 42px;
        background-blend-mode: normal;
    }
}

span {
    padding-left: 0.5rem;
}
</style>
4
