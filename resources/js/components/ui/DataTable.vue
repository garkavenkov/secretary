<template>
    <div class="data-table--wrapper">
        <div class="data-table_  d-flex justify-content-between pb-2" v-if="showActionsPanel">
            <div class="per-page__wrapper" >
                <span class="mr-1">Відображати</span>
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
            <div class="search__wrapper">
                <label  for="search" class="mr-2 mb-0">Поіск</label>
                <input  type="search"
                        name="search"
                        id="search"
                        class="search"
                        autocomplete="off"
                        @input="$emit('searchInput', $event.target.value)">
            </div>
        </div>
        <div class="table__wrapper">
            <div class="table-responsive">
                <table class="table table-striped" :class="tableClass">
                    <thead :class="tableHeaderClass">
                        <slot name="header"></slot>
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
        <div class="data-table__pagination--wrapper d-flex justify-content-between align-items-center py-2" v-if="(paginatedData.length > 0) && showPaginationPanel">
            <div>Відображено з {{shownFrom + 1}} по {{shownTo}} із {{dataTable.length}}</div>
            <!-- <div><span v-if="searchData == ''">Отображено</span><span v-else>Найдено</span> c {{shownFrom + 1}} по {{shownTo}} из {{paginatedData.length}}</div> -->
            <nav aria-label="Page navigation example">
                <ul class="pagination mb-0">
                    <li class="page-item" :class="{'disabled': isFirstPage}"><a class="page-link" @click="prevPage" >Previous</a></li>
                    <li class="page-item"
                        v-bind:class="[(currentPage == page) ? 'active' : '']"
                        v-for="page in pagesCount" :key="page">
                            <a class="page-link" @click="changePage(page)">{{page}}</a>
                    </li>
                  <li class="page-item" :class="{'disabled': isLastPage}"><a class="page-link" @click="nextPage">Next</a></li>
                </ul>
            </nav>
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
    },
    data() {
        return {
            currentPage: 1,
            perPage: this.perPageItems[0],
            searchData: ''
        }
    },
    methods: {
        changePerPage(value) {
            // if (this.externalPagination) {
            //     let url = `${this.pagination.path}/?per_page=${value}`;
            //     this.$emit('fetchData', url);
            // } else {
            //     this.perPage = value === "all" ? value :  parseInt(value);
            //     this.currentPage = 1;
            // }
            this.perPage = parseInt(value);
            this.currentPage = 1;
        },
        nextPage() {
            this.currentPage ++;
        },
        prevPage() {
            this.currentPage --;
        },
        changePage(page) {
            this.currentPage = page;
        }
    },
    computed: {
        pagesCount() {
            return this.searchData == ''
                        ? Math.ceil(this.dataTable.length / this.perPage)
                        : Math.ceil(this.paginatedData.length / this.perPage);
        },
        paginatedData(){
            let start = (this.currentPage - 1) * this.perPage,
                end = start + this.perPage;
            // if (this.searchData !== '') {
            //     return this.dataTable
            //             // .filter(r => {
            //             //     return r.supplier.includes(this.searchData)
            //             // })
            //             .filter(r => this.$parent.searchData(r, this.searchData))
            //             .slice(start, end);
            // }
            return this.dataTable.slice(start, end);
        },
        shownFrom() {
            return (this.currentPage - 1) * this.perPage;
        },
        shownTo() {
            let show = this.shownFrom + this.perPage;
            // return this.shownFrom + this.perPage;
            return show < this.dataTable.length ? show : this.dataTable.length;
            // return show < this.paginatedData.length ? show : this.paginatedData.length;
        },
        isLastPage() {
            return this.currentPage == this.pagesCount;
        },
        isFirstPage() {
            return this.currentPage == 1;
        }
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

.search {
    display: inline-block;
    width: 200px;
    height: calc(1.6em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    background-color: #fff;
    background-clip: padding-box;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
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

tbody tr:last-of-type {
    border-bottom: 2px solid #343a40;
}
</style>
