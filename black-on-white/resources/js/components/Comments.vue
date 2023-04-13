<template>
    <section v-if="canComment || hasComments" class="comments-section mt-3">
        <form v-if=canComment class="d-flex align-items-end gap-2">
            <div class=flex-grow-1>
                <label class=form-label>Комментарий</label>
                <input type=text class=form-control>
            </div>
            <button class="btn btn-dark">Отправить</button>
        </form>

        <p v-if="!hasComments" class="alert alert-light text-center">Нет комментариев</p>

        <comment v-for="parentComment in parentComments" :comment="parentComment" :comments="comments" />
    </section>
</template>

<script>
import Comment from "./Comment.vue";

export default {
    name: "Comments",
    components: {Comment},
    data() {
        return {
            canComment: false,
            hasComments: false,
            comments: [
                {id: 1, user: {name: 'Admin'}, body: 'Комментарий 1', created_at: '28 мая 2023', parent_id: null},
                {id: 2, user: {name: 'Admin'}, body: 'Комментарий 2, ответ на 1', created_at: '28 мая 2023', parent_id: 1},
                {id: 3, user: {name: 'Admin'}, body: 'Комментарий 3, ответ на 2', created_at: '28 мая 2023', parent_id: 2},
                {id: 4, user: {name: 'Admin'}, body: 'Комментарий 4, ответ на 2', created_at: '28 мая 2023', parent_id: 2},
                {id: 5, user: {name: 'Admin'}, body: 'Комментарий 5, ответ на 2', created_at: '28 мая 2023', parent_id: 2},
                {id: 6, user: {name: 'Admin'}, body: 'Комментарий 6, ответ на 2', created_at: '28 мая 2023', parent_id: 1},
                {id: 7, user: {name: 'Admin'}, body: 'Комментарий 7, ответ на 2', created_at: '28 мая 2023', parent_id: 2},
                {id: 8, user: {name: 'Admin'}, body: 'Комментарий 8', created_at: '28 мая 2023', parent_id: null},
                {id: 9, user: {name: 'Admin'}, body: 'Комментарий 9', created_at: '28 мая 2023', parent_id: null},
                {id: 10, user: {name: 'Admin'}, body: 'Комментарий 10', created_at: '28 мая 2023', parent_id: null},
                {id: 11, user: {name: 'Admin'}, body: 'Комментарий 11, ответ на 1', created_at: '28 мая 2023', parent_id: 1},
                {id: 12, user: {name: 'Admin'}, body: 'Комментарий 12, ответ на 3', created_at: '28 мая 2023', parent_id: 3},
            ],
            parentComments: [],
        }
    },
    mounted() {
        this.checkCanComment()
        this.checkHasComments()
        this.getParentComments()
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
