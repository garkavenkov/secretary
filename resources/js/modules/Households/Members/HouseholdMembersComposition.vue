<template>

    <ModalForm  formId="HouseholdMembersComposition"
                @submitData="submitData"
                @closeForm="closeForm"
                modalClass="modal-fullscreen"
                :sumbitIsDisabled="submitIsDisabled">

        <table class="table table-bordered table-sm">

            <thead>
                <tr>
                    <th></th>
                    <th v-for="member in members" :key="`header-${member.id}`">
                        <div class="member-name__horizontal">
                            <span>{{ member.surname }}</span>
                            <span>{{ member.name }} {{ member.patronymic }}</span>
                            <!-- <span>{{ member.birthdate }}</span> -->
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
                                <!-- <span>{{ member.birthdate }}</span> -->
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
                                        v-model="availableLinks[`${member.id}.${cell.id}`]"
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
        <!-- <pre>
            {{ availableLinks }}
        </pre> -->
    </ModalForm>

</template>

<script>
import { mapGetters }   from 'vuex';

import ModalForm        from '../../../components/ui/ModalForm.vue';

export default {
    name: 'HouseholdMembersComposition',
    props: {
        members: {
            type: Array,
            required: true
        },
        availableLinks: {
            type: Object,
            required: true
        },
        establishedLinks: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            relativePairs: {},
        }
    },
    methods: {
        submitData() {
            if (JSON.stringify(this.availableLinks) !== JSON.stringify(this.establishedLinks)) {
                axios.post('/api/v1/establish-family-relationships', this.availableLinks)
                    .then(res => {
                        this.$emit('refreshData');
                        this.$toast(res.data.message);
                    })
            }
        },
        closeForm() {
            this.$emit('closeHouseholdFamilyComposition')
        },
        fillRelativePairs() {
            this.relativePairs['чоловік.жіноча']    = "дружина";
            this.relativePairs['дружина.чоловіча']  = "чоловік";

            this.relativePairs['син.чоловіча']      = "батько";
            this.relativePairs['син.жіноча']        = "мати";

            this.relativePairs['дочка.чоловіча']    = "батько";
            this.relativePairs['дочка.жіноча']      = "мати";

            this.relativePairs['батько.чоловіча']   = "син";
            this.relativePairs['батько.жіноча']     = "дочка";

            this.relativePairs['мати.чоловіча']     = "син";
            this.relativePairs['мати.жіноча']       = "дочка";

            this.relativePairs['тесть.чоловіча']    = "зять";
            this.relativePairs['теща.жіноча']       = "зять";

            this.relativePairs['свекор.чоловіча']   = "невістка";
            this.relativePairs['свекруха.жіноча']   = "невістка";

            this.relativePairs['невістка.чоловіча'] = "свекор";
            this.relativePairs['невістка.жіноча']   = "свекруха";

            this.relativePairs['дід.чоловіча']      = "онук";
            this.relativePairs['дід.жіноча']        = "онука";

            this.relativePairs['баба.чоловіча']     = "онук";
            this.relativePairs['баба.жіноча']       = "онука";

            this.relativePairs['онука.чоловіча']    = "дід";
            this.relativePairs['онука.жіноча']      = "баба";

            this.relativePairs['онук.чоловіча']     = "дід";
            this.relativePairs['онук.жіноча']       = "баба";

            this.relativePairs['брат.чоловіча']     = "брат";
            this.relativePairs['брат.жіноча']       = "сестра";

            this.relativePairs['сестра.чоловіча']   = "брат";
            this.relativePairs['сестра.жіноча']     = "сестра";

            this.relativePairs['прадід.чоловіча']   = "правнук";
            this.relativePairs['прадід.жіноча']     = "правнука";

            this.relativePairs['прабаба.чоловіча']  = "правнук";
            this.relativePairs['прабаба.жіноча']    = "правнучка";
        },
        relationshipSelected(e) {
            let relation = e.target.selectedOptions[0].text;
            let corMemberId = e.target.id.split('.').reverse().join('.');
            let corMemberEl = document.getElementById(corMemberId);
            let corSex = corMemberEl.dataset.sex;
            let corRelation = this.relativePairs[`${relation}.${corSex}`];

            let relationId = 0;
            if (corSex == 'чоловіча') {
                relationId = this.maleRelationships.find(r => r.name == corRelation).id;
            } else {
                relationId = this.femaleRelationships.find(r => r.name == corRelation).id;
            }
            this.$emit('relationshipSelected', {corMemberId, relationId});
        }
    },
    computed: {
        ...mapGetters('FamilyRelationshipTypes', {'relationshipTypes': 'types'}),
        maleRelationships() {
            return this.relationshipTypes.filter(r => r.sex == 'чоловіча')
        },
        femaleRelationships() {
            return this.relationshipTypes.filter(r => r.sex == 'жіноча')
        },
        submitIsDisabled() {
            return JSON.stringify(this.availableLinks) === JSON.stringify(this.establishedLinks)
        }
    },
    created() {
        this.fillRelativePairs()
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
