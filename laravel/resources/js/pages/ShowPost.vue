<template>
    <div class="container">
    
    </div>
</template>

<script>
export default {
    name:'ShowPost',
    data(){
        return {
            post: []
        }
    },
    mounted() {
    axios.get('/api/post/' + this.$route.params.slug)
        .then(x => {
            this.post = x.data.results;
            console.log(this.post);
        })  
    },

}
</script>

<style lang="scss" scoped>

</style>