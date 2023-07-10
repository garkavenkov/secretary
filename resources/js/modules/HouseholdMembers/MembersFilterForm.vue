<template>

    <ModalForm formId="MembersFilterForm" @submitData="submitData" @closeForm="clearFormData" modalClass="">
        <div class="row mb-3">
            <div class="col">
                <label for="memberSettlement" class="form-label">Населений пункт</label>
                <select class="form-control"
                        id="memberSettlement"
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
                <label for="memberSex" class="form-label">Стать</label>
                <select class="form-control"
                        id="memberSex"
                        v-model="filter.sex">
                    <option value="all">Всі</option>
                    <option value="чоловіча">Чоловіча</option>
                    <option value="жіноча">Жіноча</option>
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
    name: 'MembersFilterForm',
    data() {
        return {}
    },
    methods: {
        submitData() {
            this.filter.isFiltered = true;
            this.$store.dispatch('HouseholdMembers/applyFilter', this.filter);
        },
        clearFormData() {}
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['filter']),
        ...mapGetters('Settlements', ['settlements']),
        filterIsNotReady() {
            return (this.filter.settlement_id == 0); // && (this.filter.household_type_id == 0);
        }
    },
    components: {
        ModalForm,
    }
}
</script>
