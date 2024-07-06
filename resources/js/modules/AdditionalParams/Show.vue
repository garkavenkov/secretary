<template>
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span class="icon go-back-page" @click="$router.push({name: 'additional.params'})">                    
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <title>Повернутись по переліку категорій додаткових параметрів</title>                            
                                <path d="M6.5 10C7.3 10 8 9.3 8 8.5S7.3 7 6.5 7 5 7.7 5 8.5 5.7 10 6.5 10M9 6L16 13L11 18L4 11V6H9M9 4H4C2.9 4 2 4.9 2 6V11C2 11.6 2.2 12.1 2.6 12.4L9.6 19.4C9.9 19.8 10.4 20 11 20S12.1 19.8 12.4 19.4L17.4 14.4C17.8 14 18 13.5 18 13C18 12.4 17.8 11.9 17.4 11.6L10.4 4.6C10.1 4.2 9.6 4 9 4M13.5 5.7L14.5 4.7L21.4 11.6C21.8 12 22 12.5 22 13S21.8 14.1 21.4 14.4L16 19.8L15 18.8L20.7 13L13.5 5.7Z" />
                            </svg> -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <title>Повернутись по переліку категорій додаткових параметрів</title>                            
                                <path d="M4 3H18C19.11 3 20 3.9 20 5V12.08C18.45 11.82 16.92 12.18 15.68 13H12V17H13.08C12.97 17.68 12.97 18.35 13.08 19H4C2.9 19 2 18.11 2 17V5C2 3.9 2.9 3 4 3M4 7V11H10V7H4M12 7V11H18V7H12M4 13V17H10V13H4M18.44 15V17H22.44V19H18.44V21L15.44 18L18.44 15" />
                            </svg>
                        </span>                        

                        <span>Додаткові параметри категорії:
                            <span class="ms-2">"{{ category.name }}"</span>
                        </span>

                        <ButtonAdd @click="newParam" title="Додати параметр" class="btn-sm btn-primary p-2"/>
                        
                        <ButtonRefreshData 
                            @click="fetchAdditionalParams"
                            buttonClass="btn-outline-primary p-2 ms-2" />

                    </div>
                    <!-- <div class="d-flex"> -->

                        <!-- <ButtonRefreshData                                 
                                buttonClass="btn-outline-secondary btn-transparent me-2 p-2"
                                @click="fetchAdditionalParams" /> -->

                        <!-- <ButtonAdd 
                                buttonClass="btn btn-sm btn-outline-secondary btn-transparent p-2"
                                @click="newParam" 
                                title="Додати параметр" /> -->
                        
                    <!-- </div>                     -->
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered" v-if="category.params">
                        <thead class="table-secondary">
                            <tr>
                                <th>Код</th>
                                <th>Назва</th>
                                <th>Значення</th>
                                <th class="text-center" title="Системний параметр або параметр користувача">Тип</th>
                                <th class="actions text-center">Дії</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="param in category.params" :key="param.id">
                                <td>{{ param.code }}</td>
                                <td>{{ param.name }}</td>
                                <td>{{ param.value_type.name }}</td>
                                <td class="text-center">
                                    <span v-if="param.is_system" title="Системний параметр" >
                                        <SvgIcon                                    
                                            type="mdi" 
                                            :size="16"
                                            :path="pathSystemParamIcon" 
                                            class="text-danger" />
                                    </span>
                                    <span v-else title="Параметр користувача">
                                        <SvgIcon                                    
                                            type="mdi" 
                                            :path="pathUserParamIcon" 
                                            :size="16"
                                            class="text-primary"/>
                                    </span>                                    
                                </td>
                                <td class="actions">
                                    <!-- <IconButton 
                                        :mdiPath="pathWrenchCogIcon"
                                        title="Налаштування відображення параметру"
                                        :buttonClass="[param.conditions.length > 0 ? 'btn-secondary' : 'btn-outline-secondary btn-transparent', 'p-2']"
                                        @click="() => {}"
                                    /> -->
                                    <ButtonEdit 
                                            @click="editParam(param)"
                                            title="Редагувати параметр"
                                            buttonClass="btn-outline-warning btn-transparent p-2" />
                                            
                                    <!-- <IconButton 
                                        :mdiPath="pathWrenchCogIcon"
                                        title="Налаштування відображення параметру"
                                        :buttonClass="[param.conditions.length > 0 ? 'btn-secondary' : 'btn-outline-secondary btn-transparent', 'p-2']"
                                        @click="openConditions(param.id)"/> -->

                                    <ButtonDelete
                                            buttonClass="btn-outline-danger btn-transparent p-2"
                                            title="Видалити параметр"
                                            @click="deleteParam(param)"
                                            v-if="!param.is_system" />                                  
                                </td>
                                <td style="text-align: -webkit-center;">
                                    <IconButton 
                                        :mdiPath="pathWrenchCogIcon"
                                        title="Налаштування відображення параметру"
                                        :buttonClass="[param.conditions.length > 0 ? 'btn-outline-info' : 'btn-outline-secondary', 'btn-transparent p-2']"
                                        @click="openConditions(param.id)"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center text-muted p-3">                        
                        Параметри в даній категорії відсутні                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ParamForm
            :formData="paramData"            
            :action="action"
            :valueTypes="valueTypes"
            @refreshData="fetchAdditionalParams"/>

    <AdditionalParamConditions 
            :param="param"
            @refresh="fetchParam" />

