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
            <div class="card h-100">
                <!-- <div class="card-header"></div> -->
                <div class="card-body">
                    Chart will go here
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <Calendar />
        </div>
        <!-- <div class="col-md-4">
            <div class="card birthday-people">
                <div class="card-header">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 6C13.11 6 14 5.1 14 4C14 3.62 13.9 3.27 13.71 2.97L12 0L10.29 2.97C10.1 3.27 10 3.62 10 4C10 5.1 10.9 6 12 6M18 9H13V7H11V9H6C4.34 9 3 10.34 3 12V21C3 21.55 3.45 22 4 22H20C20.55 22 21 21.55 21 21V12C21 10.34 19.66 9 18 9M19 20H5V17C5.9 17 6.76 16.63 7.4 16L8.5 14.92L9.56 16C10.87 17.3 13.15 17.29 14.45 16L15.53 14.92L16.6 16C17.24 16.63 18.1 17 19 17V20M19 15.5C18.5 15.5 18 15.3 17.65 14.93L15.5 12.8L13.38 14.93C12.64 15.67 11.35 15.67 10.61 14.93L8.5 12.8L6.34 14.93C6 15.29 5.5 15.5 5 15.5V12C5 11.45 5.45 11 6 11H18C18.55 11 19 11.45 19 12V15.5Z" />
                        </svg>
                    </span>
                    <span>Дні народження</span>
                </div>
                <div class="card-body">
                    <div class="row border-bottom mb-2 pb-2">
                        <div class="col-md-8 person-info">
                            <span>Петренко Іван Іванович</span>
                            <span>с. Шаповалівка, вул. Свободи, буд. 5</span>
                        </div>
                        <div class="col-md-4 person-birthdate">
                            <span>25.05.1960</span>
                            <span>64 років</span>
                        </div>
                    </div> 
                    <div class="row border-bottom mb-2 pb-2">
                        <div class="col-md-8 person-info">
                            <span>Величко Борис Высилійович</span>
                            <span>с. Шаповалівка, вул. Свободи, буд. 1</span>
                        </div>
                        <div class="col-md-4 person-birthdate">
                            <span>26.05.1950</span>
                            <span>74 років</span>
                        </div>
                    </div> 
                    <div class="row border-bottom mb-2 pb-2">
                        <div class="col-md-8 person-info">
                            <span>Самусь Лідія Петрівна</span>
                            <span>с. Шаповалівка, вул. Козацької слави, буд. 32</span>
                        </div>
                        <div class="col-md-4 person-birthdate">
                            <span>28.05.1955</span>
                            <span>69 років</span>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-8 person-info">
                            <span>Хопляк Степан Вікторович</span>
                            <span>с. Шаповалівка, вул. Загребелля, буд. 15</span>
                        </div>
                        <div class="col-md-4 person-birthdate">
                            <span>29.05.1978</span>
                            <span>46 років</span>
                        </div>
                    </div> 

                </div>
            </div>
        </div> -->
    </div>
</template>

<script>

import Calendar                 from '../../components/widgets/Calendar.vue';
import MemberCountWidget        from '../../components/widgets/MemberCountWidget.vue';
import HouseholdCountWidget     from '../../components/widgets/HouseholdCountWidget.vue';
import BirthdayPeopleWidget     from '../../components/widgets/BirthdayPeopleWidget.vue';
import SettlementCountWidget    from '../../components/widgets/SettlementCountWidget.vue';


export default {
    name: 'Dashboard',
    components: {
        Calendar,
        MemberCountWidget,
        HouseholdCountWidget,
        BirthdayPeopleWidget,
        SettlementCountWidget
    },
    data() {
        return {

        }
    },
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