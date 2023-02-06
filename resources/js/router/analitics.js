export default [
    {
        path: '/members-by-age',
        name: 'members.by.age',
        component: () => import(/* webpackChunkName: "analitycs" */'../modules/Analityc/MembersByAge.vue'),
        meta: {name: 'Вікові групи населення'}},
    {
        path: '/adulds-and-children',
        name: 'adults.and.children',
        component: () => import(/* webpackChunkName: "analitycs" */'../modules/Analityc/AdultsAndChildren.vue'),
        meta: {name: 'Дорослі і діти'}
    },
]
