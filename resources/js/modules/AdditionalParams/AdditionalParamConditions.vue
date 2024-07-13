<template>

    <ModalForm formId="AdditionalParamConditions" @submitData="() => {}" @closeForm="closeForm" modalClass="modal-lg" :showFooter="false">
        <div class="row mb-3">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center lh-34">
                    <div>
                        Парметр: <span class="fw-semibold">{{ param.name }}</span>
                    </div>
                    <div>
                        <ButtonAdd
                                v-if="action == ''"
                                @click="action = 'create'"
                                title="Додати умову"
                                :buttonClass="['btn-primary px-2 py-1', (action != '') ? 'disabled' : '']">
                            Додати
                        </ButtonAdd>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 mx-0 py-2 border rounded" v-if="action != ''">
            <div class="col">                
                <select :class="['form-control', hasError('attribute_id') ? 'is-invalid' : '']"
                        id="conditionAttributeId"
                        v-model="formData.attribute_id">
                    <option disabled value="0">Оберіть атрибут</option>
                    <option :value="attribute.id" v-for="attribute in attributes" :key="attribute.id">
                        {{attribute.name}}
                    </option>
                </select>
                <div id="conditionAttributeIdValidation" class="invalid-feedback">
                    {{ getError('attribute_id') }}
                </div>
            </div>
            <div class="col">                
                <select :class="['form-control', hasError('condition') ? 'is-invalid' : '']"
                        id="conditionCondition"
                        v-model="formData.condition">
                    <option disabled :value="null">Оберіть умову</option>
                    <option :value="attributeCondition" v-for="(attributeCondition,index) in attributeConditions" :key="index">
                        {{attributeCondition}}
                    </option>
                </select>
                <div id="conditionConditionValidation" class="invalid-feedback">
                    {{ getError('condition') }}
                </div>
            </div>
            <div class="col">                
                <select v-if="attributeValues.length > 0"
                        :class="['form-control', hasError('value') ? 'is-invalid' : '']"
                        id="conditionValue"
                        v-model="formData.value">
                    <option disabled :value="null">Оберіть значеня</option>
                    <option :value="attributeValue" v-for="(attributeValue,index) in attributeValues" :key="index">
                        {{attributeValue}}
                    </option>
                </select>
                <input  v-else                
                        type="text"
                        :class="['form-control', hasError('value') ? 'is-invalid' : '']"
                        id="conditionValue"
                        autocomplete="false"
                        placeholder="Заповніть значення"
                        v-model="formData.value">
                <div id="conditionValueValidation" class="invalid-feedback">
                    {{ getError('value') }}
                </div>
            </div>
            <div class="col" style="align-self: start;">
                <div class="d-flex justify-content-end">
                    <IconButton
                            @click="saveCondition"
                            :mdiPath="pathCheck"
                            size="20"
                            :title="saveConditionTitle"
                            buttonClass="btn-outline-primary btn-transparent p-2" />
                                    
                    <IconButton
                            @click="cancelInsertMode"
                            :mdiPath="pathCancel"
                            size="20"
                            title="Відмінити"
                            buttonClass="btn-outline-danger btn-transparent ms-3 p-2" />
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="col">
                <table class="table table-sm table-bordered mb-5" v-if="(Object.hasOwn(param, 'conditions') && param.conditions.length > 0)">                
                    <thead class="table-secondary">
                        <tr>
                            <th style="width: 40%;">Атрибут</th>
                            <th style="width: 30%;">Умова</th>
                            <th style="width: 30%;">Значення</th>
                            <th class="actions">                              
                            </th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr v-for="condition in param.conditions" :key="condition.id">
                            <td>{{ condition.attribute.name }}</td>
                            <td>{{ condition.condition }}</td>
                            <td>{{ condition.value }}</td>                        
                            <td class="actions">                                    
                                <ButtonEdit 
                                        @click="editCondition(condition)"
                                        :disabled="action != ''"
                                        title="Редагувати умову"
                                        buttonClass="btn-outline-warning btn-transparent p-2" />
        
                                <ButtonDelete
                                        buttonClass="btn-outline-danger btn-transparent p-2"
                                        title="Видалити умову"
                                        :disabled="action != ''"
                                        @click="deleteCondition(condition)" />
                            </td>                                
                        </tr>                    
                    </tbody>
                </table>
                <div v-else class="d-flex justify-content-center p-4 border rounded text-muted mb-3">
                    Параметр відображается без жодних умов
                </div>                
            </div>
        </div>
    </ModalForm>
