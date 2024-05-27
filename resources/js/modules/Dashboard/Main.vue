<template>
    <div class="row mb-3">
        <div class="col-md-3">
            <SettlementCountWidget />            
        </div>
        <div class="col-md-3">
            <HouseholdCountWidget />           
        </div>
        <div class="col-md-3">
            <MemberCountWidget />            
        </div>
        <div class="col-md-3">
            <BirthdayPeopleWidget :month="(new Date).getMonth() + 1"/>
        </div>
    </div>

    <!-- <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    Аналітика / Швидкий доступ. (можливість настроювати ...) 
                </div>
            </div>                
        </div>
    </div> -->

    <div class="row">
        <div class="col-md-8">
            <ChartWidget />
        </div>
        <div class="col-md-4">
            <Calendar />
        </div>
       
    </div>
</template>

<script>

import Calendar                 from '../../components/widgets/Calendar.vue';
import MemberCountWidget        from '../../components/widgets/MemberCountWidget.vue';
import HouseholdCountWidget     from '../../components/widgets/HouseholdCountWidget.vue';
import BirthdayPeopleWidget     from '../../components/widgets/BirthdayPeopleWidget.vue';
import SettlementCountWidget    from '../../components/widgets/SettlementCountWidget.vue';


import ChartWidget              from './ChartWidget.vue';

export default {
    name: 'Dashboard',
    components: {
        Calendar,
        MemberCountWidget,
        HouseholdCountWidget,
        BirthdayPeopleWidget,
        SettlementCountWidget,   
        ChartWidget    
    },
    data() {
        return {            
        }
    },
    methods: {

    }
}
</script>

<style lang="scss" scoped>
.birthday-people {

    .card-header {
        display: flex;

        svg {
            fill: red;
        }

        span:last-of-type {
            font-size: 1.1rem;
            margin-left: 1rem;
        }
    }

    .person-info, 
    .person-birthdate {
        span {
            display: block;

            span:first-of-type {
                font-size: 1.1rem;
            }

            &:last-of-type {
                font-size: 0.8rem;
                opacity: 0.8;
            }
        }
        
    }

    .person-birthdate {
        text-align: center;        
        
    }
}


</style>