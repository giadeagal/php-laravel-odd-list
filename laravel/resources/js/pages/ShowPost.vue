<template>
    <div class="container">
    <h1 class="mt-3">{{post.title}}</h1>
    <p class="py-3">{{post.content}}</p>
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