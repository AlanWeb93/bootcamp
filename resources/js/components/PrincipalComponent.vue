<template>
    <div>
        <menu-component/>
        <router-view :token="token"/>
        
    </div>
</template>

<script>
    export default {
        props: {
            token: String
        },
        mounted() {
        }
    }
</script>
