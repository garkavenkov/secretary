<template>
    <breadcrumbs />

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="settlement.name">
                <div class="card-header">
                    <!-- <h5>Інформація</h5> -->
                    <div class="dictionary-name__wrapper">
                        <span>Інформація</span>
                        <!-- <button class="btn btn-sm btn-primary">
                            <i class="bi bi-plus"></i>
                        </button> -->
                    </div>
                <div>
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-pencil"></i>
                </button>
            </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Назва
                            </div>
                            <div class="col-md-9">
                                {{ settlement.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Тип поселення
                            </div>
                            <div class="col-md-9">
                                {{ settlement.settlement_type.name }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Внутрішній код
                            </div>
                            <div class="col-md-9">
                                {{ settlement.inner_code }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Індекс
                            </div>
                            <div class="col-md-9">
                                {{ settlement.postcode }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                КАТОТТГ
                            </div>
                            <div class="col-md-9">
                                {{ settlement.katottg }}
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                Міська / сільська рада
                            </div>
                            <div class="col-md-9">
                                <router-link :to="{name: 'CouncilsShow', params: {id: settlement.council_id}}">
                                    {{ settlement.council.name }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SettlementsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            settlement: {}
        }
    },
    methods: {
        fetchData() {
            axios.get(`/api/v1/settlements/${this.id}`)
                .then(res => {
                    this.settlement = res.data.data
                });
        }
    },
    created() {
        this.fetchData();
    }
}
</script>
