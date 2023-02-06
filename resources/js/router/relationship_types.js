export default [
    {
        path: '/family-relationship-types',
        name: 'family.relationship.types',
        component: () => import(/* webpackChunkName: "relationships-types" */'../modules/FamilyRelationshipTypes/Main.vue'),
        meta: {name: 'Типи родинні стосунків'}
    },
]
