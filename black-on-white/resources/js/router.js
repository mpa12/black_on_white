import { createRouter, createWebHistory } from 'vue-router'

import Index from './views/Index.vue';
import Participants from './views/Participants.vue';
import Articles from './views/Articles.vue';
import Article from './views/Article.vue';
import Login from './views/Login.vue';

const routes = [
    { path: '/', component: Index },
    { path: '/participants', component: Participants },
    { path: '/article', component: Articles },
    { path: '/article/:id', component: Article },
    { path: '/login', component: Login },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to) {
        if (!to.hash) return
        const element = document.querySelector(to.hash)
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
})

export default router
