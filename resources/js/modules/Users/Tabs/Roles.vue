<template>

    <div class="form-check " v-for="role in roles" :key="role.id">
        <label class="form-check-label" :for="role.code">{{ role.name }}</label>
        <input class="form-check-input" type="checkbox" :id="role.code" :value="role.id" v-model="userRoles">
    </div>

</template>

<script>

export default {
    name: 'UserRolesTab',
    props: {
        'roles': {
            type: Array,
            required: true
        },
        'userRoles': {
            type: Array,
            required: false,
            default: () => []
        }
    },
    data() {
        return {
            userRoles1: []
        }
    },
}

</script>
