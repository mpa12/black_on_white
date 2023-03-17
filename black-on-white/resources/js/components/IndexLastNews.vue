<template>
    <div class=w-100 v-if="articles.length">
        <div class="w-100 marquee">
            <vue-marquee :marquee-props="marqueeProps">
                Последние новости Последние новости Последние новости&nbsp;
            </vue-marquee>
        </div>
        <div class="d-flex align-items-center gap-3 flex-lg-row flex-column">
            <div v-for="article in articles" class=news_wrapper :style="{ backgroundImage: 'url(' + article.photo + ')' }">
                <div class=news_card>
                    <h2>{{ article.title }}</h2>
                    <p class=flex-grow-1>{{ article.description }}</p>
                    <v-button title=Смотреть :href="'/article/' + article.id" :is-black=false></v-button>
                </div>
                <div class=news_card>
                    <h2>{{ article.title }}</h2>
                    <p class=flex-grow-1>{{ article.description }}</p>
                    <v-button title=Смотреть :href="'/article/' + article.id" :is-black=false></v-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueMarquee from 'vue-marquee-text-component';
import axios from "axios";

export default {
    name: "IndexLastNews",
    components: {
        VueMarquee,
    },
    data() {
        return {
            marqueeProps: {
                allowCss3Support: true,
                css3easing: 'linear',
                easing: 'linear',
                delayBeforeStart: 0,
                direction: 'left',
                duplicated: true,
                duration: 1000,
                gap: 10,
            },
            articles: []
        };
    },
    mounted() {
        this.loadLastNews()
    },
    methods: {
        loadLastNews() {
            axios.get('/api/article/two-last').then(response => {
                this.articles = response.data['data']
            })
        }
    }
}
</script>

<style scoped>
.marquee {
    overflow: hidden;
    margin-top: 80px;
    margin-bottom: 20px;
}

.marquee div {
    color: var(--my-black);
    font-size: 38px;
    font-weight: 600;
}

.marquee .marquee-text-text {
    padding-left: 10px!important;
}

.news_wrapper {
    width: 50%;
    border-radius: 20px;
    background-position: center;
    background-size: cover;
    height: 350px;
    overflow: hidden;
}

.news_wrapper:hover {
    position: relative;
    top: -5px;
    box-shadow: 0 1rem 2rem 0 rgb(0 0 0 / 40%);
}

.news_card {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
}

.news_card h2 {
    display: flex;
    color: var(--my-white);
    opacity: 0;
}

.news_card p {
    margin-top: 10px;
    display: flex;
    color: var(--my-white);
    opacity: 0;
}

.news_card .btn {
    display: none;
}

.news_card:hover .btn {
    display: flex;
}

.news_wrapper:hover .news_card {
    backdrop-filter: brightness(.5);
    transition: backdrop-filter .3s ease-in-out;
}

.news_wrapper:hover h2,
.news_wrapper:hover p,
.news_wrapper:hover a {
    opacity: 1;
    transition: display .3s ease-in-out;
}

@media(max-width: 992px) {
    .news_wrapper {
        width: 100%;
    }
}
</style>
