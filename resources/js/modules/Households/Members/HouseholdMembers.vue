<template>
    <div id="members">
        <div class="p-3 d-flex justify-content-between">
            <div>
                <!-- <button type="button"
                        class="btn btn-sm btn-light me-2"
                        @click="toggleFullScreen" title="Повний єкран">
                    <span class="mdi mdi-family-tree"></span>
                </button> -->
                <!-- <button type="button"
                        id="newMember"
                        class="btn btn-sm btn-outline-secondary"
                        title="Додати нового члена домогосподарства"
                        @click="newMember($event)">
                    <span class="mdi mdi-account-plus-outline me-1"></span>
                    новий член
                </button> -->
                <button type="button"
                        id="additionalParams"
                        v-if="members.length > 0"
                        class="btn btn-sm btn-outline-secondary me-2"
                        title="Додаткова інформація о родині"
                        @click="openAdditionalParamsForm">
                    <span class="mdi mdi-tag-multiple me-1"></span>
                    Інформація о родині
                </button>
                <!-- <button type="button"
                        id="membersComposition"
                        v-if="members.length > 1"
                        class="btn btn-sm btn-outline-secondary"
                        title="Встановити родинні відносини"
                        @click="openMembersCompositionForm">
                    <span class="mdi mdi-family-tree me-1"></span>
                    Родинні відносини
                </button> -->
                <button type="button"
                        id="membersComposition"
                        :disabled="members.length <= 1"
                        class="btn btn-sm btn-outline-secondary"
                        title="Встановити родинні відносини"
                        @click="openMembersCompositionForm">
                    <span class="mdi mdi-family-tree me-1"></span>
                    Родинні відносини
                </button>
                <button type="button"
                        class="ms-2 btn btn-sm btn-outline-secondary"
                        :class="{'active' : showAllMembers}"
                        title="Відобразити всіх"
                        v-if="hiddenMemebersExist"
                        @click="showAllMembers = !showAllMembers">
                    <span class="mdi mdi-account-question-outline"></span>
                </button>
            </div>
            <div v-if="members.length > 0">
                <button type="button"
                        title="Режим карток"
                        class="btn btn-sm btn-outline-secondary me-2"
                        :class="{'active' : viewMode == 'card'}"
                        @click="viewMode = 'card'">
                    <span class="mdi mdi-card-account-details-outline"></span>
                </button>
                <button type="button"
                        title="Режим таблиці"
                        class="btn btn-sm btn-outline-secondary"
                        :class="{'active' : viewMode == 'table'}"
                        @click="viewMode = 'table'">
                    <span class="mdi mdi-table-account"></span>
                </button>
            </div>
        </div>
        <div class="px-3 d-flex gap-3 flex-wrap">
            <template v-if="viewMode == 'card'">
                    <div    class="card member"
                            :class="[member.status == 'dead' ? 'dead' : '',  member.status == 'gone' ? 'gone' : '']"
                            v-for="member in shownMembers"
                            :key="member.id"
                            @dblclick="showHouseholdMemberInfo(member)">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <div class="member-surname">{{member.surname}}</div>
                                <div class="member-name">{{member.name}} {{member.patronymic}}</div>
                            </div>
                            <h4 class="mt-2" v-if="member.family_relationship_type == 'голова домогосподарства'">
                                <span class="mdi mdi-head-alert-outline" title="Голова домогосподарства"></span>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex mb-2 align-items-center family-relationship">
                                <span class="mdi mdi-family-tree me-3" style="color:blue" title="Родинні відносини"></span>
                                {{member.family_relationship_type}}
                            </div>
                            <div class="d-flex mb-2 flex-column">
                                <div>
                                    <span class="mdi mdi-cake-variant-outline me-3" style="color:red" title="Дата народження"></span>
                                    <span>{{formatedDate(member.birthdate)}}</span>
                                </div>
                                <div v-if="member.death_date != null">
                                    <span class="mdi mdi-coffin me-3" title="Дата смерті"></span>
                                    <span>{{formatedDate(member.death_date)}}</span>
                                </div>
                            </div>
                            <!-- <div class="member-sex">
                                <span v-if="member.sex=='чоловіча'" title="чоловік">
                                    &#9794;
                                </span>
                                <span v-else title="жінка">
                                    &#9792;
                                </span>
                            </div> -->
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary btn-transparent dropdown-toggle"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        title="Друк документів">
                                    <span class="mdi mdi-file"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" @click="openFamilyCompositionReportForm(member)">
                                            <span class="mdi mdi-human-capacity-decrease me-2" style="color:blue;"></span>
                                            Довідка про склад родини
                                        </a>
                                    </li>
                                    <!-- <li class="d-flex align-items-center" v-if="availableLandYears.length > 0">
                                        <a class="dropdown-item pe-0"  @click="landOwnedReport(member)">
                                            <span class="mdi mdi-land-fields me-2" style="color:green;"></span>
                                            <span>Довідка про склад земельної ділянки на</span>
                                        </a>
                                        <select name="selectedLandYear" id="selectedLandYear" class="select-year" v-model="selectedLandYear">
                                            <option v-for="year in availableLandYears"
                                                    :key="year"
                                                    :value="year">
                                                {{ year }}
                                            </option>
                                        </select>
                                    </li> -->
                                </ul>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary btn-transparent" @click="showHouseholdMemberInfo(member)">
                                <span class="mdi mdi-eye-outline"></span>
                            </button>
                        </div>
                    </div>
                    <div class="new-member">
                        <div title="Додати нового члена домогосподарства" @click="newMember($event)">
                            <span class="mdi mdi-account-plus-outline mdi-36px"></span>
                        </div>
                    </div>


            </template>
            <template v-else>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Прізвище</th>
                            <th>Ім'я</th>
                            <th>По батькові</th>
                            <th>Стать</th>
                            <th class="text-center">Дата народження</th>
                            <th class="text-center" v-if="showAllMembers">Дата смерті</th>
                            <th>Родинні стосунки</th>
                            <!-- <th>Місце роботи</th>
                            <th>Відомості про зайнятість / незайнятість</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="member in shownMembers"
                            :key="member.id"
                            :class="{'table-primary' : member.family_relationship == 'голова домогосподарства'}">
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-secondary"
                                        @click="showHouseholdMemberInfo(member)">
                                    <span class="mdi mdi-eye-outline"></span>
                                </button>
                            </td>
                            <td>{{member.surname}}</td>
                            <td>{{member.name}}</td>
                            <td>{{member.patronymic}}</td>
                            <td>{{member.sex}}</td>
                            <td class="text-center">{{formatedDate(member.birthdate)}}</td>
                            <td class="text-center" v-if="showAllMembers">
                                <template v-if="member.death_date">
                                    {{formatedDate(member.death_date)}}
                                </template>
                            </td>
                            <td>{{member.family_relationship_type}}</td>
                        </tr>
                    </tbody>
                </table>
            </template>
        </div>
    </div>



    <HouseholdMemberForm
            :formData="formData"
            @refreshData="fetchMembers"/>

    <!-- <HouseholdMembersComposition
            v-if="compositionFromIsVisible"
            :members="shownMembers"
            @refreshData="fetchMembers"/> -->
    <HouseholdMembersComposition
            v-if="compositionFromIsVisible"
            @refreshData="fetchMembers"/>

    <!-- <FamilyCompositionReportForm
            :members="shownMembers"
            :selectedMember="selectedMember"
            @closeFamilyCompositionReportForm="closeFamilyCompositionReportForm"/> -->

    <FamilyCompositionReportForm
            v-if="compositionReportFromIsVisible"
            :selectedMember="selectedMember"
            @closeFamilyCompositionReportForm="closeFamilyCompositionReportForm"/>

    <HouseholdMembersAdditionalParams
            v-if="additionalParamsFormIsVisible"
            @closeForm="closeAdditionalParamsForm"
            @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />


