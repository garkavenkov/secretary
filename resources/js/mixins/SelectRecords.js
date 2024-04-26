export default {
    data() {
        return {
            inSelectMode: false
        }
    },
    methods: {
        // this.entities - holds "name" from vuex store state.entities 
        // members      => HouseholdMembers
        // households   => Households
        // Maybe better refactor in vuex. Call "records" and "record"??
        toggleSelectAll(e) {
            if (e.target.checked) {
                this[this.entities].forEach(r => {                    
                    r.selected = true
                })
            } else {
                this[this.entities].forEach(r => {
                    r.selected = false
                })
            }
        },
        toggleSelectMode() {
            if (!this.inSelectMode) {
                this.inSelectMode = true;
            } else {
                this.inSelectMode = false;
                this[this.entities].forEach(r => r.selected = false);                
            }
        }
    },
    computed: {
        selectedRecords() {
            return this[this.entities].filter(r => r.selected)
        },
        selectedRecordsCount() {
            return this.selectedRecords.length;
        },
        isAllSelected() {
            return this.selectedRecords.length == this[this.entities].length
<<<<<<< HEAD
=======
        },
        isIndeterminate() {
            return (this.selectedRecords.length > 0 && !this.isAllSelected)
>>>>>>> members-filter-by-age
        }
    }
}