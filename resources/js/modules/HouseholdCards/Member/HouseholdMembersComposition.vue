<template>

    <ModalForm formId="HouseholdMembersComposition" @submitData="submitData" @closeForm="closeForm" modalClass="modal-fullscreen">

        <table class="table table-bordered table-sm">

            <thead>
                <tr>
                    <th></th>
                    <th v-for="member in members" :key="`header-${member.id}`">
                        <div class="member-name__horizontal">
                            <span>{{ member.surname }}</span>
                            <span>{{ member.name }} {{ member.patronymic }}</span>
                            <span>{{ member.birthdate }}</span>
                        </div>
                    </th>
                </tr>
            </thead>

            <tbody>
                <template v-for="member in members" :key="`row-${member.id}`">
                    <tr>
                        <td>
                            <div class="member-name__horizontal">
                                <span>{{ member.surname }}</span>
                                <span>{{ member.name }} {{ member.patronymic }}</span>
                                <span>{{ member.birthdate }}</span>
                            </div>
                        </td>
                        <template v-for="cell in members" :key="`cell-${cell.id}`">
                            <td v-if="cell.id == member.id" class="brick">
                            </td>
                            <td v-else class="align-middle">

                                <select name="familyRelationship"
                                        :id="`${member.id}.${cell.id}`"
                                        :data-sex="cell.sex"
                                        class="form-control"
                                        @change="relationshipSelected($event)"
                                        v-model="links[`${member.id}.${cell.id}`]"
                                        :title="`Ким являється ${cell.surname} ${cell.name} ${cell.patronymic} по відношенню  до  ${member.surname} ${member.name} ${member.patronymic}`">
                                    <option value="0" disabled>оберіть зв'язок</option>
                                    <template v-if="cell.sex == 'чоловіча'">
                                        <option v-for="rel in maleRelationships"
                                                :key="rel.id"
                                                :value="rel.id">
                                            {{ rel.name }}
                                        </option>
                                    </template>
                                    <template v-else>
                                        <option v-for="rel in femaleRelationships"
                                                :key="rel.id"
                                                :value="rel.id">
                                            {{ rel.name }}
                                        </option>
                                    </template>
                                </select>
                            </td>
                        </template>
                    </tr>
                </template>
            </tbody>

        </table>
        <pre>
            {{ links }}
        </pre>
    </ModalForm>

</template>

<script>
import { mapGetters } from 'vuex';

import ModalForm from '../../../components/ui/ModalForm.vue';

export default {
    name: 'HouseholdMembersComposition',
    props: {
        'members': {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            links: {},
            linksPairs: {},
        }
    },
    methods: {
        submitData() {},
        closeForm() {
            this.$emit('closeForm');
        },
        makeMatrixFromMembers() {
            var pairs = [];
            this.members.forEach(member => {

                let rest = this.members
                                .filter(m => m.id !== member.id)
                                .map(m => {
                                    return { [`${member.id}.${m.id}`] : 0}

                                });

                pairs.push(...rest);
            });

            pairs.forEach(p => {
                this.links[Object.keys(p)[0]] = Object.values(p)[0];
            })

            this.linksPairs['чоловік.жіноча']    = "дружина";
            this.linksPairs['дружина.чоловіча']  = "чоловік";

            this.linksPairs['син.чоловіча']      = "батько";
            this.linksPairs['син.жіноча']        = "мати";

            this.linksPairs['донька.чоловіча']   = "батько";
            this.linksPairs['донька.жіноча']     = "мати";

            this.linksPairs['батько.чоловіча']   = "син";
            this.linksPairs['батько.жіноча']     = "донька";

            this.linksPairs['мати.чоловіча']     = "син";
            this.linksPairs['мати.жіноча']       = "донька";

            this.linksPairs['тесть.чоловіча']    = "зять";
            this.linksPairs['теща.жіноча']       = "зять";

            this.linksPairs['свекор.чоловіча']   = "невістка";
            this.linksPairs['свекруха.жіноча']   = "невістка";

            this.linksPairs['невістка.чоловіча'] = "свекор";
            this.linksPairs['невістка.жіноча']   = "свекруха";

            this.linksPairs['дід.чоловіча']      = "онук";
            this.linksPairs['дід.жіноча']        = "онука";

            this.linksPairs['баба.чоловіча']     = "онук";
            this.linksPairs['баба.жіноча']       = "онука";

            this.linksPairs['онука.чоловіча']    = "дід";
            this.linksPairs['онука.жіноча']      = "баба";

            this.linksPairs['онук.чоловіча']     = "дід";
            this.linksPairs['онук.жіноча']       = "баба";

            this.linksPairs['брат.чоловіча']     = "брат";
            this.linksPairs['брат.жіноча']       = "сестра";

            this.linksPairs['сестра.чоловіча']   = "брат";
            this.linksPairs['сестра.жіноча']     = "сестра";

            this.linksPairs['прадід.чоловіча']   = "правнук";
            this.linksPairs['прадід.жіноча']     = "правнука";

            this.linksPairs['прабаба.чоловіча']  = "правнук";
            this.linksPairs['прабаба.жіноча']    = "правнучка";

            // console.log(this.links);
            // this.links = {}
        },
        relationshipSelected(e) {
            // console.log(e)
            // let relation = e.target.options[e.target.value].text;
            let relation = e.target.selectedOptions[0].text;
            // console.log(relation);

            let corMemberId = e.target.id.split('.').reverse().join('.');
            let corMemberEl = document.getElementById(corMemberId);
            // console.log(corMemberEl);
            let corSex = corMemberEl.dataset.sex;

            let corRelation = this.linksPairs[`${relation}.${corSex}`];
            // console.log(corRelation);

            if (corSex == 'чоловіча') {
                // console.log('Чоловіча: ', this.maleRelationships.find(r => r.name == corRelation))
                this.links[corMemberId] = this.maleRelationships.find(r => r.name == corRelation).id;
            } else {
                // console.log('Жіноча: ', this.femaleRelationships.find(r => r.name == corRelation))
                this.links[corMemberId] = this.femaleRelationships.find(r => r.name == corRelation).id;
            }


        }
    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes': 'types'}),
        maleRelationships() {
            return this.relationshipTypes.filter(r => r.sex == 'чоловіча')
        },
        femaleRelationships() {
            return this.relationshipTypes.filter(r => r.sex == 'жіноча')
        }
    },
    created() {
        this.makeMatrixFromMembers()
    },
    components:{
        ModalForm
    }
}

</script>


<style lang="scss" scoped>
.member-name__horizontal {
    display: flex;
    flex-direction: column;

    span:not(:first-of-type) {
        font-size: 0.8rem;
    }
}

.brick {
    background: #e7e7e7;
}
</style>
