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
import Loader from "../../components/Loader.vue";
import ArticleService from "../../services/api/ArticleService";

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
        };
    },
    mounted() {
        this.loadArticles();
        window.addEventListener('scroll', this.handleScroll);
        window.addEventListener('search', function (event) {
            this.selectedFilters = [...event.detail.selectedFilters];
            this.text = event.detail.text;
            this.articles = [];
            this.page = 1;
            this.loadArticles();
        }.bind(this));
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        async loadArticles() {
            this.loading = true;

            const response = await ArticleService.index(
                this.page,
                this.text,
                this.selectedFilters,
                this.articles
            );

            this.articles = response.articles;
            this.totalPages = response.totalPages;
            this.loading = false;
        },
        handleScroll() {
            if (this.loading) return;
            if (!(window.pageYOffset + window.innerHeight >= document.body.offsetHeight)) return;
            if (this.page >= this.totalPages) return;

            this.page += 1;
            this.loadArticles();
        }
    }
}
</script>

<style scoped>

</style>
