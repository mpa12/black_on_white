<template>
    <div class=w-100 v-if="articles.length">
        <div class="w-100 marquee">
            <vue-marquee :marquee-props="marqueeProps">
                Последние новости Последние новости Последние новости&nbsp;
            </vue-marquee>
        </div>
        <div class="d-flex align-items-center gap-3 flex-lg-row flex-column">
            <index-article v-for="article in articles" :article=article></index-article>
        </div>
    </div>
</template>

<script>
import VueMarquee from 'vue-marquee-text-component';
import axios from "axios";
import IndexArticle from "./IndexArticle.vue";

export default {
    name: "IndexLastNews",
    components: { VueMarquee, IndexArticle },
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
</style>
