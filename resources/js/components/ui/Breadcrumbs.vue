<template>
    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li v-for="(item, index) in breadcrumbs"
                :key="index"
                class="breadcrumb-item">
                <router-link>{{ item.name }}</router-link>
            </li>
        </ol>
    </nav> -->
    <ul class="breadcrumbs" v-if="breadcrumbs.length > 0">
        <li v-for="(item, index) in breadcrumbs"
            :key="index"
            class="item"
            :class="{'disabled': index == breadcrumbs.length-1}">
                <router-link :to="item.path" v-if="item.icon" v-html="item.icon"></router-link>
                <router-link :to="item.path" v-else>{{item.name}}</router-link>
        </li>
        <!-- <li class="right" v-if="link.path">
            <router-link :to="link.path">{{link.name}}</router-link>
        </li> -->
    </ul>
</template>

<script>
export default {
    name: 'Breadcrumbs',
    props: {
        'link': {
            type: Object,
            required: false,
            default: () => ({name: '', path: ''})
        }
    },
    data() {
        return {
           breadcrumbs: [] ,
        }
    },
    created() {
        let currentPath = this.$route;

        let routes = this.$router.options.routes.filter(route => currentPath.matched[0].path.includes(route.path));
        this.breadcrumbs =  routes.map((route, index) => {
            // console.log(route);
            if (route.meta.icon) {
                // console.log(index, route.meta.icon, route.path)
                return {
                    icon: route.meta.icon,
                    path: (index + 1 != routes.length) ? route.path : currentPath.fullPath
                }
            }
            if (route.meta.name) {
                // console.log(index, route.meta.name, route.path)
                return {
                    name: route.meta.name,
                    path: (index + 1 != routes.length) ? route.path : currentPath.fullPath
                }
            }
        })
    }

}
</script>


<style lang="scss" scoped>

.breadcrumbs {
    display: flex;
    flex-wrap: wrap;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    list-style: none;
    background-color: #e9ecef;
    border-radius: 0.25rem;
    position: relative;

    li {

        a {
            font-size: 16px;
        }

        &.item {

            &.disabled {
                pointer-events: none;

                a {
                    text-decoration: none;
                    color: grey;
                }
            }

            &:not(:first-child):before {
                content: '/';
                padding-left: 0.5rem;
                padding-right: 0.5rem;
                color: grey;
            }
        }

        &.right {
            position: absolute;
            right: 1rem;
        }
    }
}



</style>
