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
    data() {
        return {

        }
    },
    methods: {
        saveData() {},
        closeForm() {
            this.$emit('refreshData');
        }
    },
    computed: {
        ...mapGetters('Households', ['household_id', 'familyInfo'])
    },
    components: {
        ModalForm,
        AdditionalParamsList
    }
}

</script>
