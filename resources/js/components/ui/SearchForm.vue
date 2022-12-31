<template>
    <form class="d-flex" role="search" onsubmit="event.preventDefault();">
        <div class="search__wrapper">
            <input  class="form-control me-2"
                    type="search"
                    list="found-households"
                    v-model="searchText"
                    @click="searchFocus"
                    placeholder="Адреса домогосподарства..."
                    aria-label="Search">
            <ul v-if="(households.length > 0) && isVisible">
                <li v-for="household in households" :value="household.id"  :key="household.id" @click="goToHousehold(household)">
                    <!-- <router-link :to="{name: 'HouseholdCardsShow', params: {id: household.id}}"> -->
                        {{ household.address }}
                    <!-- </router-link> -->
                </li>
            </ul>
        </div>
        <button class="btn btn-outline-success" type="buton" @click="search">
            <i class="bi bi-search"></i>
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
            isVisible: false
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
                })
        },
        searchFocus() {
            if ((this.households.length > 0) && !this.isVisible ) {
                this.isVisible = true;
            }
        },
        goToHousehold(household) {
            this.isVisible = false;
            this.$router.push({ name: 'HouseholdCardsShow', params: { id: household.id } })
            // console.log(`I am about to go to ${household.address}`);
        },
        handleClick(e) {
            if (!this.$el.contains(e.target)) {
                this.isVisible = false;
            }
        }
    },
    created() {
        window.addEventListener('click', this.handleClick,false);
    },
    beforeDestroy() {
        window.removeEventListener('click', this.handleClick, false);
    },
    watch: {
        'searchText' (newValue, oldValue) {
            if (newValue == '') {
                this.isVisible = false;
                this.households = [];
            }
        }
    }
}
</script>

<style lang="scss" scoped>

.search__wrapper {
    position: relative;
    width: 400px;

    ul {
        position: absolute;
        list-style: none;
        padding: 0.5rem 0 0.5rem 1rem;
        border: 1px solid #cdd4da;
        width: 100%;
        background: white;
        margin-top: 2px;
        border-radius: 0.375rem;


        li {
            margin-bottom: 0.5rem;

            &:hover {
                background: aquamarine;
            }
        }
    }
}

</style>
