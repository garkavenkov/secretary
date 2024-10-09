<template>
    <div class="data-table--wrapper">
        <div class="data-table_  d-flex justify-content-between pb-2 align-items-center" v-if="showActionsPanel">
            <div class="per-page__wrapper" >
                <span>Відображати</span>
                <select name="per_Page"
                        id="per_page"
                        class="per-page"
                        :disabled="paginatedData.length == 0"
                        @change="changePerPage($event.target.value)">
                    <option v-for="(value, index) in perPageItems"
                            :key="index"
                            :value="value">
                        {{value}}
                    </option>
                </select>
            </div>
            <div v-if="sortedByLength > 0">                
                <button class="btn btn-sm btn-outline-secondary btn-transparent" @click="cancelSort">Відмінити сортуваня</button>
            </div>
            <div class="search__wrapper">
                <form autocomplete="off" @submit.prevent>
                    <label  for="search">Пошук</label>                    
                    <input  type="search"
                            id="search"
                            class="search"
                            autocomplete="off"
                            v-model="searchData">
                </form>
            </div>
        </div>
        <div class="table__wrapper">
            <div class="table-responsive">
                <table class="table" :class="tableClass">
                    <thead :class="tableHeaderClass">
                        <slot name="header">
                            <tr v-if="dataFields.length > 0">
                                <th v-for="field in dataFields"
                                    :key="field.name"
                                    :class="field.class"
                                    :data-sort-field="field.sortable ? field.name : ''"
                                    :data-field-type="field.dataType">
                                        {{ field.caption }}
                                </th>
                            </tr>
                        </slot>
                    </thead>
                    <tbody>
                        <slot v-bind:paginatedData="paginatedData"></slot>
                    </tbody>
                    <tfoot>
                        <slot name="footer"></slot>
                    </tfoot>
                </table>
            </div>
        </div>
        <div    class="data-table__pagination--wrapper d-flex justify-content-between align-items-center py-2"
                v-if="(paginatedData.length > 0) && showPaginationPanel">
            <div>Відображено з {{shownFrom}} по {{shownTo}} із {{shownTotal}}</div>
            <ul class="pagination mb-0">
                <template v-if="externalPagination?.links">
                    <li class="page-item" v-for="(link,index) in externalPagination.links" :key="index">
                        <a  class='page-link'
                            :class="[link.active ? 'active' : '', link.url  ? '' : 'disabled' ]"
                            v-html="link.label"
                            @click="changePage(link.url)">
                        </a>
                    </li>
                </template>
                <template v-else>
                    <li class="page-item" :class="{'disabled': isFirstPage}">
                        <a class="page-link" @click="prevPage" >
                            Previous
                        </a>
                    </li>
                    <li class="page-item"
                        v-bind:class="[(currentPage == page) ? 'active' : '']"
                        v-for="page in pagesCount" :key="page">
                            <a class="page-link" @click="changePage(page)">{{page}}</a>
                    </li>
                    <li class="page-item" :class="{'disabled': isLastPage}">
                        <a class="page-link" @click="nextPage">
                            Next
                        </a>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    name: 'DataTable',
    props: {
        'perPageItems': {
            type: Array,
            required: false,
            default() {
                return [
                    10,
                    20,
                    50
                ];
            }
        },     
        'dataTable': {
            type: Array
        },
        'dataFields': {
            type: Array,
            required: false,
        },
        'tableHeaderClass': {
            type: String,
            required: false
        },
        'tableClass': {
            type: String,
            required: false
        },
        'searchable': {
            type: String,
            required: false,
            default: ''
        },
        'showActionsPanel': {
            type: Boolean,
            required: false,
            default: () => true
        },
        'showPaginationPanel': {
            type: Boolean,
            required: false,
            default: () => true
        },
        'externalPagination': {
            type: Object,
            required: false,
            // default: () => {}
        },
        'searchableFields': {
            type: Array,
            required: false,
        },
        'sortByDefaultField': {
            type: String,
            required: false,
            default: ''
        },
        'sortedByFields': {
            type: Object,
            required: false,
            default: () => {}
        }
    },
    data() {
        return {
            currentPage: 1,
            perPage: this.perPageItems[0],
            searchData: '',
            sortedBy: {},
            fieldsType: {},
            sortedByLength: 0,
            dataShouldBeSorted: false
        }
    },
    emits: ['pageChanged', 'perPageChanged', 'sortedBy'],
    methods: {
        changePerPage(value) {
            if (this.externalPagination?.per_page) {
                // let url = `${this.pagination.path}/?per_page=${value}`;
                this.$emit('perPageChanged', value);
            } else {
                // this.perPage = value === "all" ? value :  parseInt(value);
                this.perPage = parseInt(value);
                this.currentPage = 1;
            }
        },
        nextPage() {
            this.currentPage ++;
        },
        prevPage() {
            this.currentPage --;
        },
        changePage(page) {
            if (this.externalPagination?.current_page) {
                this.$emit('pageChanged', page)
            }
            this.currentPage = page;
        },
        sortDataByField(e) {
            let field = e.target.dataset.sortField;
            let sort = e.target.dataset.sortOrder;

            // If mouse click without Ctrl - reset all sort fields
            if (!e.ctrlKey) {
                this.clearDataSortAttributes();                
            }
            
            if (sort == 'descending') {
                // If sort order is already descendig - exclude field from sort
                this.clearFieldSortAttributes(e.target);
                delete(this.sortedBy[field]);

                // Recalculate fields sort order, e.g: 1,2,etc.
                let fields = document.querySelectorAll('[data-sort-position]');                
                fields.forEach(f => {
                    let position = f.dataset.sortPosition;
                    f.dataset.sortPosition = position > 1 ? position - 1 : 1;
                });

            } else {
                if (sort == undefined) {
                    sort = 'ascending'
                } else {
                    e.target.classList.remove('ascending')
                    sort = 'descending'
                }
                e.target.dataset.sortOrder = sort;
                e.target.classList.add(sort)
                this.sortedBy[field] = sort;
            }

            // Adjusting field's sort index. Start from 1 instead of 0;
            let fieldSortPosition = Object.keys(this.sortedBy).indexOf(field);
            if ( fieldSortPosition >= 0 ) {
                e.target.dataset.sortPosition = fieldSortPosition + 1;
            }

            this.$emit('sortedBy', this.sortedBy);
        },
        sortDataHandler(sortedBy, sortableFields) {
            return function(a, b) {
                let compareResult = [];
                Object.keys(sortedBy).forEach(function(field) {

                    let sortOrder = sortedBy[field].toLowerCase();
                    let dataType = sortableFields[field];                    

                    if (dataType == 'string') {

                        compareResult.push( 
                            sortOrder == 'ascending'
                            ? (a[field].localeCompare(b[field]))
                            : (b[field].localeCompare(a[field]))
                        );

                    } else if (dataType == 'number') {

                        compareResult.push( 
                            sortOrder == 'ascending'
                            ? (a[field] - b[field]) 
                            : (b[field] - a[field]) 
                        );

                    } else if (dataType == 'date') {

                        let date_1 = new Date(a[field].replace(/(\d+).(\d+).(\d+)/, '$3/$2/$1'));
                        let date_2 = new Date(b[field].replace(/(\d+).(\d+).(\d+)/, '$3/$2/$1'));

                        compareResult.push( 
                            sortOrder == 'ascending'
                            ? (date_1 - date_2) 
                            : (date_2 - date_1) 
                        );
                        
                    } else {
                        return;
                    }

                  
                });
                
                return compareResult.reduce((res, next) => res || next);
            }
        },
        // Reset sort. Clear sort attributes on sortable fields
        clearDataSortAttributes() {
            this.sortedBy = {};
            let fields = document.querySelectorAll('[data-sort-order]');
            fields.forEach(field => this.clearFieldSortAttributes(field));
        },
        // Clear sort attributes on sortable field
        clearFieldSortAttributes(field) {
            field.removeAttribute('data-sort-order');
            field.removeAttribute('data-sort-position');
            field.classList.remove('ascending', 'descending');
        },
        cancelSort() {
            this.clearDataSortAttributes();
            this.dataShouldBeSorted = true;
            this.$emit('sortedBy', this.sortedBy);
        }
        
    },
    computed: {
        pagesCount() {
            if (this.externalPagination?.last_page) {
                return this.externalPagination.last_page;
            } else {
                return this.searchData == ''
                            ? Math.ceil(this.dataTable.length / this.perPage)
                            : Math.ceil(this.paginatedData.length / this.perPage);
            }
        },
        paginatedData(){
            let dataSet;
            
            if (this.externalPagination?.total) {
                if (this.searchData.length > 0 ) {
                   dataSet = this.dataTable
                            .filter(r => this.$parent.searchData(r, this.searchData))
                } else {
                    dataSet = this.dataTable;
                }
            } else {
                let start = (this.currentPage - 1) * this.perPage,
                    end = start + this.perPage;

                if (this.searchData.length > 0 ) {
                    dataSet =  this.dataTable
                            .filter(r => this.$parent.searchData(r, this.searchData))
                            .slice(start, end);
                } else {
                    dataSet = this.dataTable.slice(start, end);
                }
            }
            
            // Sort dataSet
            if (this.sortedByLength > 0) {
                dataSet.sort(this.sortDataHandler(this.sortedBy, this.fieldsType));
            } else {
                if (this.sortByDefaultField !== '' && this.dataShouldBeSorted == true) {
                    // console.log(`Sort dataset by fallbackSortField`);
                    dataSet.sort((a,b) => a[this.sortByDefaultField] - b[this.sortByDefaultField]);
                    this.dataShouldBeSorted = false;
                }
            }

            return dataSet;
        },
        shownFrom() {
            if (this.externalPagination?.from) {
                return this.externalPagination.from;
            } else {
                return (this.currentPage - 1) * this.perPage + 1;
            }
        },
        shownTo() {
            if (this.externalPagination?.to) {
                return this.externalPagination.to;
            } else {
                let show = this.shownFrom + this.perPage;
                return show < this.dataTable.length ? show : this.dataTable.length;
            }

        },
        shownTotal() {
            if (this.externalPagination?.total) {
                return this.externalPagination.total;
            } else {
                return this.dataTable.length
            }
        },
        isLastPage() {
            return this.currentPage == this.pagesCount;
        },
        isFirstPage() {
            return this.currentPage == 1;
        },     
    },
    mounted() {
        // if (this.dataFields.length > 0) {
            let fields = document.querySelectorAll('[data-sort-field]');
            if (fields) {
                fields.forEach(field => {                    

                    if (field.dataset.sortField !== '') {

                        field.addEventListener('click', this.sortDataByField)                        

                        // Configure dataset field
                        if (field.dataset.fieldType) {
                            this.fieldsType[field.dataset.sortField] = field.dataset.fieldType;
                        } else {
                            this.fieldsType[field.dataset.sortField] = 'string'
                        }

                        // Field's sort order (desc, asc) and sort number (1,2,3)                        
                        if(Object.keys(this.sortedByFields).length > 0 ) {
                            
                            if(Object.keys(this.sortedByFields).indexOf(field.dataset.sortField) >= 0) {
                                
                                let position = Object.keys(this.sortedByFields).indexOf(field.dataset.sortField) + 1;
                                let sortOrder = this.sortedByFields[field.dataset.sortField];

                                field.dataset.sortPosition = position;
                                field.dataset.sortOrder = sortOrder;

                                field.classList.add(sortOrder);
                            }

                        } 
                    }                  
                    
                });
                this.sortedBy = Object.assign({}, this.sortedByFields);
            }
        // }
    },   
    watch: {
        sortedBy: {
            handler(newVal, oldVal) {
                this.sortedByLength = Object.keys(this.sortedBy).length;
            },
            deep: true,
            immidiate: true
        },
        sortedByLength(newVal, oldVal) {          
            if (oldVal == 1 && newVal == 0) {
                this.dataShouldBeSorted = true;
            }
        },    
    }
}
</script>

