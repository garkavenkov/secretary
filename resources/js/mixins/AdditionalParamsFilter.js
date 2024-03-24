export default {
    data() {
        return {
            params: []
        }
    },
    methods: {
        fetchAdditionalParamsForFilter(category_code, value_type) {
            axios.get(`/api/v1/additional-params?value_type_code=${value_type}&category_code=${category_code}`)
                .then(res => {
                    this.params = res.data.data;
                })
        }
    }
}