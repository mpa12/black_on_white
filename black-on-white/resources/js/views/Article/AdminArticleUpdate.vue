<template>
    <toast v-if=updated title="Новость успешно изменена" />
    <div class="article-form-title my-3">
        <h1>Редактирование новости</h1>
    </div>
    <admin-article-form :key=formKey />
</template>

<script>
import AdminArticleForm from "../../components/AdminArticleForm.vue";
import Toast from "../../components/Toast.vue";

export default {
    name: "AdminArticleUpdate",
    components: { AdminArticleForm, Toast },
    data() {
        return {
            article_id: null,
            updated: false,
            formKey: 0,
        }
    },
    mounted() {
        this.article_id = this.$route.params.id
        window.addEventListener('getData', function (event) {
            this.formData = event.detail.formData
            this.update(this.formData)
        }.bind(this))
    },
    methods: {
        update(formData) {
            axios.post( process.env.VUE_APP_URL + '/api/article/' + this.article_id, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "Authorization" : `Bearer ${localStorage.getItem('token')}`
                }
            }).then(() => {
                this.updated = true
                this.formKey++
            }).catch(error => {
                if (error.response.status === 422) {
                    let errors = JSON.parse(error.request.responseText).errors

                    for (const key in errors) errors[key] = errors[key][0]

                    let evt = new CustomEvent('setErrors', { detail: { errors: errors } })
                    window.dispatchEvent(evt)
                    console.log(errors)
                }
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
