<template>
    <div class="modal fade" id=deleteModal>
        <div class="modal-dialog modal-dialog-centered">
            <div class=modal-content>
                <div class=modal-header>
                    <h1 class="modal-title fs-5">Удаление сообщения пользователя <span>&laquo;{{ deleteMessageInfo.name }}&raquo;</span></h1>
                    <button type=button class=btn-close data-bs-dismiss=modal></button>
                </div>
                <div class=modal-body>
                    Вы уверенны, что хотите удалить сообщение пользователя <span>&laquo;{{ deleteMessageInfo.name }}&raquo;</span>?
                </div>
                <div class="modal-footer justify-content-start">
                    <button type=button class="btn btn-secondary" data-bs-dismiss=modal>Отмена</button>
                    <button type=button class="btn btn-danger" @click=deleteMessage(deleteMessageInfo.id) data-bs-dismiss=modal>Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="title my-3">
        <h1>Управление сообщениями</h1>
    </div>

    <div class=table-wrapper>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>ID</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>E-mail</th>
                <th>Создано</th>
                <th>Прочитано</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(message, index) in messages">
                <th>{{ index + 1 }}</th>
                <td>{{ message.id }}</td>
                <td class="text-truncate user-select-none" :title="message.name">
                    <router-link :to="'/admin/messages/' + message.id" class=text-decoration-none>
                        {{ message.name }}
                    </router-link>
                </td>
                <td class=text-truncate :title=message.phone>{{ message.phone }}</td>
                <td class=text-truncate :title=message.email>{{ message.email }}</td>
                <td>{{ convertDate(message.created_at) }}</td>
                <td>
                    <span :class="(message.is_read ? 'badge bg-light text-dark' : 'badge bg-info text-dark')">
                        {{ message.is_read ? 'Прочитано' : 'Не прочитано' }}
                    </span>
                </td>
                <td>
                    <div class=dropdown>
                        <span type=button data-bs-toggle=dropdown>
                            <img src=/images/three-dots-vertical.svg alt=three-dots-vertical type=button data-toggle=dropdown>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <span @click=loadDeleteMessage(message.id) class=dropdown-item type=button data-bs-toggle=modal data-bs-target="#deleteModal">
                                    Удалить
                                </span>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <nav>
            <ul class=pagination>
                <li class=page-item :class="{ disabled: currentPage === 1 }">
                    <span class=page-link aria-label=Previous @click.prevent=prevPage>
                        <span aria-hidden=true>&laquo;</span>
                    </span>
                </li>
                <li class=page-item :class="{ active: index === currentPage }" v-for="index in pages" :key="index">
                    <span class=page-link @click.prevent="goToPage(index)">{{ index }}</span>
                </li>
                <li class=page-item :class="{ disabled: currentPage === totalPages }">
                    <span class=page-link aria-label=Next @click.prevent=nextPage>
                        <span aria-hidden=true>&raquo;</span>
                    </span>
                </li>
            </ul>
        </nav>
    </div>
    <div v-if=loading class=text-center>Loading...</div>
</template>

<script>
import axios from "axios";
import moment from 'moment/min/moment-with-locales'

export default {
    name: "AdminMessages",
    data() {
        return {
            messages: [],
            currentPage: 1,
            loading: false,
            totalPages: null,
            deleteMessageInfo: [],
        }
    },
    computed: {
        pages() {
            const maxVisiblePages = 5
            const pages = [];
            const { currentPage, totalPages } = this;

            let start = Math.max(currentPage - Math.floor(maxVisiblePages / 2), 1);
            let end = Math.min(start + maxVisiblePages - 1, totalPages);

            if (end - start < maxVisiblePages - 1) {
                start = Math.max(end - maxVisiblePages + 1, 1);
            }

            for (let i = start; i <= end; i++) {
                pages.push(i);
            }

            return pages;
        },
    },
    mounted() {
        this.loadMessages()
    },
    methods: {
        loadMessages() {
            this.loading = true

            axios.get('/api/message?page=' + this.currentPage, {
                headers: {'Authorization': `Bearer ${localStorage.getItem('token')}`}
            }).then(response => {
                this.messages = response.data['data']
                this.totalPages = response.data['meta'].last_page
                this.loading = false
            })
        },
        convertDate(date) {
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
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--
                this.loadMessages()
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++
                this.loadMessages()
            }
        },
        goToPage(index) {
            if (this.currentPage !== index) {
                this.currentPage = index
                this.loadMessages()
            }
        },
        loadDeleteMessage(id) {
            axios.get(
                '/api/message/' + id,
                {headers: {'Authorization': `Bearer ${localStorage.getItem('token')}`}}
            ).then(response => {
                this.deleteMessageInfo = response.data['data']
            })
        },
        deleteMessage(id) {
            axios.delete('/api/message/' + id, {
                headers: { "Authorization" : `Bearer ${localStorage.getItem('token')}` }
            }).then(() => {
                this.loadMessages()
            })
        }
    }
}
</script>

<style scoped>
.table-wrapper,
.title {
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
}

.table-wrapper .text-truncate {
    max-width: 200px;
}
</style>
