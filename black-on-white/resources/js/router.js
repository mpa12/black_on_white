import { createRouter, createWebHistory } from 'vue-router'

import Index from './views/Index.vue';
import Participants from './views/Participants.vue';
import Articles from './views/Articles.vue';

const routes = [
    { path: '/', component: Index },
    { path: '/participants', component: Participants },
    { path: '/article', component: Articles },
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
