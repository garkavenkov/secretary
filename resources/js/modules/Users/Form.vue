<template>

    <ModalForm  formId="UserForm" @submitData="submitData" @closeForm="clearFormData">

        <div class="row mb-3">
            <div class="col">
                <label  for="userName" class="form-label">Логін</label>
                <input  type="text"
                        :class="['form-control', hasError('user_name') ? 'is-invalid' : '']"
                        id="userName"
                        v-model="formData.user_name" />
                <div id="userNameValidation" class="invalid-feedback">
                    {{ getError('user_name') }}
                </div>
            </div>
        </div>

        <!-- <div class="row mb-3">
            <div class="col">
                <label  for="surname" class="form-label">Прізвище</label>
                <input  type="text"
                        :class="['form-control', hasError('surname') ? 'is-invalid' : '']"
                        id="surname"
                        v-model="formData.surname" />
                <div id="surnameValidation" class="invalid-feedback">
                    {{ getError('surname') }}
                </div>
            </div>
        </div> -->

        <div class="row mb-3">
            <div class="col">
                <label  for="name" class="form-label">Прізвище Ім'я по Батькові</label>
                <input  type="text"
                        :class="['form-control', hasError('name') ? 'is-invalid' : '']"
                        id="name"
                        v-model="formData.name" />
                <div id="nameValidation" class="invalid-feedback">
                    {{ getError('name') }}
                </div>
            </div>
        </div>

        <!-- <div class="row mb-3">
            <div class="col">
                <label  for="patronymic" class="form-label">По батькові</label>
                <input  type="text"
                        :class="['form-control', hasError('patronymic') ? 'is-invalid' : '']"
                        id="patronymic"
                        v-model="formData.patronymic" />
                <div id="nameValidation" class="invalid-feedback">
                    {{ getError('patronymic') }}
                </div>
            </div>
        </div> -->

        <div class="row mb-3">
            <div class="col">
                <label  for="email" class="form-label">Електронна пошта</label>
                <input  type="email"
                        :class="['form-control', hasError('email') ? 'is-invalid' : '']"
                        id="email"
                        v-model="formData.email" />
                <div id="emailValidation" class="invalid-feedback">
                    {{ getError('email') }}
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label  for="position" class="form-label">Посада</label>
                <textarea
                        :class="['form-control', hasError('position') ? 'is-invalid' : '']"
                        id="position"
                        rows="2"
                        v-model="formData.position" />
                <div id="positionValidation" class="invalid-feedback">
                    {{ getError('position') }}
                </div>
            </div>
        </div>

        <div class="row mb-3" v-if="action == 'create'">
            <div class="col">
                <label  for="password" class="form-label">Пароль</label>
                <input  type="password"
                        :class="['form-control', hasError('password') ? 'is-invalid' : '']"
                        id="password"
                        autocomplete="off"
                        v-model="formData.password" />
                <div id="passwordValidation" class="invalid-feedback">
                    {{ getError('password') }}
                </div>
            </div>
            <div class="col">
                <label  for="password_confirmation" class="form-label">Підтвердіть пароль</label>
                <input  type="password"
                        :class="['form-control', hasError('password_confirmation') ? 'is-invalid' : '']"
                        id="password_confirmation"
                        autocomplete="off"
                        v-model="formData.password_confirmation" />
                <div id="passwordConfirmeValidation" class="invalid-feedback">
                    {{ getError('password_confirm') }}
                </div>
            </div>
        </div>


    </ModalForm>


</template>


<script>

import ModalForm        from '../../components/ui/ModalForm.vue';

import SubmitData       from '../../mixins/SubmitData';
import FormValidator    from '../../mixins/FormValidator';

export default {
    name: 'RolesForm',
    mixins: [SubmitData, FormValidator],
    props: {
        'formData': {
            type: Object,
            required: true,
        },
        'action': {
            type: String,
            required: false,
            default: 'create'
        }
    },
    data() {
        return {
            apiUrl: '/api/v1/users',
        }
    },
    methods: {
        clearFormData() {}
    },
    components: {
        ModalForm
    }
}

</script>
