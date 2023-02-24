<template>

    <!-- <div v-if="(additionalParams) ?? (additionalParams.length > 0)"> -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <table class="table table-sm">
                    <tbody>
                        <tr v-for="param in additionalParams" :key="param.id" class="align-middle">
                            <td>
                                <label :for="param.code" style="cursor: pointer;">
                                    {{ param.name }}
                                </label>
                            </td>
                            <td>
                                <template v-if="param.value_type_code == 'boolean'">
                                    <div class="form-check form-switch">
                                        <input  class="form-check-input"
                                                type="checkbox"
                                                role="switch"
                                                :id="param.code"
                                                :disabled="!isInEditMode"
                                                v-model="param.value">
                                    </div>
                                </template>
                                <template v-else>
                                    <input  type="text"
                                            class="form-control form-control-sm"
                                            :id="param.code"
                                            :disabled="!isInEditMode"
                                            v-model="param.value">
                                </template>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button v-if="!isInEditMode"
                                class="btn btn-sm btn-outline-secondary"
                                title="Редагувати дані"
                                @click="editData">
                            <span class="mdi mdi-pencil"></span>
                            Редагувати
                        </button>
                        <button v-if="isInEditMode"
                                class="btn btn-sm btn-outline-secondary"
                                title="Відмінити редагування"
                                @click="cancelEdit">
                            <!-- <span class="mdi mdi-check-all"></span> -->
                            Відмінити
                        </button>
                        <button v-if="isInEditMode"
                                class="btn btn-sm btn-outline-primary ms-3"
                                title="Встановити додаткові параметри"
                                @click="updateAdditionalParams"
                                :disabled="!additionalParamsWereChanged">
                            <span class="mdi mdi-check-all"></span>
                            Встановити
                        </button>

                    </div>
                </div>
            </div>
        </div>
    <!-- </div>
    <div v-else>
        WTF?!
    </div> -->


</template>

<script>

export default {
    name: 'MemberAdditionalParam',
    props: {
        'member_id': {
            type: [String, Number],
            required: true
        },
        'additionalParams': {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            _additionalParams: [],
            isInEditMode: false
        }
    },
    methods: {
        editData() {
            this.isInEditMode = true;
            this._additionalParams = JSON.parse(JSON.stringify(this.additionalParams));

        },
        cancelEdit() {
            this.isInEditMode = false;
            this._additionalParams = [];
            this.$emit('refreshData');
        },
        updateAdditionalParams() {
            var vm = this;
            let changed_params = this.additionalParams.filter(function(element, index) {
                console.log(element.value, vm._additionalParams[index].value);
                return element.value !== vm._additionalParams[index].value;
            });

            if (changed_params.length > 0) {
                let additionalParamData = {};
                changed_params.forEach(p => {
                    additionalParamData[p.code] = p.value;
                });
                additionalParamData['owner_id'] = this.member_id;
                console.log(additionalParamData);
                // return;
                axios.post('/api/v1/member-additional-params', additionalParamData)
                    .then(res => {
                        this.$toast(res.data.message);
                        // axios.get(`/api/v1/household-members/${this.member_id}`)
                        //     .then(res => {
                                 // this.$store.dispatch('Households/fetchRecord', this._form.household_id);
                        this.$emit('refreshData');
                            //     //  this._form = JSON.parse(JSON.stringify(res.data.data));
                            // });
                    });
             }
        },
    },
    computed: {
        additionalParamsWereChanged() {
            return JSON.stringify(this.additionalParams) !== JSON.stringify(this._additionalParams);
        }
    }
}

</script>
