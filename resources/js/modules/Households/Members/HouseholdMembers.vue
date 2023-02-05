<template>
    <div id="members">
        <div class="p-3 d-flex justify-content-between">
            <div>
                <!-- <button type="button"
                        class="btn btn-sm btn-light me-2"
                        @click="toggleFullScreen" title="Повний єкран">
                    <span class="mdi mdi-family-tree"></span>
                </button> -->
                <button type="button"
                        id="newMember"
                        class="btn btn-sm btn-primary"
                        title="Додати нового члена домогосподарства"
                        @click="newMember($event)">
                    <span class="mdi mdi-account-plus-outline me-1"></span>
                    новий член
                </button>
                <button type="button"
                        class="ms-2 btn btn-sm btn-outline-secondary"
                        :class="{'active' : showAllMembers}"
                        title="Відобразити всіх"
                        v-if="hiddenMemebersExist"
                        @click="showAllMembers = !showAllMembers">
                    <span class="mdi mdi-account-question-outline"></span>
                </button>
                <button type="button"
                        id="membersComposition"
                        class="btn btn-sm btn-outline-primary ms-2"
                        title="Встановити родинні відносини"
                        @click="openMembersCompositionForm">
                    <span class="mdi mdi-family-tree me-1"></span>
                    Родинні відносини
                </button>
            </div>
            <div>
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
                        @dblclick="showHouseholdMemberInfo(member.id)">
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
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    title="Друк документів">
                                <span class="mdi mdi-file"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" @click="openFamilyCompositionReportForm(member.id)">
                                        <span class="mdi mdi-human-capacity-decrease me-2"></span>
                                        Довідка про склад сім'ї
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary" @click="showHouseholdMemberInfo(member.id)">
                            <span class="mdi mdi-eye-outline"></span>
                        </button>
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
                                        @click="showHouseholdMemberInfo(member.id)">
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
                            <!-- <td>
                                <template v-if="member.work_place">
                                    {{member.work_place.name}}
                                </template>
                            </td>
                            <td>{{member.employment_information}}</td> -->
                        </tr>
                    </tbody>
                </table>
            </template>
        </div>
    </div>

    <HouseholdMemberForm
            :formData="formData"
            @refreshData="$store.dispatch('Households/fetchRecord', household_id)"/>

    <HouseholdMemberInfo
            :formData="formData"
            @refreshData="refreshMemberInfo"
            v-if="formIsReady"
            closeMemberInfoForm="closeMemberInfoForm"/>

    <HouseholdMembersComposition
            :members="shownMembers"
            @refreshData="$store.dispatch('Households/fetchRecord', household_id)"/>

    <FamilyCompositionReportForm
            :members="shownMembers"
            :selectedMember="selectedMember"
            @closeFamilyCompositionReportForm="selectedMember = 0"/>

</template>

<script>
import { Modal }        from 'bootstrap';
import { computed }     from 'vue';
import { mapGetters }   from 'vuex';

import DateFormat       from '../../../minixs/DateFormat';

import HouseholdMemberForm          from './HouseholdMemberForm.vue';
import HouseholdMemberInfo          from './HouseholdMemberInfo.vue';
import HouseholdMembersComposition  from './HouseholdMembersComposition.vue';
import FamilyCompositionReportForm  from './FamilyCompositionReportForm.vue';

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
                land_owned: 0,
                land_rented: 0,
                land_leased: 0,
                death_date: null,
                death_register_number: '',
                death_register_office: '',
                movements: [],
            },
            modalTitle: '',
            modalSubmitCaption: '',
            viewMode: 'card',
            formIsReady: false,
            showAllMembers: false,
            isFamilyCompositionFormShown: false,
            selectedMember: 0
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        newMember(e) {
            this.modalTitle = 'Новий член домогосподарства';
            this.modalSubmitCaption = 'Додати';
            this.formData.household_id = this.household_id;

            let myModal = new Modal(document.getElementById('HouseholdMemberForm'))
            myModal.show();
        },
        showHouseholdMemberInfo(id) {
            axios.get(`/api/v1/household-members/${id}`)
                .then(res => {
                    this.formIsReady = true;
                    this.$nextTick(function() {
                        let myModal = new Modal(document.getElementById('HouseholdMemberInfo'))
                        this.modalTitle = 'Інформація о члені домогосподарства';
                        Object.assign(this.formData, res.data.data);
                        myModal.show();
                    });
                })
        },
        closeMemberInfoForm() {
            this.formData.surname                   = '';
            this.formData.name                      = '';
            this.formData.patronymic                = '';
            this.formData.sex                       = '';
            this.formData.birthdate                 = null;
            this.formData.family_relationship_id    = 0;
            this.formData.employment_information    = '';
            this.formData.social_information        = '';
            this.formData.additional_information    = '';
            this.formData.work_place_id             = 0;
            this.formData.land_owned                = 0;
            this.formData.land_rented               = 0;
            this.formData.land_leased               = 0;
            this.formData.death_date                = null;
            this.formData.death_register_number     = '';
            this.formData.death_register_office     = '';
            this.formData.movements                 = [];

            this.formIsReady = false;
        },
        refreshMemberInfo(id) {
            axios.get(`/api/v1/household-members/${id}`)
                .then(res => {
                    Object.assign(this.formData, res.data.data);
                })
        },
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
            this.modalTitle = 'Родині відносини';
            this.modalSubmitCaption = 'Встановити';

            this.isFamilyCompositionFormShown = true;

            let membersCompositionForm = new Modal(document.getElementById('HouseholdMembersComposition'));
            membersCompositionForm.show();
        },
        openFamilyCompositionReportForm(id) {
            this.modalTitle = 'Довідка про стан родини';
            this.modalSubmitCaption = 'Друк';
            this.selectedMember = id;

            let familyCompositionReportForm = new Modal(document.getElementById('FamilyCompositionReportForm'));
            familyCompositionReportForm.show();
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
        ...mapGetters('Households', ['members', 'household_id'])
    },
    components: {
        HouseholdMemberForm,
        HouseholdMemberInfo,
        HouseholdMembersComposition,
        FamilyCompositionReportForm,
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

</style>
