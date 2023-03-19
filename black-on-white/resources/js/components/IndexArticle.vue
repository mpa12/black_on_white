<template>
    <div class=news_wrapper :style="{ backgroundImage: 'url(' + article.photo + ')' }">
        <div class=news_card>
            <h2>{{ article.title }}</h2>
            <p class=flex-grow-1>{{ article.description }}</p>
            <v-button title=Смотреть :href="'/article/' + article.id" :is-black=false></v-button>
        </div>
    </div>
</template>

<script>
export default {
    name: "IndexArticle",
    props: ['article']
}
</script>

<style scoped>
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
