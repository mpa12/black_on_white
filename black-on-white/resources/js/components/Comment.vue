<template>
    <section class="comment mt-2">
        <div class="d-flex gap-2 align-items-baseline">
            <h6 class=m-0>{{ comment.user.name }}</h6>
            <time>{{ comment.created_at }}</time>
        </div>
        <p class=m-0>{{ comment.body }}</p>
    </section>
    <div>
        <comment v-if="childComments" v-for="childComment in childComments" :comment="childComment" :comments="comments" />
    </div>
</template>

<script>
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
</style>
