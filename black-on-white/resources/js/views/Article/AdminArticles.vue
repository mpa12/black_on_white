<template>
    <div class="modal fade" id=deleteModal>
        <div class="modal-dialog modal-dialog-centered">
            <div class=modal-content>
                <div class=modal-header>
                    <h1 class="modal-title fs-5">Удаление новости <span>&laquo;{{ deleteArticleInfo.title }}&raquo;</span></h1>
                    <button type=button class=btn-close data-bs-dismiss=modal></button>
                </div>
                <div class=modal-body>
                    Вы уверенны, что хотите удалить новость <span>&laquo;{{ deleteArticleInfo.title }}&raquo;</span>?
                </div>
                <div class="modal-footer justify-content-start">
                    <button type=button class="btn btn-secondary" data-bs-dismiss=modal>Отмена</button>
                    <button type=button class="btn btn-danger" @click=deleteArticle(deleteArticleInfo.id) data-bs-dismiss=modal>Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="title my-3">
        <h1>Управление новостями</h1>
    </div>

    <article-search class=mb-3 />

    <div class=table-wrapper>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>№</th>
                    <th>ID</th>
                    <th>Заголовок</th>
                    <th>Описание</th>
                    <th>Тип</th>
                    <th>Создано</th>
                    <th>Обновлено</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(article, index) in articles">
                    <th>{{ index + 1 }}</th>
                    <td>{{ article.id }}</td>
                    <td class="text-truncate user-select-none" :title="article.title">
                        <router-link :to="'/article/' + article.id" class=text-decoration-none>
                            {{ article.title }}
                        </router-link>
                    </td>
                    <td class=text-truncate :title="article.description">{{ article.description }}</td>
                    <td>{{ article.article_type.title }}</td>
                    <td>{{ convertDate(article.created_at) }}</td>
                    <td>{{ convertDate(article.updated_at) }}</td>
                    <td>
                        <div class=dropdown>
                            <span type=button data-bs-toggle=dropdown>
                                <img src=/images/three-dots-vertical.svg alt=three-dots-vertical type=button data-toggle=dropdown>
                            </span>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><router-link class=dropdown-item :to="'/admin/articles/update/' + article.id">Редактировать</router-link></li>
                                <li>
                                    <span @click=loadDeleteArticle(article.id) class=dropdown-item type=button data-bs-toggle=modal data-bs-target="#deleteModal">
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
import ArticleSearch from "../../components/ArticleSearch.vue";

export default {
    name: "AdminArticles",
    components: { ArticleSearch },
    data() {
        return {
            articles: [],
            currentPage: 1,
            loading: false,
            totalPages: null,
            selectedFilters: [],
            text: '',
            deleteArticleInfo: [],
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
        this.loadArticles()
        window.addEventListener('search', function (event) {
            this.selectedFilters = [...event.detail.selectedFilters] // Массив с id типов статей
            this.text = event.detail.text
            this.articles = [] // очищаем массив статей
            this.page = 1 // начинаем с первой страницы
            this.loadArticles()
        }.bind(this))
    },
    methods: {
        loadArticles() {
            this.loading = true

            let params = { page: this.currentPage }
            if (this.text !== '') params['text'] = this.text
            if (this.selectedFilters.length > 0) params['article_type'] = this.selectedFilters.join(",")

            axios.get(process.env.VUE_APP_URL + '/api/article', { params }).then(response => {
                this.articles = response.data['data']
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
                this.loadArticles()
            }
        },
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++
                this.loadArticles()
            }
        },
        goToPage(index) {
            if (this.currentPage !== index) {
                this.currentPage = index
                this.loadArticles()
            }
        },
        loadDeleteArticle(id) {
            axios.get(process.env.VUE_APP_URL + '/api/article/' + id).then(response => {
                this.deleteArticleInfo = response.data['data']
            })
        },
        deleteArticle(id) {
            axios.delete(process.env.VUE_APP_URL + '/api/article/' + id, {
                headers: { "Authorization" : `Bearer ${localStorage.getItem('token')}` }
            }).then(() => {
                this.loadArticles()
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
    max-width: 300px;
}
</style>
