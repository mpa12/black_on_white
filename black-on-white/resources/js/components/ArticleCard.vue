<template>
    <div class="newses__card col-12 d-flex flex-column flex-lg-row">
        <div class="col-lg-6 col-12 newses__card-desc">
            <time>{{ changeDate(article.created_at) }}</time>
            <h1>{{ article.title }}</h1>
            <span class=newses__card-tag>{{ article.article_type.title }}</span>
            <img :src="'/storage/' + article.photo" :alt="article.title" class="d-lg-none d-block">
            <p>{{ article.description }}</p>
            <v-button class="mt-auto" title="Смотреть новость" :href="'/article/' + article.id"></v-button>
        </div>
        <div class="col-lg-6 col-12 newses__card-photo d-none d-lg-block">
            <img :src="'/storage/' + article.photo" :alt="article.title">
        </div>
    </div>
</template>

<script>
import VButton from "./Button.vue";
import {changeDate} from "../utils/ChangeDate";

export default {
    name: "ArticleCard",
    components: { VButton },
    props: ['article'],
    methods: {
        changeDate,
    }
}
</script>

<style scoped>
.newses__card {
    background-color: var(--my-white);
    border-radius: 20px;
    padding: 20px;
}

.newses__card .newses__card-desc {
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: flex-start;
    padding-right: 20px;
}

.newses__card .newses__card-desc time {
    font-size: 14px;
    color: var(--my-gray);
}

.newses__card .newses__card-desc h1 {
    font-size: 32px;
    margin-bottom: 0;
    color: var(--my-black);
}

.newses__card .newses__card-desc .newses__card-tag {
    font-size: 13px;
    padding: 5px 10px;
    border: 1px solid var(--my-black);
    border-radius: 5px;
    color: var(--my-black);
    align-self: flex-start;
    user-select: none;
}

.newses__card .newses__card-desc img {
    border-radius: 20px;
}

.newses__card .newses__card-desc p {
    color: var(--my-black);
    margin-bottom: 0;
}

.newses__card .newses__card-desc a {
    height: 40px;
    padding: 10px 20px;
    border-radius: 20px;
    background-color: var(--my-black);
    color: var(--my-white);
    display: flex;
    align-items: center;
}

.newses__card .newses__card-desc a:hover {
    background-color: var(--my-gray);
}

.newses__card .newses__card-photo img {
    width: 100%;
    height: auto;
    border-radius: 20px;
}

@media(max-width: 992px) {
    .newses__card .newses__card-desc {
        padding-right: 0;
    }
}
</style>
