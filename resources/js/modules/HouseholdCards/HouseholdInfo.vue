<script>

export default {
    name: 'HouseholdInfo',
    props: {
        'info': {
            type: Object,
            required: false
        }
    },
    data() {
        return {}
    }
}

</script>

<template>
    <div class="p-4">
        <div class="mb-3">
            <div class="fw-bold">Тип</div>
            <div v-show="info.type">
                {{ info.type}}
            </div>
        </div>
        <div class="mb-3">
            <div class="fw-bold">Адреса</div>
            <div v-show="info.address">
                {{ info.address }}
            </div>
        </div>
        <div class="mb-3">
            <div>
                <span class="fw-bold">Власник(и)</span>
                <button class="btn btn-sm btn-outline-secondary ms-3">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
            <div>Гаркавенков Валентин Юрійович</div>
        </div>
        <div class="mb-3">
            <div class="fw-bold">Голова домогосподарства</div>
            <div>Гаркавенков Юрій Григорович</div>
        </div>
    </div>
</template>
