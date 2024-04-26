<template>
    <div class="slider">
        <div  class="progress" ref="slider"></div>
    </div>
    <div class="range-input">
        <input  type="range" 
                ref="rangeMin"
                id="rangeMin"
                name="rangeMin"
                :min="min" 
                :max="max"
                :value="minValue"                
                @input="updateMinRange" >                
        <input  type="range"                 
                ref="rangeMax"
                id="rangeMax"
                name="rangeMax"
                :min="min" 
                :max="max"                
                :value="maxValue"
                @input="updateMaxRange" >                
    </div>
</template>

<script setup>
import { computed, ref, watchEffect } from 'vue';
    
// define components props for the slider component
const {min, max, minValue, maxValue} = defineProps({
    'min': {
        type: [String, Number],
        required: true,
    },
    'max': {
        type: [String, Number],
        required: true,
    },
    'minValue': {
        type: [String, Number],
        required: true,            
    },
    'maxValue': {
        type: [String, Number],
        required: true,            
    }
});

// define emits for the slider component
const emit = defineEmits(["update:minValue", "update:maxValue"]);

// define refs for the slider element and slider values
const slider = ref(null);
const rangeMin = ref(null);
const rangeMax = ref(null);

const sliderMinValue = ref(minValue);
const sliderMaxValue = ref(maxValue);

// function to get the percentage of a value between the min and max values
const getPercent = (value, min, max) => {
    return ((value - min) / (max - min)) * 100;
}


const updateMinRange = (e) => {    
    if (e.target.value < sliderMaxValue.value) {
        sliderMinValue.value = parseInt(e.target.value);
    } 
    else {        
        rangeMin.value.value = sliderMinValue.value        
    }
}

const updateMaxRange = (e) => {    
    if (e.target.value > sliderMinValue.value) {
        sliderMaxValue.value = parseInt(e.target.value);
    } 
    else {        
        rangeMax.value.value = sliderMaxValue.value        
    }
}

// function to get the difference between the min and max values
const sliderDifference = computed(() => {
  return Math.abs(sliderMaxValue.value - sliderMinValue.value);
});


// function to set the css variables for width, left, and right
const setCSSProps = (left, right) => {
  slider.value.style.setProperty("--progressLeft", `${left}%`);
  slider.value.style.setProperty("--progressRight", `${right}%`);
};


watchEffect(() => {
    if (slider.value) {
        
        emit("update:minValue", sliderMinValue.value);
        emit("update:maxValue", sliderMaxValue.value);   
        
        // calculate values in percentages        
        const leftPercent = getPercent(sliderMinValue.value, min, max);
        const rightPercent = 100 - getPercent(sliderMaxValue.value, min, max);

        // set the CSS variables        
        setCSSProps(leftPercent, rightPercent);
    }

})


</script>


<style lang="scss" scoped>

.slider {
    height: 5px;
    border-radius: 5px;
    background: #ddd;
    position: relative;
    overflow: hidden;
}

.progress {
    height: 5px;    
    left: var(--progressLeft);
    right: var(--progressRight);
    position: absolute;
    border-radius: 5px;    
    background: rgba(44, 80, 179, 0.8274509804)
    // background: var(--bs-blue);
}

.range-input {
    position: relative;

    input[type="range"] {
        position: absolute;
        top: -5px;
        height: 5px;
        width: 100%;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
    }
    
    input[type="range"]:focus-within {
        outline: none;
    }

    input[type="range"]::-webkit-slider-thumb {
        height: 20px;
        width: 20px;   
        position: relative;     
        // border-radius: 50%;
        border-radius: 5px;
        pointer-events: auto;
        -webkit-appearance: none;
        
        background: rgba(44, 80, 179, 1);
        // background: var(--bs-blue);
        transition: background 0.3s;
        border: 1px solid #fff;
    }

    input[type="range"]:last-child::-webkit-slider-thumb {
        z-index: 10;
    }

    input[type="range"]:active::-webkit-slider-thumb,
    input[type="range"]:focus-visible::-webkit-slider-thumb {
        background: var(--bs-info);        
        // background: var(--bs-primary);
    }     
   
}

</style>