<template>
    <section class="comment mt-2">
        <div class="d-flex gap-2 align-items-baseline">
            <h6 class=m-0>{{ comment.user.name }}</h6>
            <time>{{ changeCreatedAt(comment.created_at) }}</time>
        </div>
        <p class=m-0>{{ comment.body }}</p>
        <button type=button class=comment-button />
    </section>
    <div>
        <comment v-if="childComments" v-for="childComment in childComments" :comment="childComment" :comments="comments" />
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
</style>
