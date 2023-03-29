<template>

    <breadcrumbs />

    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">

            <SystemDictionaryTable
                    :dataTable="positions"
                    :fieldsName="fieldsName"
                    :fieldsTitle="fieldsTitle"
                    title="Довідник 'Посади'"
                    @newRecord="openFormForAdd"
                    @editRecord="openFormForEdit" />

        </div>
    </div>


</template>

<script>

import SystemDictionaryTable from '../../components/ui/SystemDictionaryTable.vue';

export default {
    name: 'PositionsMain',
    data() {
        return {
            positions: [],
            fieldsName: ['name', 'description'],
            fieldsTitle: ['Назва', 'Опис'],
        }
    },
    methods: {
        fetchPositions() {
            axios.get('/api/v1/positions')
                .then(res => {
                    this.positions = res.data.data
                });
        },
        openFormForAdd() {},
        openFormForEdit() {}
    },
    created() {
        this.fetchPositions();
    },
    components: {
        SystemDictionaryTable
    },
}

</script>
