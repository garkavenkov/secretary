<template>
    
    <div class="page-not-found">
        <img :src="resource" alt="">            
        <span>
            {{ message }}
        </span>
        <router-link :to="{name: fallbackUrl}" class="btn btn-primary">
            {{fallbackUrlMessage}}
        </router-link>
    </div>    
    
</template>


<script>
export default {
    name: 'Page404',
    props: {
        'message': {
            type: String,
            required: false,
            default: 'Вибачте, ми не змогли знайти цю сторінку.'
        },
        'fallbackUrl': {
            type: String,
            required: false,
            default: 'Dashboard'
        },
        'fallbackUrlMessage': {
            type: String,
            required: false,
            default: 'Повернутись на головну сторінку'
        },        
        'resource': {
            type: String,
            required: false,
            default: 'img/404/url.png'
        }
    }
    
}

</script>


<style lang="scss" scoped>



.page-not-found {    

    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: center;    
    align-items: center;
    gap: 2rem;
    margin-top: 60px;
    
    img {
        width: 400px;
        height: 400px;
        object-fit: contain;
    }
    
    span {
        font-size: 1.5rem;
    }

}

</style>