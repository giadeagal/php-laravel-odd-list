<template>
    <div class="badge-wrapper" v-if="tags">
        <span class="badge badge-primary p-1 mr-2"
        v-for="tag,i in tags" :key="i">
            {{tag.name }}
        </span>
    </div>
</template>

<script lang="ts">


export default{
    name: "Tag",
    props:{
        tags: Array
    }
}
</script>

<style lang="scss" scoped>

</style>