<template>    

    <div class="row">
        
        <div class="col-md-10 mx-auto">
            
        
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">

                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <title>Повернутись по переліку категорій додаткових параметрів</title>                            
                                <path d="M6.5 10C7.3 10 8 9.3 8 8.5S7.3 7 6.5 7 5 7.7 5 8.5 5.7 10 6.5 10M9 6L16 13L11 18L4 11V6H9M9 4H4C2.9 4 2 4.9 2 6V11C2 11.6 2.2 12.1 2.6 12.4L9.6 19.4C9.9 19.8 10.4 20 11 20S12.1 19.8 12.4 19.4L17.4 14.4C17.8 14 18 13.5 18 13C18 12.4 17.8 11.9 17.4 11.6L10.4 4.6C10.1 4.2 9.6 4 9 4M13.5 5.7L14.5 4.7L21.4 11.6C21.8 12 22 12.5 22 13S21.8 14.1 21.4 14.4L16 19.8L15 18.8L20.7 13L13.5 5.7Z" />
                            </svg>                           
                        </span>   

                        <span>Категорії додаткових параметрів</span>

                        <ButtonAdd 
                                @click="newCategory" 
                                title="Додати параметр" class="btn-sm btn-primary p-2"/>
                        
                        <ButtonRefreshData 
                                @click="fetchAdditionalParamCategories"
                                buttonClass="btn-outline-primary p-2 ms-2" />

                        <!-- <ButtonAdd 
                                buttonClass="btn-outline-secondary btn-transparent p-2" 
                                @click="newCategory" 
                                title="Додати категорію" /> -->
    
                        <!-- <ButtonRefreshData 
                                buttonClass="btn-outline-secondary btn-transparent ms-2 p-2"
                                @click="fetchAdditionalParamCategories" />                   -->
                    </div>                    
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>Модель</th>
                                <th>Назва</th>
                                <th class="actions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories" :key="category.id">
                                <td>
                                    <router-link :to="{name: 'additional.params.show' , params: {id: category.id}}">
                                        {{ category.code }}
                                    </router-link>
                                    <!-- <a @click="getCategoryParams(category)" style="cursor:pointer;">
                                        {{ category.code }}
                                    </a> -->
                                </td>
                                <td>{{ category.name }}</td>
                                <td class="actions">
                                    <ButtonEdit 
                                            @click="editCategory(category)" 
                                            title="Редагувати категорію"
                                            buttonClass="btn-outline-warning btn-transparent p-2" />
                                    <ButtonDelete
                                            buttonClass="btn-outline-danger btn-transparent ms-3 p-2"
                                            title="Видалити категорію"
                                            @click="() => {}" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Additional Params -->
        <!-- 
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Додаткові параметри{{ selectedCategoryName }}</span>
                    </div>
                    <div class="d-flex">

                        <ButtonRefreshData 
                                :disabled="selectedCategoryName == ''"
                                buttonClass="btn-outline-secondary btn-transparent me-2 p-2"
                                @click="fetchAdditionalParams(selectedCategory.id)" />

                        <ButtonAdd 
                                v-if="selectedCategoryName !== ''"
                                buttonClass="btn btn-sm btn-outline-secondary btn-transparent p-2"
                                @click="newParam" title="Додати параметр" />
                        
                    </div>                    
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered" v-if="params.length > 0">
                        <thead class="table-secondary">
                            <tr>
                                <th>Код</th>
                                <th>Назва</th>
                                <th>Значення</th>
                                <th class="text-center" title="Системний параметр або параметр користувача">Тип</th>
                                <th class="actions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="param in params" :key="param.id">
                                <td>{{ param.code }}</td>
                                <td>{{ param.name }}</td>
                                <td>{{ param.value_type.name }}</td>
                                <td class="text-center">
                                    <span v-if="param.is_system" title="Системний параметр" >
                                        <SvgIcon                                    
                                            type="mdi" 
                                            :size="16"
                                            :path="pathSystemParamIcon" 
                                            class="mdi mdi-cog-outline text-danger" />
                                    </span>
                                    <span v-else title="Параментр користувача">
                                        <SvgIcon                                    
                                            type="mdi" 
                                            :path="pathUserParamIcon" 
                                            :size="16"
                                            class="mdi mdi-account-outline text-primary"/>
                                    </span>                                    
                                </td>
                                <td class="actions">
                                    <ButtonEdit 
                                            @click="editParam(param)"
                                            title="Редагувати параметр"
                                            buttonClass="btn-outline-warning btn-transparent p-2" />

                                    <ButtonDelete
                                            buttonClass="btn-outline-danger btn-transparent ms-3 p-2"
                                            title="Видалити параметр"
                                            @click="deleteParam(param)"
                                            v-if="!param.is_system" />                                  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-else class="text-center text-muted p-3">
                        <template v-if="selectedCategory.id">
                            Параметри в даній категорії відсутні
                        </template>
                        <template v-else>
                            Оберіть категорію для відображення параметрів
                        </template>
                    </div>
                </div>
            </div>
        </div>
        -->
    </div>
    <CategoryForm
            :formData="categoryData"
            :action="action"
            @refreshData="fetchAdditionalParamCategories"/>

    <!-- <ParamForm
            :formData="paramData"
            :category="selectedCategory"
            :action="action"
            :valueTypes="valueTypes"
            @refreshData="fetchAdditionalParams(paramData.category_id)"/> -->

