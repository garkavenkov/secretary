<template>

    <ModalForm formId="ExportRecordForm" @submitData="submitData" :sumbitIsDisabled="!isReadyForExport" @closeForm="closeForm">
      
        <div class="row mb-3">           

            <div class="mb-2">Оберіть формат документу</div>
            <div class="format-type__wrapper">

                <label class="format-type" for="excel" style="--clr: green;" title="Експорт у форматі Microsoft Excel">
                    <input type="radio" id="excel" value="excel" v-model="formatType" :checked="formatType=='excel'">                    
                    <SvgIcon type="mdi" :path="excelPath" size="36" />
                </label>
                    
                <label class="format-type" for="word" style="--clr: royalblue" title="Експорт у форматі Microsoft Word">
                    <input type="radio" id="word" value="word" v-model="formatType" :checked="formatType=='word'">                    
                    <SvgIcon type="mdi" :path="wordPath" size="36" />
                </label>                
                    
                <label class="format-type" for="json" style="--clr: cadetblue" title="Експорт у форматі JSON">                        
                    <input type="radio" id="json" value="json" v-model="formatType" :checked="formatType=='json'">                    
                    <SvgIcon type="mdi" :path="jsonPath" size="36" />
                </label>

                <label class="format-type" for="csv" style="--clr: darkgoldenrod" title="Експорт у форматі CSV">
                    <input type="radio" id="csv" value="csv" v-model="formatType" :checked="formatType=='csv'">                    
                    <SvgIcon type="mdi" :path="csvPath" size="36" />
                </label>

            </div>

        </div>
        <div class="row mb-3">
            <div class="d-flex flex-column">
                <div class="mb-2">
                    Оріентація документу
                </div>
                <div class="d-flex justify-content-between align-items-center px-3">
                    <div class="d-flex flex-column justify-content-around h-100">
                        <label class="document-orientation__label" for="landscape" title="Альбомна орієнтація документу">
                            <input type="radio" id="landscape" value="landscape" v-model="orientation" :checked="orientation=='landscape'">
                            альбомна орієнтація
                        </label>
                        <label class="document-orientation__label" for="portrait" title="Портретна оріентація документу">
                            <input type="radio" id="portrait" value="portrait" v-model="orientation" :checked="orientation=='portrait'">                         
                            портретна орієнтація
                        </label>
                    </div>
                    <div class="document-orientation__preview">
                        <SvgIcon type="mdi" :path="portraitPath" size="72" v-if="orientation == 'portrait'"/>
                        <SvgIcon type="mdi" :path="landscapePath" size="72" v-else />
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="d-flex flex-column">   
                <div class="mb-2">Доступні стовпці</div>
                <div class="available-field__wrapper">                    
                    <div    v-for="(field,index) in fieldsTitle" 
                            :key="index" 
                            :id="`available-field-${index}`"
                            :draggable="!selectedFields.includes(field)" 
                            class="available-field"     
                            :class="{'selected': selectedFields.includes(field)}"
                            @dragstart="pickupAvailableField($event, `available-field-${index}`)"
                            @dragend="pickupAvailableFieldEnded($event)">
                        {{ field }}
                    </div>                        
                </div>
            </div>    
        </div>

        <div class="row mb-3">
            <div class="d-flex flex-column">   
                <div class="mb-2">Відібрані стовпці</div>
                <div    class="selected-field__wrapper"  
                        @drop="dropField($event)"
                        @dragover.prevent
                        @dragenter.prevent>
                    <template v-if="selectedFields.length > 0">
                        <div    v-for="(field,index) in selectedFields" 
                                :key="index" 
                                class="selected-field"
                                :id="`selected-field-${index}`"
                                data-selected-field
                                :data-field-order="index+1"
                                draggable="true"
                                @dragstart="pickupSelectedField($event,  `selected-field-${index}`)"
                                @drop="dropSelectedField($event,index)">
                            <span>{{field}}</span>
                            <span   class="selected-field__remove" 
                                    title="Прибрати стовпець зі списку відібраних"
                                    @click="unSelectField(field)">
                                x
                            </span>
                        </div>
                    </template>
                    <template v-else>
                        <div class="no-fields-selected">
                            Перетягніть сюди доступні стовпці для єкспорту
                        </div>
                    </template>                    
                </div>
            </div>    
        </div>
      
  </ModalForm>

