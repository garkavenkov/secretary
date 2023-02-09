<template>
    <breadcrumbs />

    <div class="row">
        <!-- Additional Param Categories -->
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Категорії додаткових параметрів</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary btn-transparent me-2"
                                @click="fetchAdditionalParamCategories"
                                title="Оновити дані">
                            <span class="mdi mdi-refresh"></span>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                @click="newCategory"
                                title="Додати категорію">
                            <span class="mdi mdi-plus-thick"></span>
                        </button>
                    </div>
                    <!-- <h5>Категорії додаткових параметрів</h5>
                    <button class="btn btn-sm btn-outline-secondary btn-transparent"
                            @click="newCategory"
                            title="Додати категорію">
                        <span class="mdi mdi-plus-thick"></span>
                    </button> -->
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th>Модель</th>
                                <th>Назва</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in categories" :key="category.id" :class="{'selected' : selectedCategory.id == category.id}">
                                <td>
                                    <a @click="getCategoryParams(category)" style="cursor:pointer;">
                                        {{ category.code }}
                                    </a>
                                </td>
                                <td>{{ category.name }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-warning btn-transparent"
                                            title="Редагувати категорію"
                                            @click="editCategory(category)">
                                        <span class="mdi mdi-pencil"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Additional Params -->
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="dictionary-name__wrapper">
                        <span>Додаткові параметри{{ selectedCategoryName }}</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary btn-transparent me-2"
                                    @click="fetchAdditionalParams(selectedCategory.id)"
                                    title="Оновити дані"
                                    v-if="selectedCategoryName !== ''">
                                <span class="mdi mdi-refresh"></span>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                @click="newParam"
                                title="Додати параметр"
                                v-if="selectedCategoryName !== ''">
                            <span class="mdi mdi-plus-thick"></span>
                        </button>
                    </div>
                    <!-- <h5>Додаткові параметри{{ selectedCategoryName }}</h5>
                    <button class="btn btn-sm btn-outline-secondary btn-transparent"
                            @click="newParam"
                            title="Додати параметр"
                            v-if="selectedCategoryName !== ''">
                        <span class="mdi mdi-plus-thick"></span>
                    </button> -->
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered" v-if="params.length > 0">
                        <thead class="table-secondary">
                            <tr>
                                <th>Код</th>
                                <th>Назва</th>
                                <th>Значення</th>
                                <th class="text-center" title="Системний параметр або параметр користувача">Тип</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="param in params" :key="param.id">
                                <td>{{ param.code }}</td>
                                <td>{{ param.name }}</td>
                                <td>{{ param.value_type.name }}</td>
                                <td class="text-center">
                                    <span class="mdi mdi-cog-outline text-danger" v-if="param.is_system" title="Системний параметр"></span>
                                    <span class="mdi mdi-account-outline text-primary" v-else title="Параментр користувача"></span>
                                </td>
                                <td class="actions">
                                    <div>
                                        <button class="btn btn-sm btn-outline-warning btn-transparent"
                                                title="Редагувати параметр"
                                                @click="editParam(param)">
                                            <span class="mdi mdi-pencil"></span>
                                        </button>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-danger btn-transparent"
                                                title="Видалити параметр"
                                                @click="deleteParam(param)"
                                                v-if="!param.is_system">
                                            <span class="mdi mdi-trash-can"></span>
                                        </button>
                                    </div>
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
    </div>

    <CategoryForm
            :formData="categoryData"
            :action="action"
            @refreshData="fetchAdditionalParamCategories"/>

    <ParamForm
            :formData="paramData"
            :category="selectedCategory"
            :action="action"
            :valueTypes="valueTypes"
            @refreshData="fetchAdditionalParams(paramData.category_id)"/>

</template>

<script>

import { Modal }        from 'bootstrap';
import { computed }     from 'vue';

import CategoryForm     from './CategoryForm.vue';
import ParamForm        from './ParamForm.vue';

export default {
    name: 'AdditionalParams',
    data() {
        return {
            categories: [],
            params: [],
            valueTypes: [],
            categoryData: {
                code: '',
                name: ''
            },
            selectedCategory: {},
            paramData: {
                category_id: null,
                code: '',
                name: '',
                value_type_id: 0,
            },
            action: '',
            modalTitle: '',
            modalSubmitCaption: ''
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
        fetchAdditionalParams(categoryId) {
            axios.get(`/api/v1/additional-params?category_id=${categoryId}`)
                .then(res => {
                    this.params = res.data.data;
                })
        },
        fetchAdditionalParamValueTypes() {
            axios.get('/api/v1/additional-param-value-types')
                .then(res => {
                    this.valueTypes = res.data.data;
                })
        },
        getCategoryParams(category) {
            this.selectedCategory = category;
            this.paramData.category_id = category.id;
            this.fetchAdditionalParams(category.id);
        },
        newCategory() {
            this.modalTitle = 'Нова категорія';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';

            let categoryForm = new Modal(document.getElementById('CategoryForm'));
            categoryForm.show();
        },
        newParam() {
            this.modalTitle = 'Новий параметр';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';
            this.paramData.category_id  = this.selectedCategory.id;

            let paramForm = new Modal(document.getElementById('ParamForm'));
            paramForm.show();
        },
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
        editParam(param) {
            this.modalTitle = 'Редагування параметру';
            this.modalSubmitCaption = 'Зберегти';
            this.action = 'update';

            this.paramData.id               = param.id
            this.paramData.category_id      = param.category_id
            this.paramData.code             = param.code;
            this.paramData.name             = param.name;
            this.paramData.value_type_id    = param.value_type_id;

            let paramForm = new Modal(document.getElementById('ParamForm'));
            paramForm.show();
        },
        deleteParam(param) {
            let msg = 'Видалення параметру може призвести до неочікуваних результатів в звітах.'
            this.$confirmDelete('Ви дійсно бажаєте видалити додатковий параметр', msg)
                .then(res => {
                    if (res.isConfirmed) {
                        axios.delete(`/api/v1/additional-params/${param.id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.fetchAdditionalParams(param.category_id);
                            })
                    }
                })
        }
    },
    computed: {
        selectedCategoryName() {
            return this.selectedCategory?.name ? `. Категорія: "${this.selectedCategory.name}"` : ''
        }
    },
    components: {
        CategoryForm,
        ParamForm
    },
    created() {
        this.fetchAdditionalParamCategories();
        this.fetchAdditionalParamValueTypes()
    }
}

</script>

<style lang="scss" scoped>
tr {
    vertical-align: middle;
    &.selected {
        background: #d8d9db38;
    }
}

.actions {
    display: flex;

    & > div {
        flex: 1 0 0;
        text-align: center;
    }
}
</style>
