<template>
    <form class="d-flex" role="search" onsubmit="event.preventDefault();">
        <div class="search__wrapper">
            <input  :class="['form-control me-2', currentHousehodldItem >= 0 ? 'invisible-caret' : '']"
                    id="searchHousehold"
                    type="search"
                    v-model="searchText"
                    @click="searchFocus"
                    @keydown="searchHandleDownKey($event)"
                    placeholder="Пошук домогосподарства за адресою або прізвищем людини..."
                    aria-label="Search">
            <ul v-show="(households.length > 0) && isVisible" id="households">
                <li v-for="(household, index) in households"
                    class="founded"
                    :value="household.id"
                    :key="index">
                        <!-- <router-link :to="{path: `/households/${household.id}/members/${household.member_id}`}" v-if="household.member_full_name"> -->
                        <router-link :to="{path: `/household-members/${household.member_id}`}" v-if="household.member_full_name">
                            <div>
                                {{ household.member_full_name }}
                                <br>
                                <small>{{ household.address }}</small>
                            </div>
                        </router-link>
                        <router-link :to="{path: `/households/${household.id}`}" v-else>
                            {{ household.address }}
                        </router-link>
                </li>
            </ul>
            <ul v-show="(households.length == 0) && isVisible" id="households">
                <li>Нічого не знайдено. Спробуйте змінити текст</li>
            </ul>
        </div>
        <button class="btn btn-outline-secondary ms-2 py-1 px-2" type="buton" @click="search" :disabled="searchText == ''">            
            <SvgIcon type="mdi" :path="path" />
        </button>
    </form>
</template>

<script>

import SvgIcon          from '@jamescoyle/vue-icon';
import { mdiMagnify }   from '@mdi/js';

export default {
    name: 'SearchForm',
    components: {
        SvgIcon
    },
    data() {
        return {
            searchText: '',
            households: [],
            isVisible: false,
            searchInputEl: null,
            foundedHouseholds: null,
            currentHousehodldItem: -1,
            path: mdiMagnify
        }
    },
    methods: {
        search() {
            axios.get('/api/v1/households', {
                    params: {
                        search: this.searchText
                    }
                })
                .then(res => {
                    this.households = res.data.data;
                    this.isVisible = true;
                    this.foundedHouseholds = document.getElementById('households').children;
                })
        },
        searchFocus() {
            if ((this.households.length > 0) && !this.isVisible ) {
                this.isVisible = true;
            }
        },
        handleClick(e) {
            if (!this.$el.contains(e.target)) {
                this.isVisible = false;
            }
        },
        searchHandleDownKey(e) {
            if (this.isVisible) {
                if (e.key == 'ArrowDown') {
                    this.currentHousehodldItem++;
                    if (this.currentHousehodldItem > this.foundedHouseholds.length-1) {
                        this.currentHousehodldItem = this.foundedHouseholds.length-1;
                    }
                    this.toggleHouseholdClass('selected');
                } else if (e.key == 'ArrowUp') {
                    if (this.currentHousehodldItem >= 0) {
                        this.currentHousehodldItem--;
                        if (this.currentHousehodldItem < 0) {
                            e.preventDefault();
                            this.currentHousehodldItem = -1;
                            this.removeHouseholdClass('selected')

                            let end = this.searchInputEl.value.length;
                            this.searchInputEl.setSelectionRange(end, end);
                        } else {
                            this.toggleHouseholdClass('selected');
                        }
                    }
                } else if (e.key == 'Enter') {
                    if (this.currentHousehodldItem >= 0) {
                        this.foundedHouseholds[this.currentHousehodldItem].children[0].click();
                    }
                } else if (e.key == 'Escape') {
                    e.preventDefault();
                    this.isVisible = false;
                }
            }
        },
        removeHouseholdClass(name) {
            Array.from(this.foundedHouseholds).forEach(h => h.classList.remove(name))
        },
        toggleHouseholdClass(name) {
            this.removeHouseholdClass(name);
            this.foundedHouseholds[this.currentHousehodldItem].classList.add(name);
        }
    },
    created() {
        window.addEventListener('click', this.handleClick,false);
    },
    mounted() {
        this.searchInputEl = document.getElementById('searchHousehold');
    },
    beforeDestroy() {
        window.removeEventListener('click', this.handleClick, false);
    },
    watch: {
        'searchText' (newValue, oldValue) {
            if (newValue == '') {
                this.isVisible = false;
                this.households = [];
                this.foundedHouseholds = null;
                this.currentHousehodldItem = -1;
            }
        }
    }
}
</script>

<style lang="scss" scoped>

.search__wrapper {
    position: relative;
    width: 500px;

    ul {
        position: absolute;
        list-style: none;
        padding: 0.25rem;
        border: 1px solid #cdd4da;
        width: 100%;
        background: white;
        margin-top: 2px;
        border-radius: 0.375rem;


        li {
            padding: 0.5rem 0.75rem;

            a {
                text-decoration: none;
            }

            &:not(:last-of-type) {
                border-bottom: 1px dotted #e7e7e7;
            }
            &.founded:hover,
            &.founded.selected {
                border-radius: 0.375rem;
                background: #d2e1f9;
                color: black;
            }

            div {
                pointer-events: none;

                small {
                    font-size: 0.85rem;
                    color: #555;
                }
            }

            span {
                // margin: 0.25rem 0.25rem;
                display: inline-block;
            }

        }
    }
}

.invisible-caret {
    caret-color: transparent;
}
</style>