</template>

<script>

import SvgIcon          from '@jamescoyle/vue-icon'
import ModalForm        from '../../components/ui/ModalForm.vue';
import { 
    mdiFileExcel,
    mdiFileWord,    
    mdiCodeJson,
    mdiFileDelimited,
    mdiCropLandscape,
    mdiCropPortrait
} from '@mdi/js';

export default {
    name: 'ExportRecordForm',
    props: {
        records: {
            type: Array,
            required: true
        },
        availableFields: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            excelPath: mdiFileExcel,
            wordPath: mdiFileWord,            
            jsonPath: mdiCodeJson,
            csvPath: mdiFileDelimited,
            landscapePath: mdiCropLandscape,
            portraitPath: mdiCropPortrait,

            formatType: '',
            orientation: 'landscape',
            selectedFields: [],
        }
    },
    methods: {
        getFileName() {
            if (this.formatType == 'csv') {
                return 'data.csv'
            } else if (this.formatType == 'json') {
                return 'data.json'
            } else if (this.formatType == 'excel') {
                return 'data.xls'
            } else if (this.formatType == 'word') {
                return 'data.docx'
            }             
        },       
        submitData() {
            if (this.selectedFields.length == 0) {
                return;
            }
            let fields = [];
            
            this.selectedFields.forEach(f => {
                const index = this.fieldsTitle.indexOf(f);
                let fieldName = this.fieldsName[index];
                fields.push(fieldName);
            });

            let data = {
                model: 'App\\Models\\HouseholdMember',
                format: this.formatType,
                orientation: this.orientation,
                fields: fields.join(','),
                ids: this.records.map(r => r.id).join(',')
            }
            let type = {}
            if (this.formatType !== 'json') {
                type = { responseType: 'arraybuffer'}
            }
            axios.post('/api/v1/export-data', data,  type )
                .then(res => {
                    let contentType = res.headers['content-type'];
                    
                    let blob = new Blob([res.data]);

                    if (contentType.includes('application/json')) {
                        blob = new Blob([JSON.stringify(res.data, null, 4)], {type: "application/json"});
                    }                     
                    
                    const url = window.URL.createObjectURL(blob);
                    const link = document.createElement('a');                    
                    link.href = url;                    
                    let fileName = this.getFileName();
                    link.setAttribute('download', fileName);
                    document.body.appendChild(link);
                    link.click();
                });
        },        
        closeForm() {
            this.formatType = '';
            this.orientation = 'landscape';
            this.selectedFields = [];
        },
        toggleField(field) {            
            if (this.selectedFields.includes(field)) {                
                const index = this.selectedFields.indexOf(field);                
                if (index > -1) { 
                    this.selectedFields.splice(index, 1);
                }                
            } else {                
                this.selectedFields.push(field);
            }
        },
        pickupAvailableField(e, fieldId) {           
            e.dataTransfer.dropEffect = "move";
            e.dataTransfer.effectAllowed = "move";
            e.dataTransfer.setData('fieldId', fieldId);
        },
        dropField(e) {
            e.stopPropagation();
            let fieldId = e.dataTransfer.getData('fieldId');
            let fieldEl = document.getElementById(fieldId);            
            if (fieldEl) {
                this.selectedFields.push(fieldEl.innerText);
            }
        },
        pickupAvailableFieldEnded(e) {
            e.stopPropagation();            
        },
        pickupSelectedField(e, fieldId) {
            e.dataTransfer.dropEffect = "move"
            e.dataTransfer.effectAllowed = "move";
            e.dataTransfer.setData('fieldId', fieldId);            
        },
        dropSelectedField(e, index) {
            e.stopPropagation();            
            let fieldId = e.dataTransfer.getData('fieldId');
            let fieldEl = document.getElementById(fieldId);            
            if (fieldEl) {                
                let draggedField = null;
                let droppedField = null;                
                if (Object.keys(fieldEl.dataset).includes('selectedField')) {
                    draggedField = fieldEl.firstChild.innerText;
                    let draggedFieldIndex = this.selectedFields.indexOf(draggedField)                    
                    
                    droppedField = e.target.innerText;                    
                    let droppedFieldIndex = this.selectedFields.indexOf(droppedField);
                    
                    // switch dragged and dropped fields
                    [this.selectedFields[droppedFieldIndex], this.selectedFields[draggedFieldIndex]] = [this.selectedFields[draggedFieldIndex], this.selectedFields[droppedFieldIndex]];
                    
                } else {
                    draggedField = fieldEl.innerText;
                    this.selectedFields.splice(index, 0, draggedField);
                }                
            }            
        },
        unSelectField(field) {
            const index = this.selectedFields.indexOf(field);            
            if (index > -1) {
                this.selectedFields.splice(index, 1);
            }                
        }
    },
    computed: {        
        fieldsName() {
            return Object.keys(this.availableFields);
        },
        fieldsTitle() {
            return Object.values(this.availableFields);
        },
        isReadyForExport() {
            return (this.formatType !== '' && this.selectedFields.length > 0) ? true : false
        }
    },
    components: {
        ModalForm,
        SvgIcon
    }
}

