<template>
    <div class="row mb-3">
        <div class="col h-100">
            <div class="additional-param-title" :class="{'show': paramsAreShown}">
                <span @click="toggleAdditionalParams" :class="{'filtered': selectedParams}">
                    Додаткові параметри
                </span>
            </div>
            <div class="additional-param-wrapper">
                <label v-for="param in params" :key="param.id" :for="param.code" class="additional-param">{{ param.name }}
                    <input type="checkbox" :name="param.code" :id="param.code" v-model="filter.additionalParams[param.code]">
                </label>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'AdditionalParamsFormFilter',
    props: {
        params: {
            type: Array,
            requiered: true,
        },
        filter: {
            type: Object,
            requiered: true
        }
    },
    data() {
        return {
            paramsAreShown: false,
        }
    },
    methods: {
        toggleAdditionalParams() {
            this.paramsAreShown = !this.paramsAreShown;
        }
    },
    computed: {
        selectedParams() {
            return Object.keys(this.filter.additionalParams).some(param => this.filter.additionalParams[param]);            
        }
    }
}

</script>

<style lang="scss" scoped>

.additional-param-title {
    span {
        cursor: pointer;
        position: relative;
        user-select: none;

        &::before {
            content: "";
            position: absolute;
            top: 9px;
            right: -17px;
            width: 10px;
            height: 3px;
            background: #888;
            z-index: 10;
            transform: rotate(40deg);
            transition: 0.35s;
        }

        &::after {
            content: "";
            position: absolute;
            top: 9px;
            right: -23px;
            width: 10px;
            height: 3px;
            background: #888;
            z-index: 10;
            transform: rotate(-40deg);
            transition: 0.35s;
        }

        &.filtered {
            font-weight: 600;
        }
    }

    &.show span::before {
        transform: rotate(-40deg);
    }
    &.show span::after {
        transform: rotate(40deg);
    }

    &.show + .additional-param-wrapper {
        margin-top: 0.5rem;
        // opacity: 1;
        height: 100%;
    }
}

.additional-param-wrapper {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 0.5rem;  
    // transition: all 0.5s; 
    overflow: hidden;
    
    // opacity: 0;
    height: 0px;
    // display: none;
    
    // &.show {
    //     margin-top: 0.5rem;
    //     // opacity: 1;
    //     height: 100%;

    // }
}


.additional-param {
    display: flex;
    flex-direction: row;
    /* flex: 1 0 auto; */
    padding: 0.25rem 0.75rem;
    /* margin-right: 1rem; */
    border: 1px solid #e3e3e3;
    background: rgb(227 227 227 / 50%);
    border-radius: 0.2rem;
    transition: 0.3s;

    input {
        display: none;
    }

    &:has(input:checked) {
        border: 1px solid #2c50b3;
        background: #2c50b3d3;
        color: white;
    }
}

</style>