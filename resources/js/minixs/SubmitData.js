export default {
    methods: {
        submitData() {
            if (this.action == 'create') {
                axios.post(this.apiUrl, this.formData)
                    .then(res => {
                        this.clearFormData();
                        this.$toast(res.data.message);
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response?.data.errors;
                    })
            } else if (this.action == 'update') {
                axios.patch(`${this.apiUrl}/${this.formData.id}`, this.formData)
                    .then(res => {
                        this.errors = [];
                        this.$toast(res.data.message);
                        this.$emit('refreshData');
                    })
                    .catch(err => {
                        this.errors = err.response?.data.errors;
                    })
            }
        },
    }
}
