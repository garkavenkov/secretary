<template>
    <div class="data-table--wrapper">
        <div class="data-table_  d-flex justify-content-between pb-2" v-if="showActionsPanel">
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
            <div class="search__wrapper">
                <form autocomplete="off">
                    <label  for="search">Поіск</label>
                    <!-- <input  type="search"
                            id="search"
                            class="search"
                            readonly
                            autocomplete="off"
                            @input="$emit('searchInput', $event.target.value)"> -->
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
        }
    },
    data() {
        return {
            currentPage: 1,
            perPage: this.perPageItems[0],
            searchData: ''
        }
    },
    emits: ['pageChanged', 'perPageChanged'],
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
            if (this.externalPagination?.total) {
                if (this.searchData !== '') {
                   return this.dataTable
                            .filter(r => this.$parent.searchData(r, this.searchData))
                }
                return this.dataTable;
            } else {
                let start = (this.currentPage - 1) * this.perPage,
                    end = start + this.perPage;

                if (this.searchData !== '') {
                    return this.dataTable
                            .filter(r => this.$parent.searchData(r, this.searchData))
                            .slice(start, end);
                }
                return this.dataTable.slice(start, end);
            }
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

tbody tr:last-of-type {
    border-bottom: 2px solid #343a40;
}
</style>
