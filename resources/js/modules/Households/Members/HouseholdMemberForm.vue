<template>

    <ModalForm formId="HouseholdMemberForm" @submitData="saveData" @closeForm="clearFormData" modalClass="modal-lg">
        <div class="row">
            <div class="col-md-4 border-end">
                <ul class="form-steps">
                    <li v-for="step in steps" :key="step.id" 
                        class="step" 
                        :class="{'active': currentStep == step.id, 'has-error' : groupHasError.includes(step.group)}" 
                        :data-group="step.group"
                        @click="currentStep = step.id">

                            <span>
                                {{ step.title }}
                            </span>
                            <div class="icon">
                                <SvgIcon type="mdi" :path="step.iconPath" />
                            </div>

                    </li>
                </ul>
            </div>
            <div class="col-md-8">

                <div v-show="currentStep == 1" class="p-3">

                    <div class="row mb-4">
                        <div class="col">
                            <label  for="memberSurname" class="form-label">Прізвище</label>
                            <input  type="text"
                                    id="memberSurname"
                                    :class="['form-control', hasError('surname') ? 'is-invalid' : '']"
                                    v-model="formData.surname" >
                            <div id="memberSurnameValidation" class="invalid-feedback">
                                {{ getError('surname') }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <label  for="memberName" class="form-label">Ім'я</label>
                            <input  type="text"
                                    :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                                    id="memberName"
                                    v-model="formData.name">
                            <div id="memberNameValidation" class="invalid-feedback">
                                {{ getError('name') }}
                            </div>
                        </div>
                   
                        <div class="col">
                            <label  for="memberPatronymic" class="form-label">По батькові</label>
                            <input  type="text"
                                    :class="['form-control', hasError('patronymic') ? 'is-invalid' : '']"
                                    id="memberPatronymic"
                                    v-model="formData.patronymic">
                            <div id="memberPatronymicValidation" class="invalid-feedback">
                                {{ getError('patronymic') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label  for="memberSex" class="form-label">Стать</label>
                            <input  list="sex"
                                    id="memberSex"
                                    placeholder="Type to search..."
                                    :class="['form-control', hasError('sex') ? 'is-invalid' : '']"
                                    v-model="formData.sex">
                            <datalist id="sex">
                                <option value="чоловіча" />
                                <option value="жіноча" />
                            </datalist>
                            <div id="memberSexValidation" class="invalid-feedback">
                                {{ getError('sex') }}
                            </div>
                        </div>                 
                        <div class="col-md-6">
                            <label  for="memberBirthdate" class="form-label">Дата народження</label>
                            <input  type="date"
                                    :class="['form-control', hasError('birthdate') ? 'is-invalid' : '']"
                                    id="memberBirthdate"
                                    v-model="formData.birthdate">
                            <div id="memberBirthdateValidation" class="invalid-feedback">
                                {{ getError('birthdate') }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="familyRelationshipType" class="form-label">Родинні стосунки</label>
                            <select :class="['form-control', hasError('family_relationship_type_id') ? 'is-invalid' : '']"
                                    id="familyRelationshipType"
                                    v-model="formData.family_relationship_type_id">
                                <option disabled value="0">Оберить тип родинних стосунків</option>
                                <option :value="relationship.id" v-for="relationship in relationshipTypes" :key="relationship.id">
                                    {{relationship.name}}
                                </option>
                            </select>
                            <div id="familyRelationshipTypeValidation" class="invalid-feedback">
                                {{ getError('family_relationship_type_id') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div v-show="currentStep == 2" class="p-3">
                    <div class="row mb-4">
                        <div class="col">
                            <label for="workPlace" class="form-label">Місце роботи залежно від територіального розташування</label>
                            <select class="form-select" 
                                    :class="{'is-invalid': hasError('work_place_id')}"
                                    id="workPlace"                         
                                    v-model="formData.work_place_id">
                                <option disabled value="0">Оберить місце роботи</option>
                                <option :value="place.id" v-for="place in places" :key="place.id">
                                    {{place.name}}
                                </option>
                            </select>
                            <div id="workPlaceValidation" class="invalid-feedback">
                                {{ getError('work_place_id') }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4" >
                        <div class="col">
                            <label for="memberEmployment" class="form-label">Відомості про зайнятість / незайнятість</label>
                            <textarea   class="form-control"
                                        :class="{'is-invalid' : hasError('employment_information')}"
                                        id="memberEmployment" 
                                        rows="4" 
                                        v-model="formData.employment_information">
                            </textarea>
                            <div id="memberEmploymentValidation" class="invalid-feedback">
                                {{ getError('employment_information') }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-3"  v-show="currentStep == 3">

                    <div class="row">
                        <div class="col">
                            <label for="memberSocialInformation" class="form-label">Відомості про пенсію, інвалідність, отримання соціальної допомоги</label>
                            <textarea   class="form-control"
                                        :class="{'is-invalid' : hasError('social_information')}"
                                        id="memberSocialInformation" 
                                        rows="4" 
                                        v-model="formData.social_information">
                            </textarea>
                            <div id="memberSocialInformationValidation" class="invalid-feedback">
                                {{ getError('social_information') }}
                            </div>
                        </div>
                    </div>

                </div>
                

                <div class="p-3" v-show="currentStep == 4">

                    <div class="row">
                        <div class="col">
                            <label for="memberAdditionalInformation" class="form-label">Додаткова інформація</label>
                            <textarea   class="form-control"
                                        :class="{'is-invalid': hasError('additional_information')}" 
                                        id="memberAdditionalInformation" 
                                        rows="4" 
                                        v-model="formData.additional_information">
                            </textarea>
                            <div id="memberAdditionalInformationValidation" class="invalid-feedback">
                                {{ getError('additional_information') }}
                            </div>
                        </div>
                    </div>
                    
                </div>

                
                <div  v-show="currentStep == 5" class="p-3">

                    <div class="row mb-4">
                        <div class="col">
                            <label  for="memberDeathdate" class="form-label">Дата смерті</label>
                            <input  type="date"
                                    :class="['form-control', hasError('death_date') ? 'is-invalid' : '']"
                                    id="memberDeathdate"
                                    v-model="formData.death_date">
                            <div id="memberDeathdateValidation" class="invalid-feedback">
                                {{ getError('death_date') }}
                            </div>
                        </div>
                        <div class="col">
                            <label  for="memberDeathRegisterNumber" class="form-label">Номер свідоцтва</label>
                            <input  type="text"
                                    id="memberDeathRegisterNumber"
                                    :class="['form-control', hasError('death_register_number') ? 'is-invalid' : '']"
                                    v-model="formData.death_register_number" >
                            <div id="memberDeathRegisterNumberValidation" class="invalid-feedback">
                                {{ getError('death_register_number') }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label  for="memberDeathRegisterOffice" class="form-label">Орган</label>
                            <input  type="text"
                                    id="memberDeathRegisterOffice"
                                    :class="['form-control', hasError('death_register_office') ? 'is-invalid' : '']"
                                    v-model="formData.death_register_number" >
                            <div id="memberDeathRegisterOfficeValidation" class="invalid-feedback">
                                {{ getError('death_register_office') }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        
    </ModalForm>

</template>

<script>

import { mapGetters }           from 'vuex';
import SvgIcon                  from '@jamescoyle/vue-icon';
import { 
    mdiAccountDetailsOutline,
    mdiAccountHardHatOutline,
    mdiLifebuoy,
    mdiInformationVariantCircleOutline,
    mdiCoffin
} from '@mdi/js';

import ModalForm                from '../../../components/ui/ModalForm.vue';

import FormValidator            from '../../../mixins/FormValidator';
import SubmitData               from '../../../mixins/SubmitData';

export default {
    name: 'HouseholdMemeberForm',
    mixins: [FormValidator, SubmitData],
    props: {
        'formData': {
            type: Object,
            required: true,
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        },
        'disabledFields': {
            type: Array,
            required: false,
            default: () => []
        },
        'showDeathInfo': {
            type: Boolean,
            required: false,
            default: () => false,
        }
    },    
    data() {
        return {
            apiUrl: '/api/v1/household-members',
            currentStep: 1,
            steps : [
                {
                    id: 1,
                    title: 'Головна інформація',
                    iconPath: mdiAccountDetailsOutline,
                    group: 'info'
                },
                {
                    id: 2,
                    title: 'Робота',
                    iconPath: mdiAccountHardHatOutline,
                    group: 'work'
                },
                {
                    id: 3,
                    title: 'Соціальний статус',
                    iconPath: mdiLifebuoy,
                    group: 'social'
                },
                {
                    id: 4,
                    title: 'Додаткова інфомація',
                    iconPath: mdiInformationVariantCircleOutline,
                    group: 'additional'
                },
                {
                    id: 5,
                    title: 'Інфомація о смерті',
                    iconPath: mdiCoffin,
                    group: 'death'
                },                
            ],
            groupHasError: []
        }
    },
    methods: {
        clearFormData() {
                this.formData.surname = '';
                this.formData.name = '';
                this.formData.patronymic = '';
                this.formData.sex = '';
                this.formData.birthdate = null;
                this.formData.family_relationship_type_id = 0;
                this.formData.employment_information = '';
                this.formData.work_place_id = 0;
                this.formData.social_information = '';
                this.formData.additional_information = '';

                this.errors = [];
                this.groupHasError = [];
                this.currentStep = 1;
               
        },
        saveData() {
            if (this.formData.work_place_id == 0) {
                delete this.formData.work_place_id;
            }
            this.submitData();
        },
    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes':'types'}),
        ...mapGetters('WorkPlaces', ['places']),
    },
    components: {
        ModalForm,
        SvgIcon
    },
    watch: {
        errors: {
            handler(newVal) {
                this.groupHasError = [];
         
                let errorsFields = Object.keys(newVal);
    
                if (errorsFields.length > 0) {
    
                    let groupInfo = ['surname', 'name', 'patronymic', 'sex', 'birthdate', 'family_relationship_type_id'];
                    let groupWork = ['work_place_id', 'employment_information'];
                    let groupSocial = ['social_information'];
                    let groupAdditional = ['additional_information'];
                    let groupDeath = ['death_date', 'death_register_number', 'death_register_office'];
    
                    errorsFields.forEach(field => {
                        if (groupInfo.includes(field)) {
                            if (!this.groupHasError.includes('info'))  {
                                this.groupHasError.push('info');
                            }
                        }
                      
                        if (groupWork.includes(field)) {
                            if (!this.groupHasError.includes('work'))  {
                                this.groupHasError.push('work');
                            }
                        }                       
    
                        if (groupSocial.includes(field)) {
                            if (!this.groupHasError.includes('social'))  {
                                this.groupHasError.push('social');
                            }
                        }
                        
                        if (groupAdditional.includes(field)) {
                            if (!this.groupHasError.includes('additional'))  {
                                this.groupHasError.push('additional');
                            }
                        } 
                        
    
                        if (groupDeath.includes(field)) {
                            if (!this.groupHasError.includes('death'))  {
                                this.groupHasError.push('death');
                            }
                        }    
                    })
                }
            },
            deep: true
        }
    }
}
</script>


<style lang="scss" scoped>

.form-steps {
    list-style: none;
    padding: 1rem;
}

.step {
    padding: 1rem 0;    
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;    
    transition: all 0.3s;
    
    &.active {
        font-weight: bold;

        .icon {
            background: #0A2558;
            color: white;
        }
    }

    &.has-error {
        span {
            color: red;
        }
        .icon {
            background: red;    
            color: white;        
        }
    }

    .icon {
        width: 36px;
        height: 36px;        
        border-radius: 999px;        
        display: flex;
        justify-content: center;
        align-items: center;        
        background: #e7e7e7;        
    }
     
}

</style>