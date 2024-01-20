<template>
    <toast v-if=updated title='Новость успешно изменена' />
    <div class='article-form-title my-3'>
        <h1>Редактирование новости</h1>
    </div>
    <admin-article-form :key=formKey :callback={update} :errors={errors} />
</template>

<script>
import AdminArticleForm from "../../components/AdminArticleForm.vue";
import Toast from "../../components/Toast.vue";
import User from "../../models/User";

export default {
    name: 'AdminArticleUpdate',
    components: { AdminArticleForm, Toast },
    data() {
        return {
            article_id: null,
            updated: false,
            formKey: 0,
            errors: {},
        }
    },
    mounted() {
        this.article_id = this.$route.params.id
    },
    methods: {
        update(formData) {
            axios.post(
                '/api/article/' + this.$route.params.id,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Authorization' : User.getAuthorizationString()
                    }
                }
            )
                .then(() => {
                    this.updated = true
                    this.formKey++
                })
                .catch(this.updateErrorHandler);
        },
        updateErrorHandler(error) {
            if (error.response.status === 422) {
                let errors = JSON.parse(error.request.responseText).errors;

                for (const key in errors) errors[key] = errors[key][0];

                this.errors = errors;
            }
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
