<template>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card" v-if="user.name">
                <div class="card-header">
                    <h5>Інформація о користувачі: <span>{{ user.name }}</span></h5>
                    <DropDownMenu @edit="editUser" @delete="deleteUser(user.id)" buttonClass="btn-outline-secondary btn-transparent"/>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="photo">
                                <img  :src="userPhotoPath" id="userPhotoPreview">
                            </div>
                            <!-- <div v-else class="photo">
                                <span>Фото відсутне</span>
                            </div> -->
                            <input type="file" accept="image/*"  id="file-input" name="photo"  @change="imageSelected($event)">
                        </div>
                        <div class="col-md-8">
                            <NavigationTabs :tabs="tabs" @click="switchTab" tabType="button"/>
                           
                            <div class="tab-content p-3">                                
                                <div v-if="currentTab == 'MainInfo'">
                                    <div>
                                        <dl class="row">
                                            <dt class="col-md-4">Прізвище Ім'я по Батькові</dt>
                                            <dd class="col-md-8">{{user.name}}</dd>
                                        </dl>
                                        <dl class="row">
                                            <dt class="col-md-4">Логін</dt>
                                            <dd class="col-md-8">{{user.user_name}}</dd>
                                        </dl>
                                        <!-- <dl class="row">
                                            <dt class="col-md-4">Посада</dt>
                                            <dd class="col-md-8">{{user.position}}</dd>
                                        </dl> -->
                                        <dl class="row">
                                            <dt class="col-md-4">Електронна пошта</dt>
                                            <dd class="col-md-8">{{user.email}}</dd>
                                        </dl>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-sm btn-outline-primary" title="Назначити ролі" @click="editUser">
                                            Редагувати
                                        </button>
                                    </div>
                                </div>
                                <div v-if="currentTab == 'Roles'">
                                    <div class="form-check " v-for="role in roles" :key="role.id">
                                        <label  class="form-check-label"
                                                :for="role.code"
                                                :title="role.description">
                                            {{ role.name }}
                                        </label>
                                        <input  class="form-check-input"
                                                type="checkbox"
                                                :id="role.code"
                                                :value="role.id"
                                                v-model="user.roles"
                                                :disabled="!rolesIsEditable">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-sm btn-outline-primary"
                                                title="Назначити ролі"
                                                @click="editRoles"
                                                v-if="!rolesIsEditable">
                                            Редагувати
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger me-1"
                                                title="Відмінити призначення ролей"
                                                @click="cancelEditRoles"
                                                v-if="rolesIsEditable">
                                            Відмінити
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary"
                                                title="Назначити ролі"
                                                @click="assignRoles"
                                                v-if="rolesIsEditable">
                                            Назначити
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- <div>
                                <dl class="row">
                                    <dt class="col-md-4">Прізвище Ім'я по Батькові</dt>
                                    <dd class="col-md-8">{{user.name}}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-md-4">Логін</dt>
                                    <dd class="col-md-8">{{user.user_name}}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-md-4">Посада</dt>
                                    <dd class="col-md-8">{{user.position}}</dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-md-4">Електронна пошта</dt>
                                    <dd class="col-md-8">{{user.email}}</dd>
                                </dl>
                            </div>
                            <div>
                                <hr />
                                <h6>Ролі</h6>
                                <div class="form-check " v-for="role in roles" :key="role.id">
                                    <label class="form-check-label" :for="role.code">{{ role.name }}</label>
                                    <input class="form-check-input" type="checkbox" :id="role.code" :value="role.id" v-model="user.roles">
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <UserForm
            action="update"
            :formData="formData"
            @refreshData="fetchUser" />

</template>

<script>

import { Modal }        from 'bootstrap';
import { 
    mdiAccountDetailsOutline,
    mdiShieldAccountVariantOutline 
} from '@mdi/js';

import UserForm         from './Form.vue';
import DropDownMenu     from '../../components/ui/DropDownMenu.vue';
import NavigationTabs   from '../../components/ui/NavigationTabs.vue';

