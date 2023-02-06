import { Modal } from "bootstrap";

export default {
    methods: {
        newYearData(e) {
            this.modalTitle = 'Додати дані';
            this.modalSubmitCaption = 'Додати';
            this.action = 'create';
            this.yearData.household_id = this.household_id;

            let yearForm = new Modal(document.getElementById(this.yearFormId))
            if (e.ctrlKey) {
                if (this.years.length > 0) {
                    this.yearmData = Object.assign({}, this.years[this.years.length-1]);
                    this.yearData.year = parseInt(this.yearData.year) + 1;
                }
                this.modalTitle = `Додати дані на <b>${this.yearData.year}</b> рік`;
            }
            yearForm.show();
        },
        deleteYear(year) {
            this.$confirmDelete(`Ви дійсно бажаєти видалити дані за ${year.year} рік`)
                .then(res => {
                    if(res.isConfirmed) {
                        axios.delete(`${this.apiUrl}/${year.id}`)
                            .then(res => {
                                this.$store.dispatch('Households/fetchRecord', this.household_id);
                                this.$toast(res.data.message);
                            })
                            .catch(err => {
                                this.$errorMessage('Неможливо видалити дані', err.response.data.message, 'Зрозуміло');
                            });
                    }
                })
        },
        editYear(year) {
            Object.assign(this.yearData, year);

            this.modalSubmitCaption = 'Зберегти';
            this.modalTitle = `Редагувати дані за ${year.year} рік`;
            this.action = 'update';

            var yearForm = new Modal(document.getElementById(this.yearFormId))
            yearForm.show()
        },
    }
}
