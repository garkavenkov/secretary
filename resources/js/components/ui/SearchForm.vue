<template>
    <form class="d-flex" role="search" onsubmit="event.preventDefault();">
        <div class="search__wrapper">
            <input  :class="['form-control me-2', currentHousehodldItem >= 0 ? 'invisible-caret' : '']"
                    id="searchHousehold"
                    type="search"
                    v-model="searchText"
                    @click="searchFocus"
                    @keydown="searchHandleDownKey"
                    placeholder="Адреса домогосподарства..."
                    aria-label="Search">
            <ul v-show="(households.length > 0) && isVisible" id="households" @mousedown="listHandleMouseDown">
                <li v-for="household in households" :value="household.id"  :key="household.id" @click="goToHousehold(household.id)">
                    {{ household.address }}
                </li>
            </ul>
        </div>
        <button class="btn btn-outline-secondary ms-2" type="buton" @click="search">
            <span class="mdi mdi-home-search"></span>
        </button>
    </form>
</template>

<script>

export default {
    name: 'SearchForm',
    data() {
        return {
            searchText: '',
            households: [],
            isVisible: false,
            searchInputEl: null,
            foundedHouseholds: null,
            currentHousehodldItem: -1,
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
        goToHousehold(id) {
            this.$router.push({ name: 'HouseholdCardsShow', params: { id: id } })
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
                    let id = this.foundedHouseholds[this.currentHousehodldItem].value;
                    this.goToHousehold(id);
                } else if (e.key == 'Escape') {
                    e.preventDefault();
                    this.isVisible = false;
                }
            }
        },
        listHandleMouseDown(e) {
            e.preventDefault();
            let id = e.target.value;

            this.removeHouseholdClass('selected');
            this.currentHousehodldItem = Array.from(this.foundedHouseholds).findIndex(h => h.value == id);

            this.goToHousehold(id);
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
            padding: 0.75rem;

            &:hover, &.selected {
                border-radius: 0.375rem;
                background: #d2e1f9;
                color: black;
            }
        }
    }
}

.invisible-caret {
    caret-color: transparent;
}
</style>
