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
            totalPages: null,
            selectedFilters: [],
            text: ''
        }
    },
    mounted() {
        this.loadArticles()
        window.addEventListener('scroll', this.handleScroll)
        window.addEventListener('search', function (event) {
            this.selectedFilters = [...event.detail.selectedFilters] // Массив с id типов статей
            this.text = event.detail.text
            this.articles = [] // очищаем массив статей
            this.page = 1 // начинаем с первой страницы
            this.loadArticles()
        }.bind(this))
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        loadArticles() {
            this.loading = true
            axios.get('/api/article', {
                params: {
                    page: this.page,
                    article_type: this.selectedFilters.join(","),
                    text: this.text,
                }
            }).then(response => {
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
                    this.loadArticles()
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
