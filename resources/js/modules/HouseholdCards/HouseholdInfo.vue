<script>
import { Modal } from 'bootstrap'

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
            formData: {
                ownerName: '',
                ownerAddress: ''
            },
            modalTitle: '',
            modalSubmitCaption: ''
        }
    },
    methods: {
        newOwner(e) {
            var myModal = new Modal(document.getElementById('HouseholdOwnerModalForm'))
            this.modalTitle = 'Додати власника домогосподарства';
            this.modalSubmitCaption = 'Додати';
            myModal.show();
        },
        clearFormData() {
            this.formData.ownerName = '';
            this.formData.ownerAddress = '';
        },
        submitData() {
            let data = {
                // owner_id: household_id,
                value: `${this.formData.ownerName}|${this.formData.ownerAddress}`
            }

            axios.post("/api/v1/add-household-owner", data)
                .then(res => {
                    console.log(res);
                })
        }
    }
}

</script>

<template>
    <div class="p-4">
        <div class="row mb-3">
            <div class="col">
                <div class="fw-bold">Адреса</div>
                <div v-if="info.address">
                    {{ info.address }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="fw-bold">Тип</div>
                <div v-if="info.household_type">
                    {{ info.household_type.name}}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div>
                    <span class="fw-bold">Власник(и)</span>
                    <button class="btn btn-sm btn-outline-secondary ms-3" @click="newOwner">
                        <span class="mdi mdi-plus"></span>
                    </button>
                </div>
                <div class="owners-wrapper">
                    <template v-if="info.owners && (info.owners.length > 0)">
                        <div class="owner" v-for="owner in info.owners" :key="owner.id">
                            <span>{{ owner.name }}</span>
                            <span>{{ owner.address }}</span>
                        </div>
                    </template>
                    <template v-else>
                        Інформація відсутня
                    </template>
                </div>
            </div>
        </div>
        <div class="row mb-3">
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
        </div>
    </div>

    <div class="modal fade" id="HouseholdOwnerModalForm" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel" v-html="modalTitle"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="clearFormData"></button>
                </div>
                <div class="modal-body">

                    <div class="row mb-3">
                        <div class="col">
                            <label  for="ownerName" class="form-label">Прізвище І.Б.</label>
                            <input  type="text"
                                    class="form-control"
                                    id="ownerName"
                                    v-model="formData.ownerName" >
                            <!-- <div id="memberSurnameValidation" class="invalid-feedback">
                                {{ getError('surname') }}
                            </div> -->
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label  for="memberName" class="form-label">Адреса</label>
                            <input  type="text"
                                    class="form-control"
                                    id="ownerAddress"
                                    v-model="formData.ownerAddress">
                            <!-- <div id="memberNameValidation" class="invalid-feedback">
                                {{ getError('name') }}
                            </div> -->
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <!-- <div>
                        <button type="button" class="btn btn-outline-danger" @click="deleteMember(formData.id)">Видалити</button>
                    </div> -->
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="clearFormData">Відмінити</button>
                        <button type="button" class="btn btn-primary" @click="submitData">{{modalSubmitCaption}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
