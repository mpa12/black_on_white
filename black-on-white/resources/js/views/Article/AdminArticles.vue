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
                    <td>{{ changeDate(article.created_at) }}</td>
                    <td>{{ changeDate(article.updated_at) }}</td>
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
import ArticleSearch from "../../components/ArticleSearch.vue";
import {changeDate} from "../../utils/ChangeDate";
import User from "../../models/User";
import ArticleService from "../../services/api/ArticleService";

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

            for (let i = start; i <= end; i++) pages.push(i);

            return pages;
        },
    },
    mounted() {
        this.loadArticles();
        window.addEventListener('search', function (event) {
            this.selectedFilters = [...event.detail.selectedFilters];
            this.text = event.detail.text;
            this.articles = [];
            this.page = 1;
            this.loadArticles();
        }.bind(this));
    },
    methods: {
        changeDate,
        async loadArticles() {
            this.loading = true;

            const response = await ArticleService.index(
                this.currentPage,
                this.text,
                this.selectedFilters,
                []
            );

            this.articles = response.articles;
            this.totalPages = response.totalPages;
            this.loading = false;
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
        async loadDeleteArticle(id) {
            this.deleteArticleInfo = await ArticleService.show(id);
        },
        deleteArticle(id) {
            const url = '/api/article/' + id;
            const data = {
                _method: 'delete'
            };
            const config = {
                headers: {
                    Authorization: User.getAuthorizationString()
                }
            };
            axios.post(url, data, config).then(this.loadArticles).catch(console.error)
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
