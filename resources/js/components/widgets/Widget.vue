<template>
    <div class="card">
        <div class="card-body widget">
            <div>
                <slot name="svgIcon"></slot>
                
            </div>
            <div class="widget-info">
                <span>
                    <slot></slot>
                </span>
                <span>                    
                    <slot name="result"></slot>
                </span>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: 'Widget',    
}

</script>