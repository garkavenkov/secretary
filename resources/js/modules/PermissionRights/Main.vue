<template>

    <breadcrumbs />

    <!-- <div class="card">
        <div class="card-body"> -->
            <div class="row">
                <!-- <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                            :class="{'active': rightsFor == 'role'}"
                                            @click="rightsFor = 'role'">
                                        <span class="mdi mdi-shield-account-variant-outline me-1"></span>
                                        Ролі
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary  btn-transparent"
                                            :class="{'active': rightsFor == 'user'}"
                                            @click="rightsFor = 'user'">
                                        <span class="mdi mdi-account-supervisor-outline me-1"></span>
                                        Користувачі
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div>
                                    <select class='form-control'
                                            id="role"
                                            v-model="ownerId">
                                        <option value="0" disabled>{{chooseOwner}}</option>
                                        <option :value="owner.id" v-for="owner in owners" :key="owner.id">
                                            {{owner.name}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-sm btn-outline-secondary"
                                            :disabled="ownerId == 0" title="Отримати перелік дозволів"
                                            @click="fetchOwnerPermissions">
                                        <span class="mdi mdi-account-key-outline"></span>
                                        Дозволи
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">Керування правами дозволу для</span>
                                        <button class="btn btn-sm btn-outline-primary btn-transparent1"
                                                :class="{'active': rightsFor == 'role'}"
                                                @click="rightsFor = 'role'">
                                            <span class="mdi mdi-shield-account-variant-outline me-1"></span>
                                            ролей
                                        </button>
                                        <span class="mx-2">
                                            /
                                        </span>
                                        <button class="btn btn-sm btn-outline-primary btn-transparent1"
                                                :class="{'active': rightsFor == 'user'}"
                                                @click="rightsFor = 'user'">
                                            <span class="mdi mdi-account-supervisor-outline me-1"></span>
                                            користувачів
                                        </button>
                                        <div class="ms-3">
                                            <select class='form-select'
                                                    style="padding: 0.175rem 2.5rem 0.175rem 1rem; width: 250px;"
                                                    id="role"
                                                    v-model="ownerId">
                                                <option value="0" disabled>{{chooseOwner}}</option>
                                                <option :value="owner.id" v-for="owner in owners" :key="owner.id">
                                                    {{owner.name}}
                                                </option>
                                            </select>
                                        </div>
                                        <!-- <button class="btn btn-sm btn-outline-primary ms-2"
                                                :disabled="ownerId == 0" title="Отримати перелік дозволів"
                                                @click="fetchOwnerPermissions">
                                            <span class="mdi mdi-account-key-outline me-1"></span>
                                            Дозволи
                                        </button> -->
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-outline-danger"
                                                title="Відмінити редагування прав"
                                                v-if="inEditMode"
                                                @click="cancelEditingPermissionRights">
                                                <span class="mdi mdi-pencil-off-outline me-1"></span>
                                            Відмінити
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary btn-transparent"
                                                title="Редагування прав дозволу"
                                                v-if="!inEditMode && permissions.length > 0"
                                                @click="editPermissionRights">
                                                <span class="mdi mdi-pencil-outline me-1"></span>
                                            Редагувати
                                        </button>
                                        <button class="btn btn-sm btn-outline-success ms-2"
                                                title="Встановити права дозволи"
                                                v-if="inEditMode"
                                                :disabled="!readyForGrantPermission"
                                                @click="grantPermission">
                                                <span class="mdi mdi-content-save-outline me-1"></span>
                                            Встановити
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top pt-3">
                                <DataTable
                                        v-if="permissions.length > 0"
                                        :dataTable="permissions"
                                        tableClass="table-sm table-bordered">
                                    <template v-slot:header>
                                        <tr>
                                            <th rowspan="2" class="align-middle">Назва</th>
                                            <th colspan="4" class="text-center">Дозвіл</th>
                                        </tr>
                                        <tr>
                                            <th class="crud-title">
                                                читання
                                                <!-- <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                                        :class="{'active' : allReadGranted}"
                                                        :disabled="!inEditMode"
                                                        :title="allReadGranted ? 'Відмінити всі' : 'Обрати всі'"
                                                        @click="toggleAction('read')">
                                                    <span class="mdi mdi-check-all"></span>
                                                </button> -->
                                                <a  @click="toggleAction('read')"
                                                    :title="allReadGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл'"
                                                    :class="{'toggle-rights__disabled' : !inEditMode, 'toggle-rights__all': allReadGranted }">
                                                    <span class="mdi mdi-check-all"></span>
                                                </a>
                                            </th>
                                            <th class="crud-title">
                                                створення
                                                <!-- <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                                        :class="{'active' : allCreateGranted}"
                                                        :disabled="!inEditMode"
                                                        :title="allCreateGranted ? 'Відмінити всі' : 'Обрати всі'"
                                                        @click="toggleAction('create')">
                                                    <span class="mdi mdi-check-all"></span>
                                                </button> -->
                                                <a  @click="toggleAction('create')"
                                                    :title="allCreateGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл'"
                                                    :class="{'toggle-rights__disabled' : !inEditMode, 'toggle-rights__all': allCreateGranted }">
                                                    <span class="mdi mdi-check-all"></span>
                                                </a>
                                            </th>
                                            <th class="crud-title">
                                                редагування
                                                <!-- <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                                        :class="{'active' : allUpdateGranted}"
                                                        :disabled="!inEditMode"
                                                        :title="allUpdateGranted ? 'Відмінити всі' : 'Обрати всі'"
                                                        @click="toggleAction('update')">
                                                    <span class="mdi mdi-check-all"></span>
                                                </button> -->
                                                <a  @click="toggleAction('update')"
                                                    :title="allUpdateGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл'"
                                                    :class="{'toggle-rights__disabled' : !inEditMode, 'toggle-rights__all': allUpdateGranted }">
                                                    <span class="mdi mdi-check-all"></span>
                                                </a>
                                            </th>
                                            <th class="crud-title">
                                                видалення
                                                <!-- <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                                        :class="{'active' : allDeleteGranted}"
                                                        :disabled="!inEditMode"
                                                        :title="allDeleteGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл'"
                                                    >
                                                    <span class="mdi mdi-check-all"></span>
                                                </button> -->
                                                <a  @click="toggleAction('delete')"
                                                    :title="allDeleteGranted ? 'Скаcувати дозвіл' : 'Надати дозвіл'"
                                                    :class="{'toggle-rights__disabled' : !inEditMode, 'toggle-rights__all': allDeleteGranted}">
                                                    <span class="mdi mdi-check-all"></span>
                                                </a>
                                            </th>
                                        </tr>
                                    </template>
                                    <template v-slot:default="slotProps">
                                        <tr     v-for="record in slotProps.paginatedData"
                                                :key="record.id">
                                            <td>
                                                <span>
                                                    {{record.name}}
                                                </span>
                                                <!-- <button class="btn btn-sm btn-outline-secondary btn-transparent"
                                                        :class="{'active': (record.create && record.read && record.update && record.delete)}"
                                                        :disabled="!inEditMode"
                                                        :title="(record.create && record.read && record.update && record.delete) ? 'Скасувати всі дозволи' : 'Надати всі дозволи'"
                                                        @click="toggleRight(record)">
                                                    <span class="mdi mdi-check-all"></span>
                                                </button> -->
                                                <a  @click="toggleRight(record)"
                                                    :title="(record.create && record.read && record.update && record.delete) ? 'Скасувати всі дозволи' : 'Надати всі дозволи'"
                                                    :class="{'toggle-rights__disabled' : !inEditMode, 'toggle-rights__all': (record.create && record.read && record.update && record.delete)}">
                                                    <span class="mdi mdi-check-all"></span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="" id="" v-model="record.read" value="4" :disabled="!inEditMode">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="" id="" v-model="record.create" value="8" :disabled="!inEditMode">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="" id="" v-model="record.update" value="2" :disabled="!inEditMode">
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" name="" id="" v-model="record.delete" value="1" :disabled="!inEditMode">
                                            </td>
                                        </tr>
                                    </template>
                                </DataTable>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div>
    </div> -->

</template>

<script>

import DataTable from '../../components/ui/DataTable.vue';

export default {
    name: 'PermissionRightsMain',
    components: {
        DataTable
    },
    data() {
        return {
            ownerId: 0,
            rightsFor: 'role',
            owners: [],
            permissions: [],
            _permissions: [],
            inEditMode: false
        }
    },
    methods: {
        fetchRoles() {
            axios.get(`/api/v1/roles`)
                .then(res => {
                    this.owners = res.data.data
                })
        },
        fetchUsers() {
            axios.get(`/api/v1/users`)
                .then(res => {
                    this.owners = res.data.data
                })
        },
        fetchOwnerPermissions() {
            axios.get(`/api/v1/granted-permissions?type=${this.rightsFor}&owner=${this.ownerId}`)
                .then(res => {
                    this.permissions = res.data.data
                })
        },
        toggleAction(action) {
            let _action =  action.charAt(0).toUpperCase() + action.slice(1);

            this[`all${_action}Granted`]
                ? this.permissions.forEach(p => p[action] = false)
                : this.permissions.forEach(p => p[action] = true);

        },
        toggleRight(right) {
            let permission = this.permissions.find(p => p.id == right.id);
            if ((right.create && right.read && right.update && right.delete)) {
                permission.create = false;
                permission.read   = false;
                permission.update = false;
                permission.delete = false;
            } else {
                permission.create = true;
                permission.read   = true;
                permission.update = true;
                permission.delete = true;
            }
        },
        editPermissionRights() {
            this.inEditMode = true;
            this._permissions = JSON.parse(JSON.stringify(this.permissions));
        },
        cancelEditingPermissionRights() {
            this.inEditMode = false;
            this.permissions = JSON.parse(JSON.stringify(this._permissions));
        },
        grantPermission() {
            let data = {};

            // if (this.rightsFor == 'role') {
            //     data.owner_type = 'App\\Models\\Role';
            // } else if (this.rightsFor == 'user') {
            //     data.owner_type = 'App\\Models\\User';
            // } else {
            //     return;
            // }
            data.owner_type = this.rightsFor;

            if (this.ownerId !=0) {
                data.owner = this.ownerId;
            } else {
                return;
            }

            data.rights = this.permissions.map(p => {
                let right = 0;
                if (p.create) right += 8;
                if (p.read) right += 4;
                if (p.update) right += 2;
                if (p.delete) right += 1;
                return `${p.id}:${right}`;

            }).join(',');
            // console.log(data);
            axios.post(`/api/v1/grant-permissions`, data)
                .then(res => {
                    if (res.status == 200) {
                        this.$toast(res.data.message);
                        this.fetchOwnerPermissions();
                        this.inEditMode = false;
                    }
                })
        }
    },
    computed: {
        chooseOwner() {
            if (this.rightsFor == 'role') {
                return 'оберіть роль'
            }
            if (this.rightsFor == 'user') {
                return 'оберіть користувача'
            }
        },
        allReadGranted() {
            return !this.permissions.some(p => !p.read);
        },
        allCreateGranted() {
            return !this.permissions.some(p => !p.create);
        },
        allUpdateGranted() {
            return !this.permissions.some(p => !p.update);
        },
        allDeleteGranted() {
            return !this.permissions.some(p => !p.delete);
        },
        readyForGrantPermission() {
            return JSON.stringify(this.permissions) != JSON.stringify(this._permissions);
        }
    },
    watch: {
        rightsFor(newVal) {
            if (newVal == 'role') {
                this.ownerId = 0;
                this.fetchRoles();
            } else if (newVal == 'user') {
                this.ownerId = 0;
                this.fetchUsers();
            }
        },
        ownerId(newVal) {
            if (newVal !== 0) {
                this.fetchOwnerPermissions();
            }
        }
    },
    created() {
        this.fetchRoles();
    }
}

</script>


<style lang="scss" scoped>
.crud-title {
    position: relative;
    width: 175px;
    text-align: center;
    vertical-align: middle;
    height: 40px;

    a {
        position: absolute;
        right: 8px;
        top: 6px;
    }
}

table tbody tr {

    vertical-align: middle;

    td:first-of-type {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
}

a:not([href]):not(.toggle-rights__disabled, .toggle-rights__all) {
	color: grey;

    &:hover {
        color: #0076f9;
        font-weight: bold;
        transform: scale(1.1);
    }
}

.toggle-rights__disabled {

    &.toggle-rights__all {
        color: grey;
    }

    color: grey;
    cursor: not-allowed;
    opacity: 0.5;
    text-decoration: none;
    pointer-events: none;
}

.toggle-rights__all {
    font-weight: bold;
    color: #0076f9;
    transform: scale(1.5);
}
</style>
