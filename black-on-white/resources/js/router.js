import { createRouter, createWebHistory } from 'vue-router'

import Index from './views/Index.vue';
import Participants from './views/Participants.vue';

const routes = [
    { path: '/', component: Index },
    { path: '/participants', component: Participants },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
