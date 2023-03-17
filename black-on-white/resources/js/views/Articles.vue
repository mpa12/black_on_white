<template>
    <div class="w-100 gap-3 d-flex flex-column">
        <article-search />
    </div>
</template>

<script>
import ArticleSearch from "../components/ArticleSearch.vue";

export default {
    name: "Articles",
    components: { ArticleSearch }
}
</script>

<style scoped>

</style>