</template>

<script>
import { Modal }                        from 'bootstrap';
import { computed, nextTick }           from 'vue';
import { mapGetters }                   from 'vuex';

import DateFormat                       from '../../../mixins/DateFormat';

import HouseholdMemberForm              from './HouseholdMemberForm.vue';
import HouseholdMemberInfo              from './HouseholdMemberInfo.vue';
import HouseholdMembersComposition      from './HouseholdMembersComposition.vue';
import FamilyCompositionReportForm      from './FamilyCompositionReportForm.vue';
import HouseholdMembersAdditionalParams from './HouseholdMembersAdditionalParams.vue';

export default {
    name: 'HouseholdMembers',
    mixins: [DateFormat],
    data() {
        return {
            formData: {
                household_id: null,
                surname: '',
                name: '',
                patronymic: '',
                sex: '',
                birthdate: null,
                family_relationship_type_id: 0,
                employment_information: '',
                social_information: '',
                additional_information: '',
                work_place_id: 0,
                death_date: null,
                death_register_number: '',
                death_register_office: '',
                land: [],
                movements: [],
                additional_params: []
            },
            members: [],
            modalTitle: '',
            modalSubmitCaption: '',
            viewMode: 'card',
            formIsReady: false,
            showAllMembers: false,
            isFamilyCompositionFormShown: false,
            selectedMember: 0,
            selectedLandYear: 0,
            familyAdditionalParams: [],
            additionalParamsFormIsVisible: false,
            compositionReportFromIsVisible: false,
            compositionFromIsVisible: false
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        fetchMembers() {
            axios.get(`/api/v1/household-members?household_id=${this.$route.params.id}`)
                .then(res => {
                    this.members = res.data.data
                });
        },
        newMember(e) {
            this.modalTitle = 'Новий член домогосподарства';
            this.modalSubmitCaption = 'Додати';
            this.formData.household_id = this.$route.params.id;

            let myModal = new Modal(document.getElementById('HouseholdMemberForm'))
            myModal.show();
        },
        showHouseholdMemberInfo(member) {
            // this.$router.push({name: 'households.show.members.info', params: {memberId: member.id}})
            this.$router.push({name: 'household.members.show', params: {id: member.id}})
            // axios.get(`/api/v1/household-members/${member.id}`)
            //     .then(res => {
            //         this.formIsReady = true;
            //         this.$nextTick(function() {
            //             let myModal = new Modal(document.getElementById('HouseholdMemberInfo'))
            //             // this.modalTitle = 'Інформація о члені домогосподарства';
            //             this.modalTitle = `${member.surname} ${member.name} ${member.patronymic}`
            //             Object.assign(this.formData, res.data.data);
            //             myModal.show();
            //         });
            //     })
        },
        closeMemberInfoForm() {
            this.formData.surname                       = '';
            this.formData.name                          = '';
            this.formData.patronymic                    = '';
            this.formData.sex                           = '';
            this.formData.birthdate                     = null;
            this.formData.family_relationship_type_id   = 0;
            this.formData.employment_information        = '';
            this.formData.social_information            = '';
            this.formData.additional_information        = '';
            this.formData.work_place_id                 = 0;
            // this.formData.land_owned                    = 0;
            // this.formData.land_rented                   = 0;
            // this.formData.land_leased                   = 0;
            this.formData.death_date                    = null;
            this.formData.death_register_number         = '';
            this.formData.death_register_office         = '';
            this.formData.land                          = [];
            this.formData.movements                     = [];
            this.formData.additional_params             = [];

            this.formIsReady = false;
        },
        // refreshMemberInfo(id) {
        //     axios.get(`/api/v1/household-members/${id}`)
        //         .then(res => {
        //             Object.assign(this.formData, res.data.data);
        //             this.modalTitle = `${this.formData.surname} ${this.formData.name} ${this.formData.patronymic}`
        //         })
        // },
        deleteMember(id) {
            axios.delete(`/api/v1/household-members/${id}`)
                .then(res => {
                    this.$store.dispatch('Households/fetchHousehold', this.household_id);
                    this.clearFormData();
                    let memberForm = Modal.getInstance('#HouseholdMemberForm');
                    memberForm.hide();
                })
        },
        toggleFullScreen() {
            // if already full screen; exit
            // else go fullscreen
            if (
              document.fullscreenElement ||
              document.webkitFullscreenElement ||
              document.mozFullScreenElement ||
              document.msFullscreenElement
            ) {
              if (document.exitFullscreen) {
                document.exitFullscreen();
              } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
              } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
              } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
              }
            } else {
              let element = document.getElementById('members');
              if (element.requestFullscreen) {
                element.requestFullscreen();
              } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
              } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
              } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
              }
            }
        },
        openMembersCompositionForm() {
            // axios.get(`/api/v1/households/${this.household_id}/family-relations`)
            //     .then(res => {
            //         console.log(res);
                    // this.compositionFromIsVisible = true
            //     })
            this.modalTitle = 'Родині відносини';
            this.modalSubmitCaption = 'Встановити';

            this.compositionFromIsVisible = true

            nextTick(() => {
                let membersCompositionForm = new Modal(document.getElementById('HouseholdMembersComposition'));
                membersCompositionForm.show();
            })
        },
        openFamilyCompositionReportForm(member) {
            this.modalTitle = `Довідка про склад родини: ${member.full_name}`;
            this.modalSubmitCaption = 'Друк';
            this.selectedMember = member.id;
            this.compositionReportFromIsVisible = true

            nextTick(() => {
                let familyCompositionReportForm = new Modal(document.getElementById('FamilyCompositionReportForm'));
                familyCompositionReportForm.show();
            })
        },
        openAdditionalParamsForm() {
            this.modalTitle = ' Додаткова інформація о родині';
            this.modalSubmitCaption = 'Встановити';
            this.additionalParamsFormIsVisible = true;
            // this.additionalParamsFormIsVisible = true;
            // this.familyAdditionalParams = Object.assign([], this.familyInfo);
            nextTick(() => {
                let familyAdditionalParamsForm = new Modal(document.getElementById('HouseholdFamilyAdditionalParams'));
                familyAdditionalParamsForm.show();
            })
        },
        closeAdditionalParamsForm() {
            this.additionalParamsFormIsVisible = false;
        },
        closeFamilyCompositionReportForm() {
            let familyCompositionReportForm = Modal.getInstance('#FamilyCompositionReportForm');
            familyCompositionReportForm.hide();
            this.selectedMember = 0;
            this.compositionReportFromIsVisible = false;
        },

    },
    computed: {
        shownMembers() {
            return this.showAllMembers ? this.members : this.members.filter(m => m.status == 'active');
        },
        hiddenMemebersExist() {
            return this.members.some(m => {
                return ['dead', 'gone'].indexOf(m.status) !== -1;
            })
        },
        ...mapGetters('Households', ['household_id', 'familyInfo'])
    },
    created() {
        this.fetchMembers();
    },
    components: {
        HouseholdMemberForm,
        HouseholdMemberInfo,
        HouseholdMembersComposition,
        FamilyCompositionReportForm,
        HouseholdMembersAdditionalParams
    }
}
</script>



