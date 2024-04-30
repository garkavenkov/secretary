export default {
    state: {
        inSelectMode: false,        
    },
    getters: {
        inSelectMode: state => state.inSelectMode,
        selectedRecords: state => state[state.entities].filter(r => r.selected),                
        selectedRecordsCount: (state,getters) =>  getters.selectedRecords.length,        
        isAllSelected: (state,getters) => getters.selectedRecords.length == state[state.entities].length,        
        isIndeterminate: (state, getters) =>  (getters.selectedRecords.length > 0 && !getters.isAllSelected),
        toggleSelectAllTitle: (state, getters) => getters.isAllSelected ? 'Скинути вібір' : 'Відібрати всі записи'      
    },
    mutations:  {

    },
    actions: {
        toggleSelectAll({state},e) {
            if (e.target.checked) {                
                state[state.entities].forEach(r => {
                    r.selected = true
                })
            } else {                
                state[state.entities].forEach(r => {
                    r.selected = false
                })
            }
        },
        toggleSelectMode({state}) {
            if (!state.inSelectMode) {
                state.inSelectMode = true;
            } else {
                state.inSelectMode = false;
                state[state.entities].forEach(r => r.selected = false);                                
            }
        },
        selectMultipleRecords({state}, {e, id}) {            
            if (e.target.checked) {
                let selectedIndex = state[state.entities].findIndex(m => m.id == id);
                
                if (selectedIndex > -1) {
                
                    let previousIndex = state[state.entities]
                                                .slice(0,selectedIndex)                
                                                .findLastIndex(m => m.selected == true);
                    
                    if (previousIndex > -1) {
                        for (let i = previousIndex+1; i< selectedIndex; i++) {
                            state[state.entities][i].selected = true;
                        }
                    }
                }
            }   
        }
    }
}