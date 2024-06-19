<template>
    
    <div class="card h-100">
        <!-- <div class="card-header">
            <div class="chart-name">
                Календар
            </div>
        </div> -->
        <div class="card-body">
            <div class="calendar__wrapper">
                <div class="calendar-header">
                    <div class="date__wrapper">
                        <div class="date-month">{{ monthNames[calendarDate.month-1]}}</div>
                        <div class="date-year">{{ calendarDate.year }}</div>
                    </div>
                    <div class="buttons__wrapper">
                        <div    class="today-date" 
                                @click="initializeCalendar(new Date)"
                                v-show="((this.calendarDate.month != this.currentDate.month) 
                                        || (this.calendarDate.year != this.currentDate.year))"
                                title="Певернутись на поточну дату">
                            Сьогодні
                        </div>
                        <div    class="prev_month" 
                                @click.exact="prevMonth" 
                                @click.ctrl="prevYear"
                                title="Пепередній місяць (клік з 'ctrl' - попередній рік)">
                            <slot name="previousMonth">&lt;</slot>
                        </div>
                        <div    class="next-month" 
                                @click.exact="nextMonth" 
                                @click.ctrl="nextYear"
                                title=" Наступний місяць (клік з 'ctrl' - наступний рік)">                            
                            <slot name="nextMonth">&gt;</slot>
                        </div>
                    </div>
                    
                </div>
    
                <div class="weekday-name__wrapper">
                    <div    v-for="(day, index) in weekdayName" 
                            :key="index" 
                            class="day_name"
                            :class="{'current': (index == currentDayOfWeek) && (this.calendarDate.month == this.currentDate.month) && (this.calendarDate.year == this.currentDate.year)}">
                        <span>{{ day }}</span>
                    </div>                
                </div>
    
                <div class="weeks__wrapper">
                    <div    class="week__wrapper" 
                            v-for="(week,weekIndex) in weeks" 
                            :key="weekIndex">
        
                            <div    v-for="(day,dayIndex) in week" 
                                    class="day-number"
                                    :class="{
                                        'prev-month': day.month == calendarDate.previousMonth, 
                                        'today': (day.day == currentDate.day) && (day.month == currentDate.month) && (day.year == currentDate.year),
                                        'like-today': (day.day == currentDate.day) && ((day.month != currentDate.month) || (day.year != currentDate.year)),
                                        'next-month': day.month == calendarDate.nextMonth
                                    }"
                                    :key="`${weekIndex}:${dayIndex}`">
                            <span>{{ day.day }}</span>    
                        </div>
        
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>

