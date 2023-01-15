<template>
    <div id="members">
        <div class="p-3 d-flex justify-content-between">
            <div>
                <button type="button"
                        class="btn btn-sm btn-light me-2"
                        @click="toggleFullScreen" title="Повний єкран">
                    <i class="bi bi-fullscreen"></i>
                </button>
                <button type="button"
                        id="newMember"
                        class="btn btn-sm btn-primary"
                        @click="newMember($event)">
                    <i class="bi bi-person-add"></i>
                    новий член
                </button>
                <button type="button"
                        class="ms-2 btn btn-sm btn-outline-secondary"
                        :class="{'active' : showAllMembers}"
                        title="Відобразити всіх"
                        v-if="hiddenMemebersExist"
                        @click="showAllMembers = !showAllMembers">
                    <i class="bi bi-person-fill-check"></i>
                </button>
            </div>
            <div>
                <button type="button"
                        title="Режим карток"
                        class="btn btn-sm btn-outline-secondary me-2"
                        :class="{'active' : viewMode == 'card'}"
                        @click="viewMode = 'card'">
                    <i class="bi bi-person-vcard"></i>
                </button>
                <button type="button"
                        title="Режим таблиці"
                        class="btn btn-sm btn-outline-secondary"
                        :class="{'active' : viewMode == 'table'}"
                        @click="viewMode = 'table'">
                    <i class="bi bi-table"></i>
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
                        <h4 class="mt-2" v-if="member.family_relationship == 'голова домогосподарства'">
                            <i class="bi bi-person-bounding-box" title="Голова домогосподарства"></i>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-2 align-items-center family-relationship">
                            <i class="bi bi-diagram-3 me-3" style="color:blue" title="Родинні відносини"></i>
                            {{member.family_relationship}}
                        </div>
                        <div class="d-flex mb-2 align-items-center">
                            <i class="bi bi-gift me-3" style="color:red" title="Дата народження"></i>
                            {{formatedDate(member.birthday)}}
                            <template v-if="member.death_date != null">
                                - {{formatedDate(member.death_date)}}
                            </template>
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
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-sm btn-outline-secondary" @click="showHouseholdMemberInfo(member.id)">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
            </template>
            <template v-else>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Прізвище І.Б.</th>
                            <!-- <th>Ім'я</th>
                            <th>По батькові</th> -->
                            <th>Стать</th>
                            <th>Дата народження</th>
                            <th v-if="showAllMembers">Дата смерті</th>
                            <th>Родинні стосунки</th>
                            <th>Місце роботи</th>
                            <th>Відомості про зайнятість / незайнятість</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="member in shownMembers" :key="member.id" :class="{'table-primary' : member.family_relationship == 'голова домогосподарства'}">
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-secondary"
                                        @click="showHouseholdMemberInfo(member.id)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </td>
                            <td>{{member.full_name}}</td>
                            <td>{{member.sex}}</td>
                            <td class="text-center">{{formatedDate(member.birthday)}}</td>
                            <td class="text-center" v-if="showAllMembers">
                                <template v-if="member.death_date">
                                    {{formatedDate(member.death_date)}}
                                </template>
                            </td>
                            <!-- <td>{{member.name}}</td>
                            <td>{{member.patronymic}}</td> -->
                            <td>{{member.family_relationship}}</td>
                            <td>
                                <template v-if="member.work_place">
                                    {{member.work_place.name}}
                                </template>
                            </td>
                            <td>{{member.employment_information}}</td>
                        </tr>
                    </tbody>
                </table>
            </template>
        </div>
    </div>

    <HouseholdMemberForm :formData="formData" @refreshData="$store.dispatch('Households/fetchRecord', household_id)" />
    <HouseholdMemberInfo :formData="formData" @refreshData="refreshMemberInfo" v-if="formIsReady" @closeForm="formIsReady = false"/>

</template>

<script>
import { Modal } from 'bootstrap'
import { computed } from 'vue'
import DateFormat from '../../../minixs/DateFormat';

import HouseholdMemberForm from './HouseholdMemberForm.vue'
import HouseholdMemberInfo from './HouseholdMemberInfo.vue'

export default {
    name: 'HouseholdMembers',
    mixins: [DateFormat],
    props: {
        'members': {
            type: Array,
            required: true
        },
        'household_id': {
            type: [String, Number],
            required: true
        }
    },
    data() {
        return {
            formData: {
                household_id: this.household_id,
                surname: '',
                name: '',
                patronymic: '',
                sex: '',
                birthday: null,
                family_relationship_id: 0,
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
            viewMode: 'card',
            formIsReady: false,
            showAllMembers: false,
        }
    },
    provide() {
        return {
            modalTitle: computed(() => this.modalTitle),
            // modalTitle: 'Новий член домогосподарства',
            // modalSubmitCaption: computed(() => this.modalSubmitCaption),
        }
    },
    methods: {
        newMember(e) {
            let myModal = new Modal(document.getElementById('HouseholdMemberForm'))
            this.modalTitle = 'Новий член домогосподарства';
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
        refreshMemberInfo(id) {
            axios.get(`/api/v1/household-members/${id}`)
                .then(res => {
                    Object.assign(this.formData, res.data.data);
                })
        },
        // formatedDate(date) {
        //     return new Date(date).toISOString().slice(0, 10).split('-').reverse().join('.');
        // },
        deleteMember(id) {

            axios.delete(`/api/v1/household-members/${id}`)
                .then(res => {
                    this.$store.dispatch('Households/fetchHousehold', this.household_id);
                    this.clearFormData();
                    var myModalForm = Modal.getInstance('#HouseholdMemberForm');
                    myModalForm.hide();
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


        }

    },
    computed: {
        shownMembers() {
            return this.showAllMembers ? this.members : this.members.filter(m => m.status == 'active');
        },
        hiddenMemebersExist() {
            return this.members.some(m => {
                return ['dead', 'gone'].indexOf(m.status) !== -1;
            })
        }
    },
    components: {
        HouseholdMemberForm,
        HouseholdMemberInfo
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
        transform: scale(1.05);
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
