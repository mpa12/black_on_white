<template>
    <section class=article-form-section>
        <form @submit.prevent=getData>
            <div class="row mb-3">
                <div class=col>
                    <label for=title class=form-label>Название новости</label>
                    <input v-model=title type=text class=form-control id=title name=title placeholder="Название новости">
                </div>
                <div class=col>
                    <label for=articleType class=form-label>Тип новости</label>
                    <select v-model=articleType class=form-select name=articleType>
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class=mb-3>
                <label for=photo class=form-label>Главное изображение новости</label>
                <input v-on:change=handlePhotoUpload ref=files class=form-control type=file id=photo>
            </div>
            <div class=mb-3>
                <label for=description class=form-label>Краткое описание новости</label>
                <textarea v-model=description class=form-control id=description name=description placeholder="Краткое описание новости"></textarea>
            </div>
            <div class=mb-3>
                <label for=text class=form-label>Текст новости</label>
                <quill-editor v-model:content=text contentType=html theme=snow></quill-editor>
            </div>
            <div class="d-flex gap-2">
                <button type=submit class="btn btn-primary">Сохранить</button>
                <button type=button class="btn btn-secondary">Отмена</button>
            </div>
        </form>
    </section>
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
    name: "AdminArticleForm",
    components: { QuillEditor },
    data() {
        return {
            text: null,
            title: null,
            articleType: null,
            photo: null,
            description: null,
        }
    },
    methods: {
        getData() {
            let formData = new FormData()
            formData.append('text', this.text)
            formData.append('title', this.title)
            formData.append('article_type_id', this.articleType)
            formData.append('photo', this.photo)
            formData.append('description', this.description)

            let evt = new CustomEvent('getData', {
                detail: { formData: formData }
            })
            window.dispatchEvent(evt)
        },
        handlePhotoUpload() {
            this.photo = this.$refs.files.files[0]
        }
    }
}
</script>

<style scoped>
.article-form-section {
    border-radius: 20px;
    padding: 20px;
    background: var(--my-white);
    box-sizing: border-box;
}
</style>