export default {
    name: 'CalendarWidget',
    props: {
        date: {
            type: Date,
            default: () => new Date()
        },
        month: {
            type: Number,
            required: false,
        },
        year: {
            type: Number,
            required: false
        },
        weekdayName: {
            type: Array,
            default: () => ['Пн.', 'Вт.', 'Ср.', 'Чт.', 'Пт.', 'Сб.', 'Нд.']
        },
        monthNames: {
            type: Array,
            default: () => [
                'Січень', 'Лютий', 
                'Березень', 'Квітень', 'Травень',
                'Червень', 'Липень', 'Серпень', 
                'Вересень', 'Жовтень', 'Листопад', 
                'Грудень'
            ]
        },
        weekStartsOnMonday: {
            type: Boolean,
            default: () => true
        }
    },
    data() {
        return {
            currentDate: {
                // day:18,
                // month: 5,
                // year: 2024
            },
            calendarDate: {
                // previousMonth: 4,
                // month: 5,
                // nextMonth: 6,
                // year: 2024
            },
            weeks: []
        }
    },
    methods: {
        alignAdjacentCalendarMonths() {
            this.calendarDate.nextMonth = this.calendarDate.month + 1;
            this.calendarDate.previousMonth = this.calendarDate.month - 1;

            if (this.calendarDate.nextMonth > 12 ) {
                this.calendarDate.nextMonth = 1;
            }
            if (this.calendarDate.previousMonth == 0 ) {
                this.calendarDate.previousMonth = 12;            
            }
        },
        prevMonth() {
            this.calendarDate.month--;

            if (this.calendarDate.month == 0 ) {
                this.calendarDate.month = 12;                
                this.calendarDate.year--;
            }
            this.alignAdjacentCalendarMonths();
            this.generateCalendar(new Date(this.calendarDate.year, this.calendarDate.month-1, 1));
        },        
        nextMonth() {
            this.calendarDate.month++;

            if (this.calendarDate.month > 12 ) {
                this.calendarDate.month = 1;                
                this.calendarDate.year++;
            }                        

            this.alignAdjacentCalendarMonths();
            this.generateCalendar(new Date(this.calendarDate.year, this.calendarDate.month-1, 1));
        },
        prevYear() {
            this.calendarDate.year--;
            this.generateCalendar(new Date(this.calendarDate.year, this.calendarDate.month-1, 1));
        },
        nextYear() {
            this.calendarDate.year++;
            this.generateCalendar(new Date(this.calendarDate.year, this.calendarDate.month-1, 1));
        },
        initializeCalendar(date) {
            let currentDate = new Date();
            this.currentDate.day = currentDate.getDate();
            this.currentDate.month = currentDate.getMonth() + 1;
            this.currentDate.year = currentDate.getFullYear();

            this.calendarDate.month = date.getMonth() + 1;
            this.calendarDate.year =  date.getFullYear();
            this.alignAdjacentCalendarMonths();

            this.generateCalendar(new Date(this.currentDate.year, this.currentDate.month-1,1))
        },
        resetCalendar() {
            // this.calendarDate.
        },
        // Returns weekday number of the first day of DATE's month
        // Result will be in range  [0-6] or [1-7], 
        // depending on which day starts week (Sunday or Monday)
        getMonthFirstDayInWeek(year, month) {
            // const currentDate = (typeof date === 'object') ? date : new Date();
            // let currentDateMonth = date.getMonth();
            let monthStartsOn = new Date(year, month, 1).getDay();
            if (this.weekStartsOnMonday) {
                return monthStartsOn == 0 ? 6 : monthStartsOn - 1;
            } 
            return monthStartsOn;
        },
        // Returns arrays of days from previouse month if current month
        // does not start of first day of week (Sunday or Monday)
        getPreviouseMonthDays(date) {
            let currentYear = date.getFullYear();
            let currentMonth = date.getMonth();

            let daysInPreviousMonth = this.getDaysInMonth(currentYear, currentMonth);
            // console.log(`Days in previous month: ${daysInPreviousMonth}`);
            let monthStartsOnWeekDayIndex = this.getMonthFirstDayInWeek(currentYear, currentMonth);
            // console.log(`Current month starts on ${monthStartsOn} day of a week`);
            let previousDays = [];
            
            if (monthStartsOnWeekDayIndex > 0) {
                //console.log(`getPreviouseMonthDays currentMonth: ${currentMonth}`);
                let previouseMonthInWeekStartsOn = daysInPreviousMonth - monthStartsOnWeekDayIndex+1;
                // console.log(`Previous mouth's days start on ${previouseMonthInWeekStartsOn}`);
                for(let i=previouseMonthInWeekStartsOn; i<=daysInPreviousMonth; i++) {
                    previousDays.push({day:i, month: currentMonth, year: currentYear});
                }
            }
            // if (this.weekStartsOnMonday) {
            //     for()
            // }

            return previousDays;
        },
       
        // Get week number [1-52]
        getWeekNumber(date) {
            // const currentDate = (typeof date === 'object') ? date : new Date();
            const januaryFirst = new Date(currentDate.getFullYear(), 0, 1);
            const daysToNextMonday = (januaryFirst.getDay() === 1) ? 0 : (7 - januaryFirst.getDay()) % 7;
            const nextMonday = new Date(currentDate.getFullYear(), 0, januaryFirst.getDate() + daysToNextMonday);
 
            return  (currentDate < nextMonday) 
                    ? 52 
                    : (currentDate > nextMonday 
                        ? Math.ceil((currentDate - nextMonday) / (24 * 3600 * 1000) / 7) 
                        : 1
                    );
        },
        // Get days count in DATE's month
        // Return number in range [28 - 31]
        // Month takes values in range [1-12]
        getDaysInMonth(year, month) {
            // console.log(`Year: ${year}, Month: ${month}`);
            return new Date(year, month, 0).getDate();
        },
        range(size, startAt = 0) {
            return [...Array(size).keys()].map(i => i + startAt);
        },
        // Fill calendar
        generateCalendar(date) {   
            this.weeks = [];
            // const currentDate = (typeof date === 'object') ? date : new Date();
            let currentYear = date.getFullYear();
            let currentMonthIndex = date.getMonth(); // Starts from 0
            let currentMonth = currentMonthIndex + 1; // Convert to real month index which starts from 1
            
            let daysInCurrentMonth = this.getDaysInMonth(currentYear, currentMonthIndex+1);
            let monthStarts = this.getMonthFirstDayInWeek(currentYear, currentMonthIndex);

            let daysFromPreviousMonth = this.getPreviouseMonthDays(date);
            let weeksCount =  Math.ceil( (monthStarts + daysInCurrentMonth) / 7);            
            let week = [...daysFromPreviousMonth];
            let day = 1
            for (let i=monthStarts; i<7; i++, day++) {
                week.push({day: day, month: currentMonth, year: currentYear});
            }
            this.weeks.push(week);
            
            for (let i=2; i<weeksCount; i++) {
                week = [...this.range(7, day)].map(d => {
                    return {
                        day: d, 
                        month: currentMonth, 
                        year: currentYear
                    }
                });
                this.weeks.push(week);
                day +=7;
            }

            let nextMonthDayInLastWeek = (7 - (daysInCurrentMonth - day + 1));
            week = [];
            for (let i=day; i<=daysInCurrentMonth; i++) {
                week.push({day:i, month: currentMonth, year: currentYear});
            }

            let nextMonthYear = currentMonth+1 > 12 ? currentYear +1 : currentYear;
            for (let i=1; i<=nextMonthDayInLastWeek; i++) {
                week.push({day: i, month: currentMonth+1, year: nextMonthYear});
            }
            this.weeks.push(week);
            //console.log(this.weeks);
        }
    },
    computed: {
        currentDayOfWeek() {
            let dayOfWeek = this.date.getDay();
            // let currentMonth = (this.calendarDate.month == this.currentDate.month) && (this.calendarDate.year == this.currentDate.year);
            // let currentWeekDay = this.weekStartsOnMonday ? (dayOfWeek == 0 ? 6 : dayOfWeek - 1) : dayOfWeek;
            return this.weekStartsOnMonday ? (dayOfWeek == 0 ? 6 : dayOfWeek - 1) : dayOfWeek;
            // return currentWeekDay && currentMonth;
        }
    },
    created() {
        this.initializeCalendar(this.date);
        // this.generateCalendar(this.date);
    }
}

