<template>
    <div class="d-flex align-items-center justify-content-end">
        <span style="line-height: 24px;">{{year}}</span>
        <div class="dropdown">                                     

            <IconButton 
                :buttonClass="['btn-sm btn-light btn-transparent ms-1 me-1 p-2']" 
                data-bs-toggle="dropdown"
                aria-expanded="false"
                :size="buttonIconSize"
                title="Операції з даними за рік"
                :mdiPath="pathMdiCog" />
    
            <ul class="dropdown-menu dropdown-menu-end">
                <slot></slot>
                <li>
                    <a class="dropdown-item d-flex align-items-center" @click="$emit('editYear', year)">
                        <SvgIcon type="mdi" :path="pathMdiPencil" :size="menuIconSize" class="text-warning me-2" />
                        <span>Редагувати дані</span>                                    
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" @click="$emit('deleteYear', year)">
                        <SvgIcon type="mdi" :path="pathMdiTrashCan" :size="menuIconSize" class="text-danger me-2" />
                        <span>Видалити дані</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</template>

<script>

import SvgIcon      from '@jamescoyle/vue-icon';
import { 
    mdiCog, 
    mdiPencil,
    mdiTrashCan
} from '@mdi/js';

import IconButton   from './Buttons/IconButton.vue';

export default {
    name: 'YearDropDownMenu',
    props: {
        year: {
            type: [String, Number],
            required: true
        },
        buttonIconSize: {
            type: [String, Number],
            required: false,
            default: 16
        },
        menuIconSize: {
            type: [String, Number],
            required: false,
            default: 16
        }
    },
    components: {
        SvgIcon,
        IconButton
    },
    emits: ['editYear', 'deleteYear'],
    data() {
        return  {            
            pathMdiCog: mdiCog,         
            pathMdiPencil: mdiPencil,
            pathMdiTrashCan: mdiTrashCan,
        }
    }
}

</script>