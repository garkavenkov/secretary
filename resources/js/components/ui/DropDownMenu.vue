<template>
    
    <div class="dropdown">

        <button :class="finalClass"                
                data-bs-toggle="dropdown"
                aria-expanded="false">
            <SvgIcon type="mdi" :path="pathMdiCog" :size="buttonIconSize"/>    
        </button>                

        <ul class="dropdown-menu dropdown-menu-end">
            <slot />
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
        buttonIconSize: {
            type: [String, Number],
            required: false,
            default: 16
        },
        menuIconSize: {
            type: [String, Number],
            required: false,
            default: 16
        },
        buttonClass: {
            type: [String, Array],
            required: false,
            default: ''
        },
        showToggler: {
            type: Boolean,
            required: false,
            default: () => true
        },
        divideItems: {
            type: Boolean,
            required: false,
            default: () => true
        }
    },
    components: {
        SvgIcon,        
    },
    emits: ['edit', 'delete'],
    data() {
        return  {            
            pathMdiCog: mdiCog,         
            pathMdiPencil: mdiPencil,
            pathMdiTrashCan: mdiTrashCan,
        }
    },
    computed: {
        finalClass() {
            let toggler = '';
            if (this.showToggler) {
                toggler = 'dropdown-toggle'
            }
            let tmpClass = `btn ${toggler} px-2 py-1 ms-1 me-1`;

            if (this.buttonClass.isArray) {
                return tmpClass + this.buttonClass.join(' ');
            } else {
                return `${tmpClass} ${this.buttonClass}`;
            }
        }
    }
}

</script>

<style lang="scss" scoped>

.dropdown {   

    .dropdown-item {
        
        display: flex;
        align-items: center;

        &:hover {
            background-color: var(--bs-secondary-bg);
        }
    }


}
</style>