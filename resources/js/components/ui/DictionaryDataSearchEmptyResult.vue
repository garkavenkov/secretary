<template>
    <tr>
        <td :colspan="cols" class="p-3 text-muted text-center">
            <slot>
                Дані, що задовольняють пошуку, не знайдені.
            </slot>
        </td>
    </tr>
</template>

<script>

export default {
    name: 'DictionaryDataSearchEmptyResult',
    props: {
        'cols': {
            type: Number,
            required: true
        }
    },
    data() {
        return {

        }
    }
}


</script>