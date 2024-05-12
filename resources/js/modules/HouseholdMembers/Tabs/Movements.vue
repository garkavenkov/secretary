<template>

    <template v-if="movements?.length">
        <table class="table table-sm table-bordered">
            <thead class="bg-body-secondary">
                <tr>
                    <th style="width:150px;" class="text-center align-middle">Дата</th>
                    <th class="align-middle">Подія</th>
                    <th class="align-middle">Коментар</th>
                    <th style="width:150px; text-align: center !important;">
                        <IconButton 
                            :buttonClass="['btn-sm btn-outline-primary btn-transparent lh-24 d-inline-flex']"
                            title="Додати подію"
                            @click="newMovementEvent"
                            :size="16"
                            :mdiPath="pathMdiCalendar" 
                            caption="Додати подію"/>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(movement, index) in movements" :key="index" class="align-middle">
                    <td class="text-center">{{ movement.date_formatted }}</td>
                    <td>{{ movement.movement_type }}</td>
                    <td>{{ movement.comment }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-around">
                            <IconButton 
                                    :buttonClass="['btn-sm btn-outline-warning btn-transparent p-2']"
                                    title="Редагувати подію"
                                    @click="editMovementEvent(movement)"
                                    :size="14"
                                    :mdiPath="pathMdiPencil" />

                            <IconButton 
                                    :buttonClass="['btn-sm btn-outline-danger btn-transparent p-2']"
                                    title="Видалити подію"
                                    @click="deleteMovementEvent(movement.id)"
                                    :size="14"
                                    :mdiPath="pathMdiTrashCan" />
                        </div>                                         
                    </td>
                </tr>
            </tbody>
        </table>
    </template>
    <template v-else>
        <div class="d-flex flex-column align-items-center">
            <span class="text-muted mb-2">
                Інформація по переміщенню відсутня
            </span>

            <IconButton 
                :buttonClass="['btn-sm btn-outline-primary lh-24']"
                title="Додати подію"
                @click="newMovementEvent"
                :size="16"
                :mdiPath="pathMdiCalendar" 
                caption="Додати подію"/>
            </div>

    </template>

    <teleport to="body">
        <MovementForm
                :formData="eventForm"                
                :action="action"
                :movementTypes="movementTypes"
                @refreshData="fetchMovementEvents"/>
    </teleport>

</template>

<script>

import { Modal }        from 'bootstrap';
import { computed }     from 'vue';

import { 
    mdiCalendar,
    mdiPencil,    
    mdiTrashCanOutline,
}  from '@mdi/js';

import MovementForm     from './MovementForm.vue'
import IconButton       from '../../../components/ui/Buttons/IconButton.vue';

export default {
    name: 'MemberMovementsTab',
    components: {
        MovementForm,
        IconButton
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
            action: '',
            modalTitle: '',
            modalSubmitCaption: '',
            movements: [],
            pathMdiCalendar: mdiCalendar,
            pathMdiPencil: mdiPencil,    
            pathMdiTrashCan: mdiTrashCanOutline,
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption)
        }
    },    
    methods: {
        newMovementEvent() {
            this.modalTitle = 'Додати подію';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            this.eventForm.member_id = this.$route.params.id;

            let movementForm = new Modal(document.getElementById('MovementForm'))
            movementForm.show();

        },
        editMovementEvent(event) {
            Object.assign(this.eventForm, event);

            this.modalTitle = 'Редагувати подію';
            this.modalSubmitCaption = 'Зберегти';
            this.action = 'update';

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
