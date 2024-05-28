<template>
    
    <div class="dropdown">

        <button :class="finalClass"                
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <SvgIcon type="mdi" :path="dropdownSvgPath" :size="buttonIconSize"/>    
        </button>                

        <ul class="dropdown-menu dropdown-menu-end">
            <slot />
            <template v-if="showActionItems">
                <li>
                    <a  class="dropdown-item"
                        @click="$emit('edit', $event)">
                        <SvgIcon type="mdi" :path="pathMdiPencil" :size="menuIconSize" class="text-warning me-2" />
                        <span>Редагувати дані</span>                    
                    </a>
                </li>
                <li v-if="divideItems"><hr class="dropdown-divider"></li>
                <li>
                    <a  class="dropdown-item"
                        @click="$emit('delete', $event)">
                        <SvgIcon type="mdi" :path="pathMdiTrashCan" :size="menuIconSize" class="text-danger me-2" />
                        <span>Видалити дані</span>
                    </a>
                </li>
            </template>
        </ul>

    </div>

</template>

<script>

import SvgIcon      from '@jamescoyle/vue-icon';
import { 
    mdiCog, 
    mdiPencil,
    mdiTrashCan
} from '@mdi/js';

export default {
    name: 'DropDownMenu',
    emits: ['edit', 'delete'],
    props: {
        buttonSvgPath: {
            type: String,
            required: false,
        },
        buttonIconSize: {
            type: [String, Number],            
            default: 16
        },
        menuIconSize: {
            type: [String, Number],            
            default: 16
        },
        buttonClass: {
            type: [String, Array],            
            default: ''
        },
        showToggler: {
            type: Boolean,            
            default: () => true
        },
        showActionItems: {
            type: Boolean,            
            default: () => true
        },
        divideItems: {
            type: Boolean,            
            default: () => true
        }
    },
    components: {
        SvgIcon,        
    },
    emits: ['edit', 'delete'],
    data() {
        return  {                        
            pathMdiPencil: mdiPencil,
            pathMdiTrashCan: mdiTrashCan,
        }
    },
    computed: {
        dropdownSvgPath() {
            return this.buttonSvgPath ?? mdiCog;
        },
        finalClass() {
            let toggler = '';
            if (this.showToggler) {
                toggler = 'dropdown-toggle'
            }
            // let tmpClass = `btn ${toggler} p-2 ms-2 me-1`;
            let tmpClass = `btn ${toggler}`;
            if (this.buttonClass.isArray) {
                return tmpClass + this.buttonClass.join(' ');
            } else {
                return `${tmpClass} ${this.buttonClass}`;
            }
        }
    }
}

</script>