</script>

<style lang="scss" scoped>

.format-type__wrapper {
    display: flex;
    justify-content: space-between;
}

.format-type {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #e7e7e7;
    border-radius: 0.2rem;
    box-shadow: 1px 1px 3px 1px #e7e7e7;
    color: var(--clr);    
    
    input[type="radio"] {
        appearance: none;
        display: none;
    }

    &:has(input[type="radio"]:checked) {    
        transition: all 0.3s;        
        background: var(--clr);
        color: white;
        border-color: var(--clr);
        // box-shadow: 1px 1px 3px 1px var(--clr);
        box-shadow: none;
    }

}

.document-orientation {

    &__preview {
        width: 10ch;
        height: 75px;
        border: 1px solid #e7e7e7;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 0.5rem;
        box-shadow: 1px 1px 3px 1px #e7e7e7;
    }   
  
}

.available-field__wrapper {    
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    padding: 0 0.5rem;

    .available-field {
        display: flex;        
        border: 1px solid #d7d7d7;
        padding: 0.2rem 0.5rem;
        align-items: center;
        border-radius: 0.2rem;
        background: #eee;
        cursor: pointer;

        &.selected {            
            background: #d7d7d7;
            color: #888;
            user-select: none;
            cursor: not-allowed;
        }
    }
}

.selected-field__wrapper {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    padding: 0.5rem;
    min-height: 3rem;
    background: repeating-linear-gradient(-45deg, transparent 0 4px, #ecebeb59 4px 6px);    
    border: 1px dotted #adb5bd;
    border-radius: 0.2rem;
    align-items: flex-start;

    .selected-field {        
        display: flex;
        border: 1px solid #d7d7d7;
        padding: 0rem 0rem 0rem 1.5rem;
        align-items: center;
        border-radius: 0.2rem;
        background: #eee;
        cursor: grabbing;
        position: relative;

        &::before {
            position: absolute;            
            display: flex;
            align-items: center;
            justify-content: center;
            content: attr(data-field-order);            
            left: 0px;
            color: #dc3545;
            font-size: 10px;
            width: 20px;
            background: #e7e7e7;            
            border-right: 1px solid #ccc;
            height: 100%;
        }        

        .selected-field__remove {                        
            cursor: pointer;            
            color: #888;            
            width: 20px;
            text-align: center;
            font-weight: 700;            
            font-size: 16px;
            margin-left: 0.5rem;
            transition: all 0.3s;
            border-left: 1px solid #ccc;
            height: 100%;

            &:hover {                
                background: #ccc;
                color: #ff5252;    
            }
        }
    }

    .no-fields-selected {
        display: flex;
        flex-grow: 1;
        justify-content: center;
        padding-top: 0.25rem;
        font-size: 0.8rem;
        color: var(--bs-secondary-color);
    }
}

</style>