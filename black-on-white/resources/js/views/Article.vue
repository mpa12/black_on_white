<template>
    <section class="article-main">
        <h3 class=mb-2>{{ article.title }}</h3>
        <span class=fw-lighter>{{ createdAt }}</span><br>
        <p class=mt-2>{{ article.description }}</p>
        <img :src="article.photo" :alt="article.title" class="my-2 mx-auto d-block article-main-img">
        <section class="mt-2 content" v-html="article.text"></section>
    </section>
    <comments :article_id=$route.params.id />
</template>

<script>
import axios from "axios";
import moment from 'moment/min/moment-with-locales'
import Comments from "../components/Comments.vue";

export default {
    name: "Article",
    components: {Comments},
    data() {
        return {
            article: [],
            createdAt: ''
        }
    },
    mounted() {
        this.loadArticle()
    },
    methods: {
        loadArticle() {
            axios.get('/api/article/' + this.$route.params.id).then(response => {
                this.article = response.data['data']
                this.changeCreatedAt(this.article.created_at)
            })
        },
        changeCreatedAt(createdAt) {
            const date = new Date(createdAt)
            let diff = moment.duration(moment().diff(date))
            if (diff.asMinutes() < 60) {
                let test = (new Date()).getTime() - date.getTime()
                test = (new Date(test)).getMinutes()
                this.createdAt = test + ' минут назад'
            } else if (diff.asHours() < 24) {
                this.createdAt = moment().subtract(diff).format('HH часов назад')
            } else if (diff.asDays() < 2) {
                this.createdAt = moment().subtract(diff).format('Вчера в HH:mm')
            } else {
                moment.locale('ru')
                this.createdAt = moment(date).format('D MMMM в HH:mm YYYY')
            }
        }
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