</template>

<script>

import { Modal }                    from 'bootstrap';
import SvgIcon                      from '@jamescoyle/vue-icon';
import { 
    mdiCogOutline,
    mdiAccountOutline,
    mdiWrenchCog,
    mdiAccountTagOutline,
    mdiTagHidden,
    mdiLockOutline
} from '@mdi/js';
import { computed }                 from 'vue';

import ParamForm                    from './ParamForm.vue';
import AdditionalParamConditions    from './AdditionalParamConditions.vue';
import ButtonRefreshData            from '../../components/ui/Buttons/ButtonRefreshData.vue';
import IconButton                   from '../../components/ui/Buttons/IconButton.vue';

export default {
    name: 'AdditionalParamsCategory',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    components: {
        ParamForm,
        ButtonRefreshData,
        AdditionalParamConditions,
        SvgIcon,
        IconButton
    },
    data() {
        return {
            // params: [],
            category: {
                params: []
            },
            paramData: {
                category_id: this.id,
                code: '',
                name: '',
                value_type_id: 0,
                mask: '',
            },
            param: {},
            paramConditions: [],
            valueTypes: [],
            action: '',
            modalTitle: '',
            modalSubmitCaption: '',
            // pathSystemParamIcon: mdiTagHidden,
            pathSystemParamIcon: mdiLockOutline,
            pathUserParamIcon: mdiAccountTagOutline,
            pathWrenchCogIcon: mdiWrenchCog,            
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        fetchAdditionalParamValueTypes() {
            axios.get('/api/v1/additional-param-value-types')
                .then(res => {
                    this.valueTypes = res.data.data;
                });
        },
        fetchAdditionalParams() {
            let url = `/api/v1/additional-param-categories/${this.id}`;
            // axios.get(`/api/v1/additional-params?category_id=${this.id}`)
            axios.get(url)
                .then(res => {
                    // this.params = res.data.data;
                    this.category = res.data.data;
                });
        },
        fetchParam(param_id) {            
            axios.get(`/api/v1/additional-params/${param_id}`)
                .then(res => {
                    this.param = res.data.data;
                    this.fetchAdditionalParams();
                });
        },
        newParam() {
            this.modalTitle = 'Новий параметр';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';
            this.paramData.category_id = this.id;

            let paramForm = new Modal(document.getElementById('ParamForm'));
            paramForm.show();
        },
        editParam(param) {
            this.modalTitle = 'Редагування параметру';
            this.modalSubmitCaption = 'Зберегти';
            this.action = 'update';

            this.paramData.id = param.id;
            this.paramData.category_id = param.category_id;
            this.paramData.code = param.code;
            this.paramData.name = param.name;
            this.paramData.mask = param.mask;
            this.paramData.value_type_id = param.value_type_id;

            let paramForm = new Modal(document.getElementById('ParamForm'));
            paramForm.show();
        },
        deleteParam(param) {
            let msg = 'Видалення параметру може призвести до неочікуваних результатів в звітах.';
            this.$confirmDelete('Ви дійсно бажаєте видалити додатковий параметр', msg)
                .then(res => {
                    if (res.isConfirmed) {
                        axios.delete(`/api/v1/additional-params/${param.id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.fetchAdditionalParams(this.id);
                            });
                    }
                });
        },
        openConditions(param_id) {
            // console.log(param);
            // return;
            this.modalTitle = 'Налаштування відображення параметру';
            this.modalSubmitCaption = 'Зберегти';
            // this.action = 'update';
            // this.param = param;
            axios.get(`/api/v1/additional-params/${param_id}`)
                .then(res => {
                    this.param = res.data.data;
                    let conditionsForm = new Modal(document.getElementById('AdditionalParamConditions'));
                    conditionsForm.show();
                });

        }
    },  
    created() {
        this.fetchAdditionalParams(this.id);
        this.fetchAdditionalParamValueTypes();
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
    width: 100px; 
}

td.actions {
    display: flex;    
    justify-content: space-between;
    // & > div {
    //     flex: 1 0 0;
    //     text-align: center;
    // }
}

td.text-center {
    text-align: center;
    text-align: -webkit-center;
}

</style>