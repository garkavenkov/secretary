export default {
    methods: {
        formatedDate(date) {
            return new Date(date).toISOString().slice(0, 10).split('-').reverse().join('.');
        }
    }
}
