<template>
    <div class="article-form-title my-3">
        <h1>Редактирование новости</h1>
    </div>
    <admin-article-form />
</template>

<script>
import AdminArticleForm from "../components/AdminArticleForm.vue";
export default {
    name: "AdminArticleUpdate",
    components: {AdminArticleForm}
}
</script>

<style scoped>
.article-form-title {
    border-radius: 20px;
    padding: 20px;
    background: var(--my-white);
    box-sizing: border-box;
}
</style>
