export default {
    data() {
        return {
            errors: {}
        }
    },
    methods: {
        getError(field) {
            if (this.errors && this.errors[field]) {
                return this.errors[field][0];
            }
            return '';
        },
        hasError(field) {
            if (this.errors && this.errors[field]) {
                return true;
            }
            return false;
        },
    },
    created() {
        var vm = this;
        var fields = Object.keys(this.formData);

        if (this.excludeFiledsFromCreateWatch) {
            fields = fields.filter(f => !this.excludeFiledsFromCreateWatch.includes(f));
        }

        fields.forEach(function(f) {
            let field = `formData.${f}`
            vm.$watch(field, function() {
                if (this.errors[f]) delete this.errors[f];
            });
        });
    },
}
