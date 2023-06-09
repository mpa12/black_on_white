<template>
    <section class="comment mt-2" v-if=!isDeleted>
        <div class="d-flex gap-2 align-items-baseline">
            <h6 class=m-0>{{ comment.user.name }}</h6>
            <time>{{ changeCreatedAt(comment.created_at) }}</time>
        </div>
        <p class=m-0>{{ comment.body }}</p>
        <button type=button class=reply-button @click=showReplyForm v-if=canComment />
        <button type=button class=delete-button @click=deleteComment(comment.id) v-if=canDeleteComment />

        <form class="d-flex gap-2" v-if=replying @submit.prevent=reply>
            <div class=flex-grow-1>
                <label class=form-label>Ответ</label>
                <input v-model=body type=text class=form-control>
            </div>
            <div class="d-flex flex-column justify-content-between align-items-end">
                <button class=reply-cancel type=button @click=hideReplyForm>отмена</button>
                <button class="btn btn-dark">Отправить</button>
            </div>
        </form>
    </section>
    <div>
        <comment v-if=childComments v-for="childComment in childComments" :comment=childComment :comments=comments />
    </div>
</template>

<script>
import moment from 'moment/min/moment-with-locales'
import axios from "axios";

export default {
    name: "Comment",
    props: ['comment', 'comments'],
    data() {
        return {
            canComment: false,
            canDeleteComment: false,
            childComments: null,
            parentComments: [],
            errors: [],
            replying: false,
            isDeleted: false,
            body: null,
        }
    },
    mounted() {
        this.getChildComment()
        this.checkCanComment()
        this.checkCanDeleteComment()
    },
    methods: {
        checkCanComment() {
            this.canComment = !!localStorage.getItem('token')
        },
        checkCanDeleteComment() {
            this.canDeleteComment = this.comment.can_delete
        },
        getChildComment() {
            this.childComments = this.comments.filter(item => item.parent_id === this.comment.id);
        },
        changeCreatedAt(date) {
            date = new Date(date)
            const diff = moment.duration(moment().diff(date))
            if (diff.asMinutes() < 60) {
                let test = (new Date()).getTime() - date.getTime()
                test = (new Date(test)).getMinutes()
                return test + ' минут назад'
            } else if (diff.asHours() < 24) {
                return moment().subtract(diff).format('HH часов назад')
            } else if (diff.asDays() < 2) {
                return moment().subtract(diff).format('Вчера в HH:mm')
            } else {
                moment.locale('ru')
                return moment(date).format('D MMMM в HH:mm YYYY')
            }
        },
        showReplyForm() {
            this.replying = true
        },
        hideReplyForm() {
            this.replying = false
        },
        reply() {
            let formData = new FormData()
            formData.append('body', this.body)
            formData.append('article_id', this.$route.params.id)
            formData.append('parent_id', this.comment.id)

            axios.post(process.env.VUE_APP_URL + '/api/comment', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "Authorization" : `Bearer ${localStorage.getItem('token')}`
                }
            }).then((response) => {
                this.errors = []
                this.body = null
                this.childComments.push(response.data.success)
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = []
                    let errors = JSON.parse(error.request.responseText).errors
                    for (const key in errors) this.errors[key] = errors[key][0]
                }
            })
        },
        deleteComment(commentId) {
            axios.delete(process.env.VUE_APP_URL + '/api/comment/' + commentId, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "Authorization" : `Bearer ${localStorage.getItem('token')}`
                }
            }).then(() => {
                this.isDeleted = true
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>

<style scoped>
.comment {
    box-sizing: border-box;
    padding: 5px 10px;
    border-radius: 5px;
    background: var(--my-light);
}

.comment + div {
    margin-left: 20px;
}

.reply-button {
    background:url(/images/reply.svg) no-repeat;
    border: none;
    padding: 0;
    height: 20px;
    width: 20px;
}

.reply-button:hover {
    background:url(/images/reply-fill.svg) no-repeat;
}

.delete-button {
    background:url(/images/trash3.svg) no-repeat;
    border: none;
    padding: 0;
    height: 20px;
    width: 20px;
}

.delete-button:hover {
    background:url(/images/trash3-fill.svg) no-repeat;
}

.reply-cancel {
    border: none;
    background: none;
    padding: 0;
}

.reply-cancel:hover {
    text-decoration: underline;
}
</style>
