<template>
    <section class="w-100 section mt-3">
        <span role=button class=me-2 @click=updateRating(this.articleId)>
            <img :src="getImageSrc(isRated)" :alt="getImageAlt(isRated)">
        </span>
        <span>{{ rating }}</span>
    </section>
</template>

<script>
import axios from "axios";
import User from "../models/User";

export default {
    name: "ArticleRating",
    props: ['articleId'],
    data() {
        return {
            rating: 0,
            isRated: false,
        }
    },
    mounted() {
        this.getRating(this.articleId);
    },
    methods: {
        getRating(articleId) {
            axios.get(process.env.VUE_APP_URL + `/api/rating/${articleId}`, {
                headers: { Authorization: User.getAuthorizationString() }
            }).then(this.setRating).catch(console.error)
        },
        getImageSrc(isRated) {
            return isRated ? '/images/heart-fill.svg' : '/images/heart.svg';
        },
        getImageAlt(isRated) {
            return isRated ? 'Понравилось' : 'Лайкнуть';
        },
        updateRating(articleId) {
            if (User.isGuest()) return;

            this.rating += this.isRated ? -1 : 1;
            this.isRated = !this.isRated;

            let formData = new FormData()
            formData.append('create_rating', this.isRated ? 1 : 0)
            formData.append('article_id', articleId)

            axios.post(process.env.VUE_APP_URL + '/api/rating', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization: User.getAuthorizationString()
                }
            }).then(this.setRating).catch(console.error)
        },
        setRating(response) {
            this.rating = response.data.rating;
            this.isRated = response.data.isRated;
        }
    }
}
</script>

<style scoped>
.section {
    border-radius: 20px;
    box-sizing: border-box;
    padding: 20px;
    background: var(--my-white);
}
</style>
