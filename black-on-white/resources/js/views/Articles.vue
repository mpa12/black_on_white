<template>
    <div class="w-100 gap-3 d-flex flex-column">
        <article-search />
        <article-card v-for="article in articles" :article="article" :key="article.id"></article-card>
        <div v-if="loading" class="text-center">Loading...</div>
    </div>
</template>

<script>
import ArticleSearch from "../components/ArticleSearch.vue";
import ArticleCard from "../components/ArticleCard.vue";
import axios from "axios";

export default {
    name: "Articles",
    components: { ArticleCard, ArticleSearch },
    data() {
        return {
            articles: [],
            page: 1,
            loading: false,
            totalPages: null
        }
    },
    mounted() {
        this.loadLastNews()
        window.addEventListener('scroll', this.handleScroll)
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        loadLastNews() {
            this.loading = true
            axios.get('/api/article?page=' + this.page).then(response => {
                this.articles = [...this.articles, ...response.data['data']]
                this.totalPages = response.data['meta'].last_page
                this.loading = false
            })
        },
        handleScroll() {
            if (this.loading) return
            if (window.pageYOffset + window.innerHeight >= document.body.offsetHeight) {
                if (this.page < this.totalPages) {
                    this.page += 1
                    this.loadLastNews()
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
