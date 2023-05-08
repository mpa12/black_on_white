<template>
    <section v-if="canComment || hasComments" class="comments-section mt-3">
        <form v-if=canComment class="d-flex align-items-end gap-2"  @submit.prevent=createComment>
            <div class=flex-grow-1>
                <label class=form-label>Комментарий</label>
                <input type=text class=form-control v-model=body>
            </div>
            <button class="btn btn-dark">Отправить</button>
        </form>

        <p v-if="!hasComments" class="alert alert-light text-center">Нет комментариев</p>

        <comment v-for="parentComment in parentComments" :comment="parentComment" :comments="comments"/>
    </section>
</template>

<script>
import Comment from "./Comment.vue";
import axios from "axios";

export default {
    name: "Comments",
    components: {Comment},
    props: ['article_id'],
    data() {
        return {
            canComment: false,
            hasComments: false,
            comments: [],
            parentComments: [],
            body: null,
            errors: [],
        }
    },
    mounted() {
        this.loadComments()
    },
    methods: {
        checkCanComment() {
            this.canComment = !!localStorage.getItem('token')
        },
        checkHasComments() {
            this.hasComments = !!this.comments
        },
        getParentComments() {
            this.parentComments = this.comments.filter(item => item.parent_id === null)
        },
        loadComments() {
            axios.get(`/api/comment/${this.article_id}`, {
                headers: {"Authorization" : `Bearer ${localStorage.getItem('token')}`}
            }).then(response => {
                this.comments = response.data['data']
                this.checkCanComment()
                this.checkHasComments()
                this.getParentComments()
            })
        },
        createComment() {
            let formData = new FormData()
            formData.append('body', this.body)
            formData.append('article_id', this.article_id)

            axios.post('/api/comment', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "Authorization" : `Bearer ${localStorage.getItem('token')}`
                }
            }).then((response) => {
                this.errors = []
                this.body = null
                this.comments.push(response.data.success)
                this.getParentComments()
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = []
                    let errors = JSON.parse(error.request.responseText).errors
                    for (const key in errors) this.errors[key] = errors[key][0]
                }
            })
        }
    }
}
</script>

<style scoped>
.comments-section {
    border-radius: 20px;
    box-sizing: border-box;
    padding: 20px;
    background: var(--my-white);
}
</style>
