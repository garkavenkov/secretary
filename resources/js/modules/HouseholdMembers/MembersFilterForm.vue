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
            <div class="col">
                <label for="memberStatus" class="form-label" :class="{'filtered': filter.status !== 'alive'}">Статус</label>
                <select class="form-control"
                        id="memberStatus"
                        v-model="filter.status">
                    <option value="alive">Живі</option>
                    <option value="dead">Мертві</option>
                    <option value="all">Всі</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col" >
                <label class="form-check-label" for="filterByAge">                        
                    Відобразити за віком
                </label>                    
                <input class="form-check-input ms-2" type="checkbox" value="" id="filterByAge" v-model="filter.age.selected">
            </div>
            <div class="col d-flex justify-content-end">
                <span class="text-muted" v-html="ageRangeInformation"></span>                
            </div>
        </div>
        <div class="row mb-3" v-if="filter.age.selected">
            <div class="col">
                <RangeInput 
                    v-if="oldestAge"
                    min="0" 
                    :max="oldestAge" 
                    v-model:minValue="filter.age.values[0]" 
                    v-model:maxValue="filter.age.values[1]" />
            </div>           
        </div>

        <AdditionalParamsFormFilter :params="params" :filter="filter" />
        
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
import RangeInput                   from '../../components/ui/RangeInput.vue';


export default {
    name: 'MembersFilterForm',
    mixins: [AdditionalParamsFilter],
    data() {
        return {
            // params: [],
            // ageFilterType: 'all',
            filterByAge: false,
            oldestAge: null,
            // firstAgeValue: null,
            // secondAgeValue: null,
            // ageRange: []
        }
    },
    methods: {
        submitData() {         
            this.filter.isFiltered = true;
            this.$store.dispatch('HouseholdMembers/applyFilter', this.filter);
        },
        getAgeOfOldestPerson() {
            axios.get('api/v1/get-age-of-oldest-person')
                .then(res => {                    
                    this.oldestAge = res.data !== '' ?  res.data : 100;
                    this.filter.age.values[1] = this.oldestAge;

                });
        },
        clearFormData() {},       
      
    },
    computed: {
        ...mapGetters('HouseholdMembers', ['filter']),
        ...mapGetters('Settlements', ['settlements']),
        filterIsNotReady() {
            return (this.filter.settlement_id == 0); // && (this.filter.household_type_id == 0);
        },
        ageRangeInformation() {
            if (!this.filter.age.selected || (this.filter.age.values[0] == 0 && this.filter.age.values[1] == this.oldestAge )) {

                return 'різного віку'

            } else if (this.filter.age.values[0] == 0 ){
                
                let year = this.filter.age.values[1] % 10;
                let str = (this.filter.age.values[1] == 11 || year == 0 || year > 4) ? 'років' : ((year == 1 ) ? 'рік' : 'роки');
                
                return `включно по <b>${this.filter.age.values[1]}</b> ${str}`

            } else if (this.filter.age.values[1] == this.oldestAge ) {
                
                let str = (this.filter.age.values[0] % 10 == 1) ? (this.filter.age.values[0] == 11 ? 'років' : 'року') : 'років';
                // let str = ( (this.filter.age.values[0] == 11) || (this.filter.age.values[0] % 10 == 1) ) ? 'року' : 'років';                

                return `починаючи з <b>${this.filter.age.values[0]}</b> ${str}`

            } else {

                let year = this.filter.age.values[1] % 10;
                let str = ( (this.filter.age.values[1] > 10 && this.filter.age.values[1] <=14) || year == 0 || year > 4) ? 'років' : (year == 1  ? 'рік' : 'роки');

                return `включно з <b>${this.filter.age.values[0]}</b> по <b>${this.filter.age.values[1]}</b> ${str}`

            }
        }        

    },    
    created() {
        this.fetchAdditionalParamsForFilter('App\\Models\\HouseholdMember', 'boolean');
        this.getAgeOfOldestPerson();
    },
    components: {
        ModalForm,
        AdditionalParamsFormFilter,
        RangeInput
    }
}
</script>