<template>
    <div class="pt-4">
        <div class="row justify-content-around mb-xl-4 mb-md-4">
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="fw-bold">Адреса</div>
                <div v-if="info.address" class="px-md-3 px-xl-1">
                    {{ info.address }}
                </div>
            </div>
            <div class="col-xl-5 col-md-12 mb-md-4">
                <div class="fw-bold">Тип</div>
                <div v-if="info.household_type" class="px-md-3 px-xl-1">
                    {{ info.household_type.name}}
                </div>
            </div>
        </div>
        <!-- <div class="row mb-4">
            <div class="col-md-5">
                <div class="fw-bold">Тип</div>
                <div v-if="info.household_type">
                    {{ info.household_type.name}}
                </div>
            </div>
        </div> -->
        <div class="row justify-content-around mb-xl-4">
            <div class="col-xl-5 col-md-12  mb-md-4">
                <div class="d-flex justify-content-between align-items-center border-bottom mb-2 pb-2">
                    <span class="fw-bold">Власник<span v-if="info.owners && (info.owners.length > 1)">и</span></span>
                    <button class="btn btn-sm btn-light ms-3 text-muted" @click="newOwner" title="Додати нового власника">
                        <span class="mdi mdi-plus"></span>
                        Додати власника
                    </button>
                </div>
                <div id="owners" class="owner-wrapper px-md-3 px-xl-1"  @drop="dropHead($event)" @dragover.prevent @dragenter.prevent>
                    <template v-if="info.owners && (info.owners.length > 0)">
                        <div class="d-flex justify-content-between" v-for="owner in info.owners" :key="owner.id">
                                <div class="d-flex flex-column">
                                    <span>{{ owner.name }}</span>
                                    <span class="text-muted">{{ owner.address }}</span>
                                </div>
                                <div class="align-self-center">
                                    <button class="btn btn-sm btn-outline-warning" title="Редагувати власника" @click="editOwner(owner)">
                                        <span class="mdi mdi-pencil"></span>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger ms-3" title="Видалити власника" @click="deleteOwner(owner.id)">
                                        <span class="mdi mdi-trash-can-outline"></span>
                                    </button>
                                </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="text-muted text-center fs-08">Інформація відсутня</div>
                    </template>
                </div>
            </div>
            <div class="col-xl-5 col-md-12">
                <div class="fw-bold border-bottom mb-2 pb-2 household-head">Голова домогосподарства</div>
                <div class="px-md-3 px-xl-1">
                    <template v-if="info.household_head">
                        <span draggable="true" @dragstart="pickupHead($event, info.household_head)" @dragend="pickupHeadEnded($event)">{{ info.household_head }}</span>
                    </template>
                    <template v-else>
                        <div class="text-muted text-center fs-08 pt-2">Інформація відсутня</div>
                    </template>
                </div>
            </div>
        </div>
        <!-- <div class="row mb-3">
            <div class="col">
                <div class="fw-bold">Голова домогосподарства</div>
                <div>
                    <template v-if="info.household_head">
                        {{ info.household_head }}
                    </template>
                    <template v-else>
                        Інформація відсутня
                    </template>
                </div>
            </div>
        </div> -->
    </div>

    <OwnerForm
        :formData="ownerData"
        :action="action"
        @refreshData="$store.dispatch('Households/fetchRecord', ownerData.household_id)"
        @getHouseholdAddress="ownerData.address = info.address"/>

</template>

<script>
import { Modal }    from 'bootstrap'
import { computed } from '@vue/reactivity'

import OwnerForm from './OwnerForm.vue';

export default {
    name: 'HouseholdInfo',
    props: {
        'info': {
            type: Object,
            required: false
        }
    },
    data() {
        return {
            ownerData: {
                id: null,
                household_id: this.info.household_id,
                name: '',
                address: ''
            },
            modalTitle: '',
            modalSubmitCaption: '',
            action: ''
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

            let ownerForm = new Modal(document.getElementById('HouseholdOwnerModalForm'))
            ownerForm.show();
        },
        editOwner(owner) {
            this.modalTitle = 'Редагувати власника домогосподарства';
            this.modalSubmitCaption = 'Змінити';
            this.action = 'update';

            this.ownerData.name = owner.name;
            this.ownerData.address = owner.address;
            this.ownerData.id = owner.id;

            let ownerForm = new Modal(document.getElementById('HouseholdOwnerModalForm'))
            ownerForm.show();
        },
        deleteOwner(id) {
            axios.delete(`/api/v1/household-owners/${id}`)
                .then(res => {
                    this.$store.dispatch('Households/fetchRecord', this.info.household_id)
                });
        },
        pickupHead(e, head) {
            let index = this.info.owners.findIndex(o => {
                return ((o.name == head) && (o.address == this.info.address));
            })

            if (index == -1) {
                let ownersId = document.getElementById('owners');
                ownersId.classList.add('drop-zone');

                e.dataTransfer.dropEffect = "move";
                e.dataTransfer.effectAllowed = "move";
                e.dataTransfer.setData('head', JSON.stringify({name: head, address: this.info.address}));
            }
        },
        dropHead(e) {
            let data = e.dataTransfer.getData('head');
            if (data) {
                data = JSON.parse(data);
                data.household_id = this.info.household_id;

                axios.post('/api/v1/household-owners', data)
                    .then(res => {
                         this.$store.dispatch('Households/fetchRecord', this.info.household_id);
                    })
            }
        },
        pickupHeadEnded(e) {
            let ownersId = document.getElementById('owners');
            ownersId.classList.remove('drop-zone');
        }
    },
    components: {
        OwnerForm
    }
}

</script>

<style lang="scss" scoped>
.owner-wrapper {
    padding: 0.5rem;
    border-width: 1px;
    border-style: dashed;
    border-radius: 5px;
    border-color: transparent;
    transition: all 0.3s ease;

    > div:not(:last-of-type) {
        border-bottom: 1px dashed #e7e7e7;
        padding-bottom: 0.5rem;
        margin-bottom: 0.5rem;
    }

    &.drop-zone {
        background: repeating-linear-gradient(
            -45deg,
            transparent 0 4px,
            #e7e7e7 4px 6px
        );
        border-color: #adb5bd;
        border-width: 1px;
    }
}

.household-head {
    height: 39px;
}
.fs-08 {
    font-size: 0.8rem;
}
</style>