</template>

<script>

import { 
    // mdiWrenchCheckOutline,
    mdiCheck,
    mdiCancel
} from '@mdi/js';

import ModalForm        from "../../components/ui/ModalForm.vue"
import IconButton       from '../../components/ui/Buttons/IconButton.vue';

import SubmitData       from '../../mixins/SubmitData';
import FormValidator    from "../../mixins/FormValidator";

export default {
    name: 'AdditionalParamConditions',
    mixins: [SubmitData, FormValidator],
    props: {        
        'param': {
            type: Object,
            required: true
        }
    },
    components: {
        ModalForm,
        IconButton
    },
    emits: ['refresh'],
    data() {
        return {            
            // pathWrenchCheckOutline: mdiWrenchCheckOutline ,
            pathCheck: mdiCheck,
            pathCancel: mdiCancel,
            insertMode: false,
            editMode: false,
            action: '',

            formData: {         
                id:null,   
                attribute_id: 0,
                condition: null,
                value: null
            },
            attributes: [],                        
            attributeValues: [],
            attributeConditions: [],
        }
    },
    methods: {
        // submitData() {},
        closeForm() {
            this.param_id = null;
            this.resetForm();
          
            this.attributeValues = [];
            this.attributeConditions = [];

            this.action = '';
            // this.insertMode = false;
            // this.editMode = false;
        },
        cancelInsertMode() {
            // this.insertMode = false;
            // this.editMode = false;
            this.action = '';
            this.resetForm();
        },
        saveCondition() {
            let data = {}
            Object.assign(data, this.formData);
            data.param_id = this.param.id;
            
            if (this.action == 'create') {
                axios.post('/api/v1/additional-param-conditions', data)
                    .then(res => {
                        if(res.status == 201) {
                            this.$emit('refresh', this.param.id);
                            this.$toast(res.data.message);
                            this.resetForm();
                        }
                    })
                    .catch(err => {
                        this.errors = err.response?.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/additional-param-conditions/${this.formData.id}`, data)
                    .then(res => {
                        if (res.status == 200) {
                            this.$emit('refresh', this.param.id);
                            this.$toast(res.data.message);                            
                        }
                    })
                    .catch(err => {
                        this.errors = err.response?.data.errors;
                    })
            }

        },
        resetForm() {
            this.formData.attribute_id = 0;
            this.formData.condition = null;
            this.formData.value = null;
        },
        editCondition(cond) {            
            this.formData.id = cond.id;
            this.formData.attribute_id = cond.attribute_id;
            this.formData.condition = cond.condition;
            this.formData.value = cond.value;
            
            this.action = 'update';            
        },
        deleteCondition(condition) {
            let msg = 'Видалення параметру може призвести до неочікуваних результатів в звітах.'
            this.$confirmDelete('Ви дійсно бажаєте видалити умови відображення параметру', msg)
                .then(res => {
                    if (res.isConfirmed) {
                        axios.delete(`/api/v1/additional-param-conditions/${condition.id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.$emit('refresh', condition.param_id);                                
                            })
                    }
                })
        },       
        fetchModelAttributes() {
            axios.get(`/api/v1/model-attributes?model=App\\Models\\HouseholdMember`)
                .then(res => {
                    this.attributes = res.data.data;
                })
        }        
    },
    computed: {
        saveConditionTitle() {
            if (this.action == 'create') {
                return 'Додати умову';
            }
            if (this.action == 'update') {
                return 'Змінити умову';
            }            
        }
    },
    watch: {
        'formData.attribute_id'(newVal) {         
            let attribute = this.attributes.find(a => a.id == newVal);            
            if (attribute) {
                if (attribute.availableValues != '') {           
                    this.attributeValues = attribute.availableValues.split(',');
                } else {
                    this.attributeValues = [];
                }                
                if (attribute.conditions != '' ) {                
                    this.attributeConditions = attribute.conditions.split(',');
                } else {
                    this.attributeConditions = [];
                }                
            }
        }
    },
    created() {
        this.fetchModelAttributes();        
    }

}

</script>

<style lang="scss" scoped>
tr {
    vertical-align: middle;
    // &.selected {
    //     background: #d8d9db38;
    // }
}


th.actions {
    min-width: 100px !important ;
}

td.actions {
    display: flex;    
    justify-content: space-between;
    width: 100px !important;
    // & > div {
    //     flex: 1 0 0;
    //     text-align: center;
    // }
}

</style>