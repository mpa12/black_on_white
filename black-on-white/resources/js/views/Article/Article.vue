<template>
    <section class="article-main">
        <h3 class=mb-2>{{ article.title }}</h3>
        <span class=fw-lighter>{{ changeDate(article.created_at) }}</span><br>
        <p class=mt-2>{{ article.description }}</p>
        <img :src="'/storage/' + article.photo" :alt="article.title" class="my-2 mx-auto d-block article-main-img">
        <section class="mt-2 content" v-html="article.text"></section>
    </section>
    <article-rating :article-id=$route.params.id />
    <comments :article_id=$route.params.id />
</template>

<script>
import axios from "axios";
import Comments from "../../components/Comments/Comments.vue";
import ArticleRating from "../../components/ArticleRating.vue";
import {changeDate} from "../../utils/ChangeDate";

export default {
    name: "Article",
    components: {ArticleRating, Comments},
    data() {
        return {
            article: [],
        }
    },
    mounted() {
        this.loadArticle();
    },
    methods: {
        changeDate,
        loadArticle() {
            const url = '/api/article/' + this.$route.params.id;
            axios.get(url).then(response => {
                this.article = response.data['data'];
            })
        },
    }
}
</script>

<style>
.article-main {
    background-color: var(--my-white);
    border-radius: 20px;
    padding: 20px;
}

.article-main-img {
    border-radius: 20px;
    max-height: 400px;
    max-width: 100%;
    width: auto;
}

.content img {
    border-radius: 20px;
    height: 400px;
    max-width: 100%;
    width: auto;
}

.content iframe {
    width: 100%;
    aspect-ratio: 16 / 9;
}
</style>