</template>

<script>

import { Modal }            from 'bootstrap';
import { computed }         from 'vue';
import SvgIcon              from '@jamescoyle/vue-icon';
import { 
    mdiCogOutline,
    mdiAccountOutline
} from '@mdi/js';

import CategoryForm         from './CategoryForm.vue';
import ParamForm            from './ParamForm.vue';

import ButtonRefreshData    from '../../components/ui/Buttons/ButtonRefreshData.vue';

export default {
    name: 'AdditionalParams',
    data() {
        return {
            categories: [],
            // params: [],
            valueTypes: [],
            categoryData: {
                code: '',
                name: ''
            },
            // selectedCategory: {},
            paramData: {
                category_id: null,
                code: '',
                name: '',
                value_type_id: 0,
                mask: '',
            },
            action: '',
            modalTitle: '',
            modalSubmitCaption: '',
            pathSystemParamIcon: mdiCogOutline,
            pathUserParamIcon: mdiAccountOutline
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        fetchAdditionalParamCategories() {
            axios.get('/api/v1/additional-param-categories')
                .then(res => {
                    this.categories = res.data.data;
                })
        },
        // fetchAdditionalParams(categoryId) {
        //     axios.get(`/api/v1/additional-params?category_id=${categoryId}`)
        //         .then(res => {
        //             this.params = res.data.data;
        //         })
        // },
        // fetchAdditionalParamValueTypes() {
        //     axios.get('/api/v1/additional-param-value-types')
        //         .then(res => {
        //             this.valueTypes = res.data.data;
        //         })
        // },
        // getCategoryParams(category) {
        //     this.selectedCategory = category;
        //     this.paramData.category_id = category.id;
        //     this.fetchAdditionalParams(category.id);
        // },
        newCategory() {
            this.modalTitle = 'Нова категорія';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            let categoryForm = new Modal(document.getElementById('CategoryForm'));
            categoryForm.show();
        },
        // newParam() {
        //     this.modalTitle = 'Новий параметр';
        //     this.modalSubmitCaption = 'Додати';
        //     this.action = 'create';
        //     this.paramData.category_id  = this.selectedCategory.id;

        //     let paramForm = new Modal(document.getElementById('ParamForm'));
        //     paramForm.show();
        // },
        editCategory(category) {
            this.modalTitle = 'Редагування категорії';
            this.modalSubmitCaption = 'Зберегти';
            this.action = 'update';

            this.categoryData.id    = category.id
            this.categoryData.code  = category.code;
            this.categoryData.name  = category.name;

            let categoryForm = new Modal(document.getElementById('CategoryForm'));
            categoryForm.show();
        },
        // editParam(param) {
        //     this.modalTitle = 'Редагування параметру';
        //     this.modalSubmitCaption = 'Зберегти';
        //     this.action = 'update';

        //     this.paramData.id               = param.id
        //     this.paramData.category_id      = param.category_id
        //     this.paramData.code             = param.code;
        //     this.paramData.name             = param.name;
        //     this.paramData.mask             = param.mask;
        //     this.paramData.value_type_id    = param.value_type_id;

        //     let paramForm = new Modal(document.getElementById('ParamForm'));
        //     paramForm.show();
        // },
        // deleteParam(param) {
        //     let msg = 'Видалення параметру може призвести до неочікуваних результатів в звітах.'
        //     this.$confirmDelete('Ви дійсно бажаєте видалити додатковий параметр', msg)
        //         .then(res => {
        //             if (res.isConfirmed) {
        //                 axios.delete(`/api/v1/additional-params/${param.id}`)
        //                     .then(res => {
        //                         this.$toast(res.data.message);
        //                         this.fetchAdditionalParams(param.category_id);
        //                     })
        //             }
        //         })
        // }
    },
    computed: {
        // selectedCategoryName() {
        //     return this.selectedCategory?.name ? `. Категорія: "${this.selectedCategory.name}"` : ''
        // }
    },
    components: {
        CategoryForm,
        ParamForm,
        ButtonRefreshData,
        SvgIcon
    },
    created() {
        this.fetchAdditionalParamCategories();
        // this.fetchAdditionalParamValueTypes()
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

    // & > div {
    //     flex: 1 0 0;
    //     text-align: center;
    // }
}
</style>
