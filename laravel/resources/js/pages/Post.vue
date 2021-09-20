<template>
    <div class="container">
        <p>pagina {{ currentPage }} di {{ lastPage }}</p>
        <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item" :class="{'disabled' : currentPage===1}">
        <a class="page-link"  @click="getPosts(currentPage - 1)">Previous</a>
    </li>
    <li class="page-item" :class="{'active' : currentPage===1}">
        <a class="page-link" @click="getPosts(1)">1</a>
    </li>
    <li class="page-item" :class="{'active' : currentPage===2}">
        <a class="page-link" @click="getPosts(2)">2</a>
    </li>
    <li class="page-item" :class="{'active' : currentPage===3}">
        <a class="page-link" @click="getPosts(3)">3</a>
    </li>
    <li class="page-item" :class="{'disabled' : currentPage===lastPage}">
        <a class="page-link" @click="getPosts(currentPage + 1)">Next</a>
    </li>
  </ul>
</nav>
        <div class="row">
            <div class="col-6" v-for="post,i in posts" :key="i">
                <div class="card text-center  my-3" >
                <div class="card-header">
                   {{dFormat(post.created_at)}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text">{{truncate(post.content, 50)}}</p>
                    <router-link class="btn btn-primary" 
                    :to="{ name: 'post-details', params: {slug: post.slug}}">
                        Dettagli
                    </router-link>
                </div>
                <div class="card-footer text-muted">
                
                </div>
            </div>
            </div>
        
        </div>
        <nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item" :class="{'disabled' : currentPage===1}">
        <a class="page-link"  @click="getPosts(currentPage - 1)">Previous</a>
    </li>
    <li class="page-item" :class="{'active' : currentPage==={i}}" v-for="i in lastPage" :key="i">
        <a class="page-link" @click="getPosts({i})">{{i}}</a>
    </li>

    <li class="page-item" :class="{'disabled' : currentPage===lastPage}">
        <a class="page-link" @click="getPosts(currentPage + 1)">Next</a>
    </li>
  </ul>
</nav>
    </div>
</template>

<script>

export default{
    name:"Post",
    data() {
        return{
            call: 'http://localhost:8000/api/posts',
            posts: [],
            currentPage: 1,
            LastPage: null
        }
    },
    created(){
        this.getPosts();
    },
    methods: {
        getPosts(pagenum){
            axios.get(this.call, {
                params: {
                    page: pagenum
                }
            })
                .then(x => {
                    this.posts = x.data.content.data;
                    this.currentPage = x.data.content.current_page;
                    this.lastPage = x.data.content.last_page;
                })
        },
        truncate(x, y){
            if (x.length > y){
                return x.substr(0, y) + "...";
            }

            return x
        },
        dFormat(d){
            const date = new Date(d);

            let day = date.getDate();
            if(day < 10){
                day = '0' + day;
            }

            let month = parseInt(date.getMonth() + 1);
            if(month < 10){
                month = '0' + month;
            }

            return day + " / " + month + " / " + date.getFullYear();
        }
    }
}
</script>

<style lang="scss" scoped>

</style>