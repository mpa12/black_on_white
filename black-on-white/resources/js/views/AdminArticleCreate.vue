<template>
    <div class="article-form-title my-3">
        <h1>Добавление новости</h1>
    </div>
    <admin-article-form />
</template>

<script>
import AdminArticleForm from "../components/AdminArticleForm.vue";
export default {
    name: "AdminArticleCreate",
    components: {AdminArticleForm},
    data() {
        return {
            formData: null,
        }
    },
    mounted() {
        window.addEventListener('getData', function (event) {
            this.formData = event.detail.formData
            this.create(this.formData)
        }.bind(this))
    },
    methods: {
        create(formData) {
            axios.post( '/api/article', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "Authorization" : `Bearer ${localStorage.getItem('token')}`
                }
            }).then(response => {
                console.log(response)
            }).catch(error => {
                console.log(error)
            })
        }
    }
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
