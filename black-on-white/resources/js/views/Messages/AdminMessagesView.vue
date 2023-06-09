<template>
    <div class="title my-3 d-flex justify-content-start align-items-baseline gap-3">
        <router-link to="/admin/messages" class="btn btn-outline-secondary">Назад</router-link>
        <h3 class="m-0">Просмотр сообщения от пользователя: <span class="fst-italic text-secondary">{{ message.name }}</span></h3>
    </div>
    <div class=message-info-wrapper>
        <table class="table table-borderless table-hover">
            <tbody>
                <tr><th>Имя</th><td>{{ message.name }}</td></tr>
                <tr><th>Телефон</th><td>{{ message.phone }}</td></tr>
                <tr><th>E-mail</th><td>{{ message.email }}</td></tr>
                <tr><th>Отправлено</th><td>{{ createdAt }}</td></tr>
            </tbody>
        </table>
    </div>
    <div class="message-info-wrapper my-3">
        <h5>Сообщение</h5>
        <p>{{ message.message }}</p>
    </div>
</template>

<script>
import axios from "axios";
import moment from 'moment/min/moment-with-locales'

export default {
    name: "AdminMessagesView",
    data() {
        return {
            message: [],
            createdAt: ''
        }
    },
    mounted() {
        this.loadMessage()
    },
    methods: {
        loadMessage() {
            axios.get(
                process.env.VUE_APP_URL + '/api/message/read/' + this.$route.params.id,
                {headers: {'Authorization': `Bearer ${localStorage.getItem('token')}`}}
            ).then(response => {
                this.message = response.data['data']
                this.changeCreatedAt(this.message.created_at)
            })
        },
        changeCreatedAt(createdAt) {
            const date = new Date(createdAt)
            let diff = moment.duration(moment().diff(date))
            if (diff.asMinutes() < 60) {
                let test = (new Date()).getTime() - date.getTime()
                test = (new Date(test)).getMinutes()
                this.createdAt = test + ' минут назад'
            } else if (diff.asHours() < 24) {
                this.createdAt = moment().subtract(diff).format('HH часов назад')
            } else if (diff.asDays() < 2) {
                this.createdAt = moment().subtract(diff).format('Вчера в HH:mm')
            } else {
                moment.locale('ru')
                this.createdAt = moment(date).format('D MMMM в HH:mm YYYY')
            }
        }
    }
}
</script>

<style scoped>
.title {
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
}

.message-info-wrapper {
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
    width: 100%;
}
</style>
