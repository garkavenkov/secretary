<template>

    <ModalForm  formId="RegionForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label  for="regionName" class="form-label">Назва</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="regionName"
                        v-model="formData.name" />
                <div id="regionNameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label  for="regionCenter" class="form-label">Обласний центр</label>
                <input  type="text"
                        :class="['form-control', hasError('center') ? 'is-invalid' : '']"
                        id="regionName"
                        v-model="formData.center" />
                <div id="regionCenterValidation" class="invalid-feedback">
                    {{ getError('center') }}
                </div>
            </div>
        </div>

    </ModalForm>

</template>

<script>

import ModalForm from '../../components/ui/ModalForm.vue';
import FormValidator from '../../minixs/FormValidator';

export default {
    name: 'RegionsForm',
    mixins: [FormValidator],
    props: {
        'formData': {
            type: Object,
            required: false,
            default() {
                return {
                    name: '',
                    center: ''
                }
            }
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        }
    },
    data() {
        return {
        }
    },
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post('/api/v1/regions', this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$store.dispatch('Regions/fetchRegions');
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`/api/v1/regions/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.errors = [];
                        this.$store.dispatch('Regions/fetchRegion', this.formData.id);
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
        clearFormData() {
            this.formData.name = '';
            this.formData.center = '';
            this.errors = [];
        },
    },
    watch: {
        // 'formData.name'() {
        //     console.log('name has been changed')
        // }
    },
    created() {
        var vm = this;
        // this.$watch('formData.name', function(newValue) {
        //     if (this.errors['name']) {
        //         delete this.errors['name'];
        //     }
        // })
        var fields = Object.keys(this.formData);
        // function callback() {
        //     if this.errors
        // }
        fields.forEach(function(f) {
            let field = `formData.${f}`
            vm.$watch(field, function() {
                if (this.errors[f]) delete this.errors[f];
            });
        });

    },
    components: {
        ModalForm
    }
}
</script>
