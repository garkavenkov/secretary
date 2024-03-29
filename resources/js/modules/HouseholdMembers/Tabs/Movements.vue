<template>

    <div class="mb-3">
        <button class="btn btn-sm btn-outline-secondary"
                title="Додати подію"
                @click="showMovementEventForm">
            <span class="mdi mdi-calendar me-1"></span>
            Додати подію
        </button>
    </div>

    <template v-if="movements?.length">
        <table class="table table-sm table-bordered">
            <thead class="bg-body-secondary">
                <tr>
                    <th style="width:150px;">Дата</th>
                    <th>Подія</th>
                    <th>Коментар</th>
                    <th style="width:100px;"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(event, index) in movements" :key="index" class="align-middle">
                    <td>{{ event.date_formatted }}</td>
                    <td>{{ event.movement_type }}</td>
                    <td>{{ event.comment }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-warning btn-transparent me-3"
                                title="Редагувати подію"
                                @click="editMovementEvent(event)">
                            <span class="mdi mdi-pencil"></span>
                        </button>
                        <button class="btn btn-sm btn-outline-danger btn-transparent"
                                title="Видалити подію"
                                @click="deleteMovementEvent(event.id)">
                            <span class="mdi mdi-trash-can-outline"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </template>
    <template v-else>
        <div class="text-center text-muted">
            Інформація відсутня
        </div>
    </template>

    <teleport to="body">
        <MovementForm
                :formData="eventForm"
                :title="title"
                :submitCaption="submitCaption"
                :action="movementAction"
                :movementTypes="movementTypes"
                @refreshData="fetchMovementEvents"/>
    </teleport>

</template>

<script>

import { Modal }    from 'bootstrap';

import MovementForm from './MovementForm.vue'

export default {
    name: 'MemberMovementsTab',
    components: {
        MovementForm
    },
    data() {
        return {
            movementTypes: [],
            eventForm: {
                member_id: null,
                date: null,
                movement_type_id: 0,
                comment: ''
            },
            title: '',
            movementAction: '',
            submitCaption: '',
            movements: []
        }
    },
    methods: {
        showMovementEventForm() {
            this.title = 'Додати подію';
            this.submitCaption = 'Додати';
            this.movementAction = 'create';

            this.eventForm.member_id = this.$route.params.id;

            let movementForm = new Modal(document.getElementById('MovementForm'))
            movementForm.show();

        },
        editMovementEvent(event) {
            Object.assign(this.eventForm, event);

            this.title = 'Редагувати подію';
            this.submitCaption = 'Зберегти';
            this.movementAction = 'update';

            let movementForm = new Modal(document.getElementById('MovementForm'))
            movementForm.show();
        },
        closeForm() {
            this.clearMovementEventForm();
        },

        deleteMovementEvent(id) {
            this.$confirmDelete('Ви дійсно бажаєте видалити інформацію о реєстрації / переміщенні')
                .then(res => {
                    if (res.isConfirmed) {
                        axios.delete(`/api/v1/household-member-movements/${id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.$emit('refreshData');
                            })
                    }
                })
        },
        fetchMovementEvents() {
            axios.get(`/api/v1/household-members/${this.$route.params.id}/movements`)
                .then(res => {
                    this.movements = res.data.data;
                });
        },
    },
    created() {
        this.fetchMovementEvents();
        axios.get('/api/v1/movement-types')
            .then(res => {
                this.movementTypes = res.data.data;
            })
    },
    watch: {
        '$route' (to, from) {
            if (to.params.id !== from.params.id) {
                this.fetchMovementEvents();
            }
        },
    }
}

</script>
