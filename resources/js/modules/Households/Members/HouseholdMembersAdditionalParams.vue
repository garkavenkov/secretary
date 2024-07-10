<template>
    <ModalForm formId="HouseholdFamilyAdditionalParams" @submitData="saveData" @closeForm="closeForm" modalClass="modal-lg" :showFooter="false">

        <AdditionalParamsList
            owner="App\Models\Household"
            :ownerId="household_id"
            :additionalParams="[...familyInfo]"
            @refreshData="$emit('refreshData')"
        />

    </ModalForm>

</template>


<script>

import { mapGetters }       from 'vuex';

import ModalForm            from '../../../components/ui/ModalForm.vue';
import AdditionalParamsList from '../../AdditionalParams/AdditionalParamsList.vue';

export default {
    name: 'HouseholdFamilyAdditionalParams',
    // props: {
    //     'familyInfo' : {
    //         type: Array,
    //         required: true
    //     }
    // },
    data() {
        return {
            familyInfo: []
        }
    },
    methods: {
        saveData() {},
        closeForm() {
            this.$emit('refreshData');
        },
        fetchFamilyInfo() {
            axios.get(`/api/v1/households/${this.household_id}/family-info`)
            .then(res => {
                this.familyInfo = res.data.data;                
            })
        }
    },
    created() {
        this.fetchFamilyInfo();
    },
    computed: {
        ...mapGetters('Households', ['household_id'])
    },
    components: {
        ModalForm,
        AdditionalParamsList
    }
}

</script>
