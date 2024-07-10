<template>
    <div class="pt-4">
        <div class="row justify-content-around mb-xl-4 mb-md-4">
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="fw-bold border-bottom mb-xl-2 pb-xl-2 mb-lg-1 pb-lg-1">Адреса</div>
                <div v-if="household.short_address" class="household-address">
                    <span>
                        {{ household.short_address }}
                    </span>
                    <span>
                        {{ restOfAddress }}
                    </span>
                </div>
            </div>
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="fw-bold border-bottom mb-xl-2 pb-xl-2">Тип</div>
                <div v-if="household.household_type">
                    {{ household.household_type}}
                </div>
            </div>
        </div>
        <div class="row justify-content-around mb-xl-4 mb-md-4">
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-xl-2 pb-xl-2 mb-lg-1 pb-lg-1">
                    <span class="fw-bold">Власник<span v-show="household.owners && (household.owners.length > 1)">и</span></span>
                  
                    <ButtonAdd buttonClass="btn-sm btn-light ms-3 text-muted" title="Додати нового власника" @click="newOwner">
                        Додати власника
                    </ButtonAdd>

                </div>
                <div class="owners-wrapper">
                    <template v-if="household.owners && (household.owners.length > 0)">
                        <div    class="owner"
                                v-for="owner in household.owners"
                                :key="owner.id">
                            <div class="d-flex flex-column">
                                <span>{{ owner.name }}</span>
                                <span class="text-muted">{{ owner.address }}</span>
                            </div>
                            <div class="d-flex align-self-center">                               

                                <ButtonEdit 
                                    @click="editOwner(owner)"
                                    title="Редагувати інформацію про власника"
                                    buttonClass="btn-outline-warning btn-transparent p-2" />

                                <ButtonDelete
                                    buttonClass="btn-outline-danger btn-transparent ms-3 p-2"
                                    title="Видалити інформацію про власника"
                                    @click="deleteOwner(owner.id)" />

                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="text-muted text-center fs-08" id="no-owner-information">Інформація відсутня</div>
                    </template>
                </div>
                <div    id="owner-drop-zone"
                        class="owner-drop-zone fs-08"
                        @drop="dropHead($event)"
                        @dragover.prevent
                        @dragenter.prevent>
                    Переместить голову домогосподарства сюди
                </div>
            </div>
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="fw-bold border-bottom mb-xl-2 pb-xl-2 mb-lg-1 pb-lg-1 household-head">Голова домогосподарства</div>
                <div>
                    <template v-if="household.household_head">
                        <span   :draggable="!headIsAlreadyOwner"
                                style="cursor:grabbing;"
                                @dragstart="pickupHead($event, household.household_head)"
                                @dragend="pickupHeadEnded($event)">
                            {{ household.household_head }}
                        </span>
                    </template>
                    <template v-else>
                        <div class="text-muted text-center fs-08 p-2">Інформація відсутня</div>
                    </template>
                </div>
            </div>
        </div>
        <div class="row justify-content-around mb-xl-4">
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="fw-bold border-bottom mb-xl-2 pb-xl-2 mb-lg-1 pb-lg-1">Спеціальні відмітки</div>
                <div v-if="household.special_marks">{{ household.special_marks }}</div>
                <div v-else class="text-muted text-center fs-08 p-2">Інформація відсутня</div>
            </div>
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="fw-bold border-bottom mb-xl-2 pb-xl-2 mb-lg-1 pb-lg-1">Додаткові відомості</div>
                <div v-if="household.additional_data">{{ household.additional_data }}</div>
                <div v-else class="text-muted text-center fs-08 p-2">Інформація відсутня</div>
            </div>
        </div>
    </div>

    <OwnerForm
        :formData="ownerData"
        :action="action"
        @refreshData="$store.dispatch('Households/fetchRecord', household_id)"
        @getHouseholdAddress="ownerData.address = household.address" />

</template>

<script>
import { Modal }        from 'bootstrap'
import { computed }     from '@vue/reactivity'
import { mapGetters }   from 'vuex';

import OwnerForm        from './OwnerForm.vue';

