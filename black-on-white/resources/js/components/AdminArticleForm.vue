<template>
    <section class=article-form-section>
        <form @submit.prevent=getData>
            <div class="row mb-3">
                <div class=col>
                    <label for=title class=form-label>Название новости</label>
                    <input v-model=title type=text class=form-control id=title name=title placeholder="Название новости">
                    <small v-if="errors.hasOwnProperty('title')" class=text-danger>{{ errors.title }}</small>
                </div>
                <div class=col>
                    <label for=articleType class=form-label>Тип новости</label>
                    <select v-model=article_type_id class=form-select name=articleType>
                        <option v-for="articleType in articleTypes" :value="articleType.id">{{ articleType.title }}</option>
                    </select>
                    <small v-if="errors.hasOwnProperty('article_type_id')" class=text-danger>{{ errors.article_type_id }}</small>
                </div>
            </div>
            <div class=mb-3>
                <div v-if=installedPhoto class="w-100 d-flex align-items-center justify-content-center">
                    <img :src="'/storage/' + installedPhoto" class=w-50 alt="Главное изображение новости">
                </div>
                <label for=photo class=form-label>Главное изображение новости</label>
                <input v-on:change=handlePhotoUpload ref=files class=form-control type=file id=photo>
                <small v-if="errors.hasOwnProperty('photo')" class=text-danger>{{ errors.photo }}</small>
            </div>
            <div class=mb-3>
                <label for=description class=form-label>Краткое описание новости</label>
                <textarea v-model=description class=form-control id=description name=description placeholder="Краткое описание новости"></textarea>
                <small v-if="errors.hasOwnProperty('description')" class=text-danger>{{ errors.description }}</small>
            </div>
            <div class=mb-3>
                <label for=text class=form-label>Текст новости</label>
                <quill-editor :modules="modules" toolbar=full contentType=html theme=snow v-model:content=text></quill-editor >
                <small v-if="errors.hasOwnProperty('text')" class=text-danger>{{ errors.text }}</small>
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
import ImageUploader from 'quill-image-uploader';
import axios from "axios";

export default {
    name: "AdminArticleForm",
    components: { QuillEditor },
    data() {
        return {
            text: null,
            title: null,
            article_type_id: null,
            photo: null,
            installedPhoto: null,
            description: null,
            articleTypes: [],
            errors: [],
        }
    },
    methods: {
        getData() {
            let formData = new FormData()
            formData.append('text', this.text)
            formData.append('title', this.title)
            formData.append('article_type_id', this.article_type_id)
            formData.append('photo', this.photo)
            formData.append('description', this.description)

            let evt = new CustomEvent('getData', {
                detail: { formData: formData }
            })
            window.dispatchEvent(evt)
        },
        handlePhotoUpload() {
            this.photo = this.$refs.files.files[0]
        },
        loadArticleTypes() {
            axios.get(process.env.VUE_APP_URL + '/api/article-type/').then(response => {
                this.articleTypes = response.data['data']
            })
        },
        loadArticle() {
            let article_id = this.$route.params.id

            if (article_id) {
                axios.get(process.env.VUE_APP_URL + '/api/article/' + article_id).then(response => {
                    this.title = response.data['data'].title
                    this.text = response.data['data'].text
                    this.article_type_id = response.data['data'].article_type.id
                    this.description = response.data['data'].description
                    this.installedPhoto = response.data['data'].photo
                })
            }
        }
    },
    mounted() {
        this.loadArticleTypes()
        window.addEventListener('setErrors', function (event) {
            this.errors = event.detail.errors
        }.bind(this))
        this.loadArticle()
    },
    setup: () => {
        const modules = {
            name: 'imageUploader',
            module: ImageUploader,
            options: {
                upload: file => {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append("image", file);

                        axios.post(process.env.VUE_APP_URL + '/api/article/upload/image', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                "Authorization" : `Bearer ${localStorage.getItem('token')}`
                            }
                        })
                            .then(res => {
                                console.log(res)
                                resolve(res.data.url)
                            })
                            .catch(err => {
                                reject("Upload failed")
                                console.error("Error:", err)
                            })
                    })
                }
            }
        }
        return { modules }
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
