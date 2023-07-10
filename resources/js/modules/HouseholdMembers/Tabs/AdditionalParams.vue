<template>

    <AdditionalParamsList
        owner="App\Models\HouseholdMember"
        :ownerId="$route.params.id"
        :additionalParams="params"
        @refreshData="refreshData"
    />

</template>


<script>

import AdditionalParamsList from '../../AdditionalParams/AdditionalParamsList.vue';

export default {
    name: 'HouseholdMemberAdditionalParams',
    data() {
        return {
            params: [],
        }
    },
    methods: {
        refreshData() {},
        fetchAdditionalParams() {
            axios.get(`/api/v1/household-members/${this.$route.params.id}/additional-data`)
                .then(res => {
                    this.params = res.data.data
                })
        }
    },
    created() {
        this.fetchAdditionalParams();
    },
    watch: {
        '$route' (to, from) {
            if (to.params.id !== from.params.id) {
                this.fetchAdditionalParams();
            }
        },
    },
    components: {
        AdditionalParamsList
    }
}

</script>
