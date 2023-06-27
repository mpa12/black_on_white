<template>
    <toast v-if=created title="Новость успешно добавлена" />
    <div class="article-form-title my-3">
        <h1>Добавление новости</h1>
    </div>
    <admin-article-form :key=formKey />
</template>

<script>
import AdminArticleForm from "../../components/AdminArticleForm.vue"
import Toast from "../../components/Toast.vue"
import User from "../../models/User";

export default {
    name: "AdminArticleCreate",
    components: { AdminArticleForm, Toast },
    data() {
        return {
            formData: null,
            created: false,
            formKey: 0
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
            const url = '/api/article';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization: User.getAuthorizationString()
                }
            };
            axios.post(url, formData, config).then(() => {
                this.created = true
                this.formKey++
            }).catch(error => {
                if (error.response.status === 422) {
                    let errors = JSON.parse(error.request.responseText).errors

                    for (const key in errors) errors[key] = errors[key][0]

                    let evt = new CustomEvent('setErrors', { detail: { errors: errors } })
                    window.dispatchEvent(evt)
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