<style lang="scss" scoped>
.member {
    user-select: none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;

    width: 200px;

    &:hover, &:active {
        box-shadow: 0 0 2px 3px #e7e7e7;
        //transform: scale(1.05);
        transition: all 0.3s ease;
        -webkit-font-smoothing: subpixel-antialiased;
    }

    &-surname {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .family-relationship {
        height: 2rem;
    }

    &.dead {
        background: lightgray;
    }
    &.gone {
        border-color: red;
    }
    // &-name {
    //     margin-bottom: 0.25rem;
    //     padding-bottom: 0.25rem;
    //     border-bottom: 1px solid #e7e7e7;
    // }
}

.new-member {
    display: flex;
    align-items: center;
    margin-left: 1rem;

    div {
        border: 2px solid #e7e7e7;
        border-radius: 999px;
        width: 72px;
        height: 72px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;

        span {
            color: #6c757d;
        }

        &:hover {
            border-color: var(--bs-primary);
            transform: scale(1.1);

            span {
                color: var(--bs-primary);
            }
        }
    }



}

#members:fullscreen {
    padding: 2rem;

    button#newMember {
        display: none;
    }
}

:not(:root):fullscreen::backdrop {
    padding: 2rem;
    background: #f8fafc;
}

.dropdown-menu {
    .select-year {
        border-color: #f8fafc;
        border-radius: 0.175rem;
        color: #555;
        background: #f8fafc;
        padding: 0 0.75rem 0 0.25rem;
        cursor: pointer;

        // -webkit-appearance: none;
        // -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';

        &:focus-visible {
            outline: none;
        }
    }

}


</style>
