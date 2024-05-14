<template>

    <div class="row">
        <div class="col-md-10 mx-auto">
            <table class="table table-sm">
                <tbody>
                    <tr v-for="param in additionalParams" :key="param.id" class="align-middle">
                        <td>
                            <label :for="param.code" style="cursor: pointer;">
                                {{ param.name }}
                            </label>
                        </td>
                        <td>
                            <template v-if="param.value_type_code == 'boolean'">
                                <div class="form-check form-switch">
                                    <input  class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            :id="param.code"
                                            :disabled="!isInEditMode"
                                            v-model="param.value">
                                </div>
                            </template>
                            <template v-else>
                                <input  type="text"
                                        class="form-control form-control-sm"
                                        :id="param.code"
                                        :disabled="!isInEditMode"
                                        v-model="param.value">
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="row">
                <div class="d-flex justify-content-end">                 
                    <IconButton  v-if="!isInEditMode"
                            buttonClass="btn-outline-primary" 
                            title="Редагувати дані" 
                            @click="editData"                 
                            :mdiPath="pathMdiPencil">
                        Редагувати
                    </IconButton> 

                    <IconButton  v-if="isInEditMode"
                            buttonClass="btn-outline-secondary" 
                            title="Відмінити редагування" 
                            @click="cancelEdit"                 
                            :mdiPath="pathMdiPencilOff">
                        Відмінити
                    </IconButton>
           
                    <IconButton  v-if="isInEditMode"
                            buttonClass="btn-outline-primary ms-3" 
                            title="Встановити додаткові параметри"
                            @click="updateAdditionalParams"                 
                            :mdiPath="pathMdiCheckAll" 
                            :disabled="!additionalParamsWereChanged">
                        Встановити
                    </IconButton>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import {
    mdiPencil,
    mdiPencilOffOutline,
    mdiCheckAll
}   from '@mdi/js';

import IconButton   from '../../components/ui/Buttons/IconButton.vue';

export default {
    name: 'AdditionalParamsList',
    props: {
        'ownerId': {
            type: [String, Number],
            required: true
        },
        'owner': {
            type: String,
            required: true
        },
        'additionalParams': {
            type: Array,
            required: true
        },
        // 'resetForm': {
        //     type: Boolean,
        //     required: false,
        //     default: () => false
        // }
    },
    components: {
        IconButton
    },
    data() {
        return {
            _additionalParams: [],
            isInEditMode: false,
            pathMdiPencil: mdiPencil,
            pathMdiPencilOff: mdiPencilOffOutline,
            pathMdiCheckAll: mdiCheckAll,
        }
    },
    methods: {
        editData() {
            this.isInEditMode = true;
            this._additionalParams = JSON.parse(JSON.stringify(this.additionalParams));
        },
        cancelEdit() {
            this.isInEditMode = false;
            this._additionalParams = [];
            this.$emit('refreshData');
        },
        updateAdditionalParams() {
            var vm = this;
            let changed_params = this.additionalParams.filter(function(element, index) {
                // console.log(element.value, vm._additionalParams[index].value);
                return element.value !== vm._additionalParams[index].value;
            });

            if (changed_params.length > 0) {
                let additionalParamData = {};
                changed_params.forEach(p => {
                    additionalParamData[p.code] = p.value;
                });
                additionalParamData['owner'] = this.owner;
                additionalParamData['owner_id'] = this.ownerId;

                axios.post('/api/v1/set-additional-params', additionalParamData)
                    .then(res => {
                        this.$toast(res.data.message);
                        this.$emit('refreshData');
                        this.isInEditMode = false;
                        this._additionalParams = [];
                    });
             }
        },
    },
    computed: {
        additionalParamsWereChanged() {
            return JSON.stringify(this.additionalParams) !== JSON.stringify(this._additionalParams);
        }
    },
    watch: {
        // 'resetForm'(oldVal, newVal) {
        //     console.log(oldVal, newVal);
        //     if (newVal) {
        //         this.isInEditMode = false;
        //         this._additionalParams = [];
        //     }
        // }
    }
}

</script>
