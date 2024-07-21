<template>
    <div class="text-center pt-4 text-muted" v-if="relatives.length == 0">
        Родинні зв'язви не встановлені, або відсутні родичи
    </div>
    <div v-else class="relatives__wrapper">
        <div class="card relative" v-for="relative in relatives" :key="relative.id">
            <div class="card-header flex-column">
                <div class="fw-bold pb-1">{{ relative.surname }}</div>
                <div>{{ relative.name }} {{ relative.patronymic }}</div>    
            </div>
            <div class="card-body">
                <div class="border-bottom pb-2 mb-2  align-items-baseline lh-24">
                    <div class="d-flex align-items-baseline1">
                        <SvgIcon
                            type="mdi" 
                            :path="pathBirthdate"
                            :size="18"
                            class="me-1"
                            style="color:magenta" 
                            title="Дата народження"/> 
                        <span>
                            {{ relative.formatted_birthdate }}                
                        </span>
                    </div>
                    <span class="fs-07 text-muted">
                        {{ relative.full_age_with_prefix }}
                    </span>
                </div>
                <div class="lh-24">
                    <div class="d-flex align-items-center">
                        <SvgIcon
                            type="mdi" 
                            :path="pathRelation" 
                            :size="18"
                            class="me-1"
                            style="color:green" 
                            title="Родинні відносини"/>
                        {{ relative.relation }}
                    </div>
                    <div :class="[relative.sex ==  'чоловіча' ? 'male' : 'female']">
                        <SvgIcon 
                            type="mdi" 
                            :size="18"
                            :path="relative.sex == 'чоловіча' ? pathMale : pathFemale"
                            :title="relative.sex == 'чоловіча' ? 'чоловіча' : 'жіноча'" />
                    </div>
                </div>    
            </div>
            <div class="card-footer d-flex justify-content-center">
                <IconButton 
                        buttonClass="btn-outline-secondary btn-transparent px-2 py-1" 
                        @click="showHouseholdMemberInfo(relative)"
                        :size="18"
                        title="Перейти до інформації по члену домогосподарства"
                        :mdiPath="pathMdiAccountEye">
                    Інформація
                </IconButton>
            </div>
        </div>
    
    </div>
</template>

<script>

import SvgIcon          from '@jamescoyle/vue-icon';
import { 
    mdiGenderFemale,
    mdiGenderMale,
    mdiAccountEyeOutline,
    mdiCakeVariantOutline,
    mdiFamilyTree,
 } from '@mdi/js';

 import IconButton      from '../../../components/ui/Buttons/IconButton.vue';

export default {
    name: 'HouseholdMemberRelatives',
    components: {
        SvgIcon,
        IconButton
    },
    data() {
        return {
            relatives: [],
            pathMale: mdiGenderMale,
            pathFemale: mdiGenderFemale,
            pathMdiAccountEye: mdiAccountEyeOutline,
            pathBirthdate: mdiCakeVariantOutline,
            pathRelation: mdiFamilyTree,
        }
    },
    methods: {
        fetchRelatives() {
            axios.get(`/api/v1/household-members/${this.$route.params.id}/relatives`)
                .then(res => {
                    this.relatives = res.data.data;
                });
        },
        showHouseholdMemberInfo(relative) {            
            this.$router.push({name: 'household-member', params: {id: relative.id}});
        },
    },
    created() {
        this.fetchRelatives();
    }
}

</script>

<style lang="scss" scoped>

.relatives__wrapper {
    display: flex;
    gap: 1rem;
}

.card-body {
    & > div {
        display: flex;
        justify-content: space-between;
    }
}

.relative {
    // display: flex;
    // flex-direction: column;
    // border: 1px solid #e7e7e7;
    // border-radius: 0.2rem;
    // padding: 0.5rem 1rem;
    min-width: 220px;

    // div:nth-of-type(1) {
    //     font-weight: bold;
    //     margin-bottom: 0.2rem;
    // }

    // div:nth-of-type(2),
    // div:nth-of-type(3) {
    //     border-bottom: 1px solid #e7e7e7;
    //     padding-bottom: 0.5rem;
    //     margin-bottom: 0.5rem;
    // }

    // div:nth-of-type(3),
    // div:nth-of-type(4) {
    //     display: flex;
    //     justify-content: space-between;
    //     align-items: center;
    // }

    // div:nth-of-type(4) {
        .male, .female {
            display: flex;
            align-items: center;
        }
        .male {
            color: blue;
        }
        .female {
            color: red;
        }

    // }
}

</style>