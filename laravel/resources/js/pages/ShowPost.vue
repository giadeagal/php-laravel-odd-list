<template>
    <div class="container">

        <h1 class="mt-3">{{post.title}}</h1>

        <h4 v-if="post.category">{{post.category.name}}</h4>

        <p class="py-3">{{post.content}}</p>

        <span class="badge badge-primary p-1 mr-2"
        v-for="tag in post.tags"
        :key="tag.id">
            {{tag.name}}
        </span>

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