<style lang="scss" scoped>
.per-page, .search {
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #495057;
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
}
.per-page {
    padding: 0.3rem 1.5rem 0.3rem 0.5rem;
    vertical-align: middle;
    background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") right 0.75rem center/8px 10px no-repeat;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}



.search__wrapper {
    label {
        margin-right: 0.5rem;
    }
    .search {
        display: inline-block;
        width: 200px;
        height: calc(1.6em + 0.75rem + 0px);
        padding: 0.375rem 0.75rem;
        background-color: #fff;
        background-clip: padding-box;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;

    }
}

.per-page:focus, .search:focus {
    border-color: #7db8fb;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(7, 117, 242, 0.25);
}

// @media screen and (max-width: 800px) {
//     .search {
//         width: 250px;
//     }
// }

// @media screen and (max-width: 600px) {
//     .search {
//         width: 20px;
//     }
// }

.per-page__wrapper {
    span {
        margin-right: 0.5rem;
    }
}

.datasort__cancel {
    span {
        opacity: 0.5;
        color: red;
        cursor: pointer;

        &:hover {
            opacity: 1;
        }
    }
}

tbody tr:last-of-type {
    border-bottom: 2px solid #343a40;
}

.sort-field-number {
    font-size: 0.6rem;
    display: inline-block;
    position: absolute;
    right: 1.5rem;
    top: calc(50% - 0.5rem);
    line-height: 1rem;
    background: #f8f9fa;
    color: black;
    width: 1rem;
    text-align: center;
    border-radius: 999px;
    border-color: black;
}

</style>
