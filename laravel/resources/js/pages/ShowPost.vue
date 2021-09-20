<template>
    <div class="container my-5">
        <div class="card">
  <div class="card-header">
  </div>
  <div class="card-body">
    <h5 class="card-title">{{post.title}}</h5>
    <p class="card-text"> {{ post.content }}</p>
    <div class="badge bg-primary">{{post.category.name}}</div>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
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
        })  
    },

}
</script>

<style lang="scss" scoped>

</style>