</script>

<style lang="scss" scoped>

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;

    .buttons__wrapper {
        display: flex;
        gap: 1rem;
        align-items: center;
        
        .today-date {
            // background: indianred;            
            // padding: 0.25rem 0.5rem;
            // border-radius: 99px;
            // color:white;
            color: indianred;
            font-size: 0.85rem;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            transition: background 0.3s;
            border-radius: 10px;

            &:hover {
                background: indianred;
                color: white !important;
            }
        }

        .prev_month, 
        .next-month {
            padding: 0.5rem 1rem;
            border: 1px solid #e7e7e7;
            border-radius: 0.25rem;
            transition: all 0.3s;
    
            &:hover {
                border: 1px solid var(--bs-primary);
                background: var(--bs-primary);
                color: white;
                font-weight: 700;
            }
        }

    }

    .date__wrapper {
        display: flex;
        font-size: 1rem;
        font-weight: 700;

        div:last-of-type {
            margin-left: 1rem;
        }
    }    
}

.weekday-name__wrapper {
    display: flex;
    justify-content: space-between;
    font-weight: 700;
    border-bottom: 1px solid #e7e7e7;
    margin-bottom: 1rem;
    // padding-bottom: 0.5rem;

    .day_name {
        width: 100%;
        text-align: center;
        padding: 0.25rem 0 0.75rem 0;
        border-bottom: 2px solid var(--bs-secondary-border-subtle);

        &.current {
            // background: indianred;
            // color: white;
            // border-radius: 99px;
            color: indianred;
            border-bottom-color: indianred;
        }
    }
}

.weeks__wrapper {
    display:  flex;
    flex-direction: column;
    gap: 1rem;

    .week__wrapper {
        display: flex;
        justify-content: space-between;
    
        .day-number.prev-month, 
        .day-number.next-month {
            opacity: 0.4;
        }
    
        .day-number {
            width: 100%;
            text-align: center;
            padding: 1rem 0;
            border-radius: 0.2rem;
    
            &.today {
                background: indianred;
                color: white;
                
            }
            
            &.like-today {
                background: var(--bs-secondary-bg);
            }
    
            &:hover:not(.today) {
                background: lightblue;        
            }
        }
    }
}

</style>