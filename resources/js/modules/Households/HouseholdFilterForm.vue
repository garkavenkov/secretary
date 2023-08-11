<template>

    <ModalForm formId="HouseholdFilterForm" @submitData="submitData" @closeForm="clearFormData" modalClass="modal-lg">

        <div class="row mb-3">
            <div class="col">
                <label for="settlementFilter" class="form-label">Населений пункт</label>
                <select class="form-control"
                        id="settlementFilter"
                        v-model="filter.settlement_id">
                    <option value="0">Усі населені пункти</option>
                    <option :value="settlement.id" v-for="settlement in settlements" :key="settlement.id">
                        {{settlement.name}}
                    </option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="householdTypeFilter" class="form-label">Тип об'єкта погосподарського обліку</label>
                <select class="form-control"
                        id="householdTypeFilter"
                        v-model="filter.household_type_id">
                    <option value="0">Усі типи об'єкта</option>
                    <option :value="householdType.id" v-for="householdType in householdTypes" :key="householdType.id">
                        {{householdType.name}}
                    </option>
                </select>
            </div>
        </div>

        <template v-slot:footer>
            <button class="btn btn-outline-secondary"
                    @click="$emit('resetFilter')"
                    title="Скинути фильтр"
                    :disabled="!filter.isFiltered">
                Скинути
            </button>
        </template>
    </ModalForm>


</template>

<script>
import { mapGetters }   from 'vuex';
import ModalForm        from '../../components/ui/ModalForm.vue';

export default {
    name: 'HouseholdFilterForm',
    data() {
        return {}
    },
    methods: {
        submitData() {
            this.filter.isFiltered = true;
            this.$store.dispatch('Households/applyFilter', this.filter);
        },
        clearFormData() {}
    },
    computed: {
        ...mapGetters('Households', ['filter']),
        ...mapGetters('Settlements', ['settlements']),
        ...mapGetters('HouseholdTypes', ['householdTypes']),
        // filterIsNotReady() {
        //     return (this.filter.settlement_id == 0) && (this.filter.household_type_id == 0);
        // }
    },
    components: {
        ModalForm,
    }
}
</script>