export default {
    name: 'UserProfile',
    props: {
        'id': {
            type: [String, Number],
            required: true
        }
    },
    provide() {
        return {
            modalTitle: 'Редагування користувача',
            modalSubmitCaption: 'Зберегти'
        }
    },
    data() {
        return {
            user: {},
            formData: {
                id: null,
                name: '',
                user_name: '',
                email: '',
                position: '',
            },
            tabs: [
                {
                    tabName: 'MainInfo',
                    iconPath: mdiAccountDetailsOutline,
                    title: 'Головна інформація',
                    activeTab: true
                },
                {
                    tabName: 'Roles',
                    iconPath: mdiShieldAccountVariantOutline,
                    title: 'Ролі',
                    activeTab: false
                },                
            ],            
            roles: [],
            currentTab: 'MainInfo',
            rolesIsEditable: false,
        }
    },
    methods: {
        fetchUser() {
            axios.get(`/api/v1/users/${this.id}`)
                .then(res => {
                    this.user = res.data.data;
                })
        },
        fetchRoles() {
            axios.get('/api/v1/roles')
                .then(res => {
                    this.roles = res.data.data
                })
        },
        switchTab(tabName) {
            this.currentTab = tabName;
            this.tabs.forEach(t => {
                if (t.tabName == tabName) {
                    t.activeTab = true;
                } else {
                    t.activeTab = false;
                }
            });
            
        },
        imageSelected(event) {
            console.log(event)
            let preview = document.getElementById('userPhotoPreview');
            const [file] = event.target.files;
            if (file) {
                preview.src = URL.createObjectURL(file)
                let data = new FormData();
                // data.append('user_id', this.id);
                data.append('photo', event.target.files[0]);
                let _url = `/api/v1/users/${this.id}/upload-photo`;
                let config = {
                        headers : {
                            'Content-Type' : 'multipart/form-data'
                        }
                    }
                axios.post(
                        _url,
                        data,
                        config
                    ).then(res => {
                        if (res.status == 200) {
                            this.fetchUser()
                            this.$toast(res.data.message);
                        }
                    }
                )
            }
        },
        uploadImage(data) {
            axios.post(
                    URL,
                    data,
                    config
                ).then(res => {
                    if (res.status == 200) {
                        this.fetchUser()
                        this.$toast(res.data.message);
                    }
                  }
                )
        },
        editUser() {
            this.formData.id        = this.user.id;
            this.formData.name      = this.user.name;
            this.formData.user_name = this.user.user_name;
            this.formData.email     = this.user.email;
            this.formData.position  = this.user.position

                // this.formData = Object.assign({}, this.user);

            var userForm = new Modal(document.getElementById('UserForm'))
            userForm.show();

        },
        editRoles() {
            this.rolesIsEditable = true;

        },
        cancelEditRoles() {
            this.rolesIsEditable = false;
            this.fetchUser();
        },
        assignRoles() {
            let data = {
                roles: this.user.roles.join(',')
            }

            axios.post(`/api/v1/users/${this.user.id}/roles`, data)
                .then(res => {
                    this.$toast(res.data.message);
                    this.fetchUser();
                    this.rolesIsEditable = false;
                })
                .catch(err => {
                    this.fetchUser();
                })
        },
        deleteUser(id) {
            this.$confirmDelete('Ви дійсно бажаєти видалити користувача')
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`/api/v1/users/${id}`)
                            .then(res => {
                                this.$toast(res.data.message);
                                this.$router.push({name: 'users'});
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити роль', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        }
    },
    computed: {
        userPhotoPath() {
            // console.log(this.board.logo);
            return this.user.photo  ? `/users/${this.user.photo}` : '/users/no-photo.jpg';
        },
        // componentProps() {
        //     if (this.currentTab == 'MainInfo') {
        //         return {
        //             user: Object.assign({}, this.user),
        //         }
        //     }
        //     if (this.currentTab == 'Roles') {
        //         return {
        //             roles: this.roles,
        //             userRoles: this.user.roles,
        //         }
        //     }
        // },
    },
    created() {
        this.fetchUser();
        this.fetchRoles();
    },
    components: {
        UserForm,
        DropDownMenu,
        NavigationTabs
        // Roles,
        // MainInfo
        // Checkbox
    }
}

</script>

<style lang="scss" scoped>

.photo {
    max-width: 300px;
    max-height: 300px;
    width: 300px;
    height: 300px;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
    border: 1px solid #ccc;
    overflow: hidden;
    // display: flex;
    // justify-content: center;
    // align-items: center;
    // background: #f8f9fa;

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    span {
        color: #888;
    }
}

</style>
