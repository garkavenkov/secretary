<template>

    <ModalForm formId="HouseholdMembersMainFilterForm" @submitData="submitData" @closeForm="clearFormData" modalClass="">
        <div class="row mb-3">
            <div class="col">
                <label for="memberSettlement" class="form-label" :class="{'filtered' : filter.settlement_id !== 0}">Населений пункт</label>
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
                <label for="memberSex" class="form-label" :class="{'filtered': filter.sex !== 'all'}">Стать</label>
                <select class="form-control"
                        id="memberSex"
                        v-model="filter.sex">
                    <option value="all">Всі</option>
                    <option value="чоловіча">Чоловіча</option>
                    <option value="жіноча">Жіноча</option>
                </select>
            </div>
        </div>

        <AdditionalParamsFormFilter :params="params" :filter="filter" />
        <!-- <div class="row mb-3">
            <div class="col">
                <h5 class="additional-param-title">Додаткові параметри</h5>
                <div class="additional-param-wrapper">
                    <label v-for="param in params" :key="param.id" :for="param.code" class="additional-param">{{ param.name }}
                        <input type="checkbox" :name="param.code" :id="param.code" v-model="filter.additionalParams[param.code]">
                    </label>
                </div>
            </div>
        </div> -->

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
import { mapGetters }               from 'vuex';
import AdditionalParamsFilter       from '../../mixins/AdditionalParamsFilter';
import ModalForm                    from '../../components/ui/ModalForm.vue';
import AdditionalParamsFormFilter   from '../../components/ui/AdditionalParamFormFilter.vue';


export default {
    name: 'MembersFilterForm',
    mixins: [AdditionalParamsFilter],
    data() {
        return {
            // params: [],
        }
    },
    methods: {
        submitData() {
            this.filter.isFiltered = true;
            this.$store.dispatch('HouseholdMembers/applyFilter', this.filter);
        },
        clearFormData() {},
        // fetchAdditionalParamsForFilter() {
        //     axios.get('/api/v1/additional-params?value_type_code=boolean&category_code=')
        //         .then(res => {
        //             this.params = res.data.data;
        //         })
        // }
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['filter']),
        ...mapGetters('Settlements', ['settlements']),
        filterIsNotReady() {
            return (this.filter.settlement_id == 0); // && (this.filter.household_type_id == 0);
        }
    },
    created() {
        this.fetchAdditionalParamsForFilter('App\\Models\\HouseholdMember', 'boolean');
    },
    components: {
        ModalForm,
        AdditionalParamsFormFilter
    }
}
</script>