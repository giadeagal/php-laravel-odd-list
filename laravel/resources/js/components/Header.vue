<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <router-link class="navbar-brand"
                :to="{ name: 'home' }" >
                    Boolpress
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <router-link class="nav-item nav-link" 
                        v-for="obj,i in navList" :key="i"
                        :to="{ name: obj.routeName}">
                            {{ obj.label }}
                        </router-link>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>

export default{
    name: "Header",
    data() {
        return {
            navList: [
                {
                    label: "Home",
                    routeName: "home"
                },
                {
                    label: "Chi siamo",
                    routeName: "about"
                },
                {
                    label: 'Posts',
                    routeName:"post"
                },
                {
                    label: "Contatti",
                    routeName: "contact"
                }
            ]
        }
    }
}
</script>

<style lang="scss">
    
</style>