<template>
    <div class="py-3">

        <div class="row justify-content-around mb-xl-2 mb-md-4">
            <div class="col-xl-5 col-md-5 mb-3">                
                <div class="field-name">Прізвище Ім'я по батькові</div>
                <div class="field-value">{{ member.full_name }}</div>
            </div>
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Місце роботи <span>( залежно від територіального розташування )</span></div>
                <div v-if="member.work_place" class="field-value">{{ member.work_place }}</div>
                <div v-else class="text-muted text-center fs-08 p-2">Інформація відсутня</div>
            </div>
        </div>
        
        <div class="row justify-content-around mb-xl-2 mb-md-4">
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Дата народження</div>
                <div class="field-value">{{ member.birthdate_formatted }} <span v-if="member.death_date == ''">( повних років: {{ member.full_age }})</span></div>
            </div>
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Відомості про зайнятість / незайнятість</div>
                <div v-if="member.employment_information" class="field-value">{{ member.employment_information }}</div>
                <div v-else class="text-muted text-center fs-08 p-2">Інформація відсутня</div>
            </div>
        </div>

        <div class="row justify-content-around mb-xl-2 mb-md-4">            
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Стать</div>
                <div class="field-value">{{ member.sex }}</div>
            </div>
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Відомості про пенсію, інвалідність, отримання соціальної допомоги</div>
                <div v-if="member.social_information" class="field-value">{{ member.social_information }}</div>
                <div v-else class="text-muted text-center fs-08 p-2">Інформація відсутня</div>
            </div>
        </div>   
        

        <div class="row justify-content-around mb-xl-2 mb-md-4">
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Родинні стосунки <span>( по відношеню до голови домогосподарства )</span></div>
                <div class="field-value">{{ member.family_relationship_type }}</div>
            </div>            
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Додаткова інформація</div>
                <div v-if="member.additional_information" class="field-value">{{ member.additional_information }}</div>
                <div v-else class="text-muted text-center fs-08 p-2">Інформація відсутня</div>
            </div>
        </div>
              
        <div class="row justify-content-around mb-xl-2 mb-md-4" v-if="member.death_date !== null">
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="row">
                    <div class="col">
                        <div class="field-name">Дата смерті</div>
                        <div class="field-value">{{ member.death_date_formatted }} <span>( у віці: {{ member.full_age }} )</span></div>
                    </div>
                    <div class="col">
                        <div class="field-name">Номер свідоцтва</div>
                        <div class="field-value">{{ member.death_register_number }}</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-md-5 mb-3">
                <div class="field-name">Орган</div>
                <div class="field-value">{{ member.death_register_office }}</div>
            </div>       
        </div>
        
    </div>    
     

</template>

<script>

import { mapGetters }   from 'vuex';

export default {
    name: 'MemberMainInfoTab',    
    data() {
        return {          
        }
    },    
    computed: {        
        ...mapGetters('HouseholdMembers', ['member']),
    } 
}

</script>


<style lang="scss" scoped>

.field-name {
    font-weight: 600;
    border-bottom: 1px solid #e7e7e7;
    margin-bottom: 0.25rem;
    padding-bottom: 0.25rem;
    color: var(--bs-secondary-color);
}

.field-name span, 
.field-value span {
    font-weight: normal;
    font-size: 0.85rem;
    opacity: 0.85;
}

</style>


