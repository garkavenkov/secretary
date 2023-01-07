<template>
    <div class="timeline">
        <ul>
            <li v-for="(event,index) in events" :key="index" class="timeline-event">
                <div>
                    <h5>{{event.date}}</h5>
                    <p>{{ event.purpose }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Timeline',
    props: {
        'events': {
            type: Array,
            required: true
        }
    },
    data() {
        return {

        }
    }
}
</script>

<style lang="scss" scoped>
.timeline {
    width: 80%;

    &::before {
        content: '';
        position: absolute;
        height: 100%;
        width: 2px;
        left: 50%;
        transform: translateX(-50%);
        background: gray;
    }


    ul {
        list-style: none;

        li {
            // padding: 10px;
            // background: #1e1f22;
            // color: white;
            // border-radius: 10px;
            // margin-bottom: 20px;
            // width: 45%;
            padding: 0.5rem;
            background: var(--bs-gray-100);
            border: 1px solid var(--bs-gray-300);
            color: var(--bs-gray-800);
            border-radius: 0.375rem;
            margin-bottom: 2rem;
            width: 50%;
            position: relative;

            &::after {
                content: '';
                position: absolute;
                height: 20px;
                width: 20px;
                background: gray;
                border-radius: 50%;
                top: 0;
            }

            &:last-child {
                margin-bottom: 0;
            }

            div {
                p {
                    margin-bottom: 0;
                }
            }

            &:nth-child(odd) {
                float: left;
                clear: right;
                transform: translateX(-30px);

                &::after {
                    transform: translate(50%, -50%);
                    right: -30px;
                }
            }

            &:nth-child(even) {
                float: right;
                clear: left;
                // transform: translateX(30px);

                &::after {
                    transform: translate(-50%, -50%);
                    left: 30px;
                }
            }
        }
    }
}

</style>
