<template>

    <div>
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

</template>

<script>

export default {
    name: 'MainInfoTab',
    props: {
        'user': {
            type: Object,
            required: true
        }
    },
    data() {
        return {}
    }
}

</script>
