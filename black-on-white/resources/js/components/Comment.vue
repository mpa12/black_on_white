<template>
    <section class="comment mt-2">
        <div class="d-flex gap-2 align-items-baseline">
            <h6 class=m-0>{{ comment.user.name }}</h6>
            <time>{{ changeCreatedAt(comment.created_at) }}</time>
        </div>
        <p class=m-0>{{ comment.body }}</p>
        <button type=button class=comment-button @click=showReplyForm />

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

export default {
    name: "Comment",
    props: ['comment', 'comments'],
    data() {
        return {
            childComments: null,
            parentComments: [],
            replying: false,
            body: null,
        }
    },
    mounted() {
        this.getChildComment()
    },
    methods: {
        getChildComment() {
            this.childComments = this.comments.filter(item => item.parent_id === this.comment.id);
        },
        changeCreatedAt(createdAt) {
            const date = new Date(createdAt)
            let diff = moment.duration(moment().diff(date))
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
            let comment = {
                'body': this.body,
                'article_id': this.$route.params.id,
                'paren_id': this.comment.id,
                'user': {'name': 'admin'},
            }

            this.childComments.push(comment)
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

.comment-button {
    background:url(/images/reply.svg) no-repeat;
    border: none;
    padding: 0;
    height: 20px;
    width: 20px;
}

.comment-button:hover {
    background:url(/images/reply-fill.svg) no-repeat;
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
