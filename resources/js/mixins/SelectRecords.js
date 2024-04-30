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
        },
        selectMultipleRecords(e, id) {            
            if (e.target.checked) {
                let selectedIndex = this.members.findIndex(m => m.id == id);
                
                if (selectedIndex > -1) {
                
                    let previousIndex = this.members
                                                .slice(0,selectedIndex)                
                                                .findLastIndex(m => m.selected == true);
                    
                    if (previousIndex > -1) {
                        for (let i = previousIndex+1; i< selectedIndex; i++) {
                            this.members[i].selected = true;
                        }
                    }
                }
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
        },
        isIndeterminate() {
            return (this.selectedRecords.length > 0 && !this.isAllSelected)
        }
    }
}