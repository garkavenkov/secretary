<template>

    <ModalForm formId="HouseholdMemberInfo" @closeForm="closeForm" modalClass="modal-1200" :showFooter="false">

        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button :class="['nav-link', currentTab == 'MainInfo' ? 'active' : '']"
                                id="main-tab"
                                @click="currentTab = 'MainInfo'"
                                type="button">
                            <span class="mdi mdi-account-details-outline me-1"></span>
                            Головна інформація
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button :class="['nav-link', currentTab == 'LandYears' ? 'active' : '']"
                                id="main-tab"
                                @click="currentTab = 'LandYears'"
                                type="button">
                            <span class="mdi mdi-land-fields me-1"></span>
                            Земля
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button :class="['nav-link', currentTab == 'Movements' ? 'active' : '']"
                                id="movement-tab"
                                @click="currentTab = 'Movements'"
                                type="button">
                            <span class="mdi mdi-transit-transfer me-1"></span>
                            Реєстрація / Переміщення
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button :class="['nav-link', currentTab == 'AdditionalParams' ? 'active' : '']"
                                id="movement-tab"
                                @click="currentTab = 'AdditionalParams'"
                                type="button">
                                <span class="mdi mdi-tag-multiple me-1"></span>
                            Додаткова параметри
                        </button>
                    </li>
                </ul>
                <div class="tab-content p-3">
                    <KeepAlive>
                        <component  :is="currentTab"
                                    v-bind="componentProps"
                                    @refreshData="$emit('refreshData',formData.id)">
                        </component>
                    </KeepAlive>
                </div>

            </div>
        </div>

    </ModalForm>


</template>

<script>

import ModalForm        from '../../../components/ui/ModalForm.vue';

import MainInfo         from './Tabs/MainInfo.vue';
import LandYears        from './Tabs/LandYears.vue';
import Movements        from './Tabs/Movements.vue';
import AdditionalParams from './Tabs/AdditionalParams.vue'

export default {
    name: 'HouseholdMemberInfo',
    props: {
        'formData': {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            currentTab: 'MainInfo',
        }
    },
    methods: {

        closeForm() {},
        cancelEditInfo() {}

    },
    computed: {
        componentProps() {
            if (this.currentTab == 'MainInfo') {
                return {
                    formData: Object.assign({}, this.formData),
                }
            }
            if (this.currentTab == 'LandYears') {
                let member = {
                    id: this.formData.id,
                    surname: this.formData.surname,
                    name: this.formData.name,
                    patronymic: this.formData.patronymic,
                }
                return {
                    member: member,
                    years: this.formData.land,
                }
            }
            if (this.currentTab == 'Movements') {
                return {
                    member_id: this.formData.id,
                    movements: this.formData.movements,
                }
            }
            if (this.currentTab == 'AdditionalParams') {
                return {
                    member_id: this.formData.id,
                    additionalParams: this.formData.additional_params,
                }
            }
        },
    },
    components: {
        ModalForm,
        MainInfo,
        LandYears,
        Movements,
        AdditionalParams
    }
}
</script>


<style lang="scss" scoped>
.tab-content {
    min-height: 530px;
}
</style>
