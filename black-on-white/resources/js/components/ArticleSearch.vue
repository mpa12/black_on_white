<template>
    <div class=newses__search>
        <form class="d-flex flex-column" @submit.prevent=search>
            <div class="w-100 d-flex align-items-center gap-2 justify-content-between">
                <router-link class="btn btn-primary" to="/admin/articles/create" v-if="isAdmin">Добавить</router-link>
                <label class=flex-grow-1>
                    <input v-model=text type=text placeholder="Введите название новости..." class=w-100>
                </label>
                <svg @click=filterButton width=16 height=16 fill=currentColor class="bi bi-filter" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                <button type=submit>Найти</button>
            </div>
            <div class="d-flex flex-wrap gap-2 mt-2" v-if="showFilters">
                <span v-for="filter in filters">
                    <input v-model=selectedFilters type=checkbox class=btn-check :value=filter.id :id=filter.id autocomplete="off" name="selectedFilters">
                    <label class="btn btn-outline-dark" :for=filter.id>{{ filter.title }}</label>
                </span>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import User from "../models/User";

export default {
    name: "ArticleSearch",
    data() {
        return {
            filters: [],
            selectedFilters: [],
            text: '',
            isAdmin: false,
            showFilters: false,
        }
    },
    methods: {
        filterButton() {
            this.showFilters = !this.showFilters;
        },
        loadFilters() {
            axios.get('/api/article-type/').then(response => {
                this.filters = response.data['data']
            })
        },
        search() {
            let evt = new CustomEvent('search', {
                detail: {
                    selectedFilters: this.selectedFilters,
                    text: this.text
                }
            });
            window.dispatchEvent(evt);
        },
        async checkIsAdmin() {
            this.isAdmin = await User.isAdmin();
        }
    },
    mounted() {
        this.loadFilters()
        this.checkIsAdmin()
    },
}
</script>

<style scoped>
.newses__search {
    padding: 20px;
    border-radius: 20px;
    background-color: var(--my-white);
}

.newses__search form {
    margin: 0;
}

.newses__search input[type="text"] {
    width: 100%;
    height: 40px;
    padding: 10px 15px;
    border-radius: 10px;
    border: none;
    background-color: var(--my-light);
}

.newses__search input[type="text"]:focus {
    outline: none;
}

.newses__search .bi-filter {
    height: 40px;
    width: 40px;
    padding: 10px;
    background-color: var(--my-light);
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    color: var(--my-black);
}

.newses__search .bi-filter:hover {
    cursor: pointer;
    background-color: var(--my-light-gray);
}

.newses__search button {
    height: 40px;
    border: none;
    padding: 10px;
    background-color: var(--my-light);
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: var(--my-black);
}

.newses__search button:hover {
    cursor: pointer;
    background-color: var(--my-light-gray);
}

.newses__search .btn-outline-dark {
    --bs-btn-bg: var(--my-light);
    --bs-btn-active-bg: var(--my-black);
    --bs-btn-color: var(--my-black);
    border: none;
}

.newses__search .btn-outline-dark:hover {
    --bs-btn-active-bg: var(--my-gray);
    --bs-btn-bg: var(--my-light-gray);
}
</style>
