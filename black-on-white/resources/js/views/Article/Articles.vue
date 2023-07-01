<template>
    <div class="w-100 gap-3 d-flex flex-column">
        <article-search />
        <article-card v-for="article in articles" :article="article" :key="article.id"></article-card>
        <loader v-if="loading"></loader>
    </div>
</template>

<script>
import ArticleSearch from "../../components/ArticleSearch.vue";
import ArticleCard from "../../components/ArticleCard.vue";
import axios from "axios";
import Loader from "../../components/Loader.vue";

export default {
    name: "Articles",
    components: { Loader, ArticleCard, ArticleSearch },
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
            this.selectedFilters = [...event.detail.selectedFilters]
            this.text = event.detail.text
            this.articles = []
            this.page = 1
            this.loadArticles()
        }.bind(this))
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        loadArticles() {
            this.loading = true

            let params = { page: this.page }
            if (this.text !== '') params['text'] = this.text
            if (this.selectedFilters.length > 0) params['article_type'] = this.selectedFilters.join(",")

            axios.get('/api/article', { params }).then(response => {
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