export default {
    name: 'HouseholdInfo',
    data() {
        return {
            ownerData: {
                id: null,
                household_id: null,
                name: '',
                address: ''
            },
            modalTitle: '',
            modalSubmitCaption: '',
            action: '',            
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        newOwner(e) {
            this.modalTitle = 'Додати власника домогосподарства';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';
            this.ownerData.household_id = this.household_id;

            let ownerForm = new Modal(document.getElementById('HouseholdOwnerModalForm'))
            ownerForm.show();
        },
        editOwner(owner) {
            this.modalTitle = 'Редагувати власника домогосподарства';
            this.modalSubmitCaption = 'Змінити';
            this.action = 'update';

            this.ownerData.household_id = this.household_id;
            this.ownerData.name = owner.name;
            this.ownerData.address = owner.address;
            this.ownerData.id = owner.id;

            let ownerForm = new Modal(document.getElementById('HouseholdOwnerModalForm'))
            ownerForm.show();
        },
        deleteOwner(id) {
            this.$confirmDelete('Ви дійсно бажаєте видалити власника')
                .then(res => {
                    if (res.isConfirmed) {
                        axios.delete(`/api/v1/household-owners/${id}`)
                            .then(res => {
                                this.$store.dispatch('Households/fetchRecord', this.household_id)
                                this.$toast(res.data.message);
                            });
                    }
                })
        },
        pickupHead(e, head) {
            let index = this.household.owners.findIndex(o => {
                return ((o.name == head) && (o.address == this.household.address));
            })
            
            if (index == -1) {
                let noInfo = document.getElementById('no-owner-information');
                let dropZone = document.getElementById('owner-drop-zone');
                
                if (noInfo) {
                    noInfo.classList.add('hide')
                }

                dropZone.classList.add('active');

                e.dataTransfer.dropEffect = "move";
                e.dataTransfer.effectAllowed = "move";
                e.dataTransfer.setData('head', JSON.stringify({name: head, address: this.household.short_address}));
            }
        },
        dropHead(e) {
            e.stopPropagation();
            let data = e.dataTransfer.getData('head');
            if (data) {
                data = JSON.parse(data);
                data.household_id = this.household_id;

                axios.post('/api/v1/household-owners', data)
                    .then(res => {
                        this.$store.dispatch('Households/fetchRecord', this.household_id);
                        this.$toast(res.data.message);
                    })
            }
        },
        pickupHeadEnded(e) {
            e.stopPropagation();
            let dropZone = document.getElementById('owner-drop-zone');
            let noInfo = document.getElementById('no-owner-information');
            
            if (noInfo) {                
                noInfo.classList.remove('hide')
            }
                
            dropZone.classList.remove('active');
        }
    },
    computed: {
        ...mapGetters('Households', ['household', 'household_id']),
        restOfAddress() {
            return this.household.full_address.substring(this.household.short_address.length);
        },
        headIsAlreadyOwner() {
            if (this.household.household_head) {
                return this.household.owners.findIndex(o => {
                    return (o.name == this.household.household_head);
                }) != -1;
            }
        }
    },
    components: {
        OwnerForm,        
    }
}

</script>

<style lang="scss" scoped>


.household-address {

    span:last-of-type {
        color: var(--bs-gray-500);

        &:hover {
            color: var(--bs-card-color);
        }
    }

}

.owners-wrapper {

    .owner {
        display: flex;
        justify-content: space-between;
        border-width: 1px;
        border-style: dashed;
        border-radius: 5px;
        border-color: transparent;
        transition: all 0.3s ease;

        &:not(:last-child) {        
            border-bottom: 1px dashed #e7e7e7;
            // border-bottom: none;
            padding-bottom: 0.5rem;
            margin-bottom: 0.5rem;        
        }
    }
    
    #no-owner-information {        
        
        border: 1px solid transparent;
        padding: 0.75rem;

        &.hide {
            display: none;
        }
    }
    
}
    .owner-drop-zone {
        // visibility: hidden;
        display: none;
        background: repeating-linear-gradient(
            -45deg,
            transparent 0 4px,
            #e7e7e7 4px 6px
        );        
        border: 1px dotted #adb5bd;
        text-align: center;
        padding: 0.75rem;
        color: darkgray;
        border-radius: 0.2rem;
        transition: all 0.3s ease;
        &.active {
            // visibility: visible
            display: block;
        }
    }
// } 

@media (min-width:1200px) {
    // height: 0;
    .household-head {
        height: 39px;

    }
}

.fs-08 {
    font-size: 0.8rem;
}
</style>
