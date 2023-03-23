import { createRouter, createWebHistory } from 'vue-router'

import Index from './views/Index.vue'
import Participants from './views/Participants.vue'
import Articles from './views/Articles.vue'
import Article from './views/Article.vue'
import Login from './views/Login.vue'
import Logout from './views/Logout.vue'
import AdminIndex from './views/AdminIndex.vue'

const routes = [
    { path: '/', component: Index },
    { path: '/participants', component: Participants },
    { path: '/article', component: Articles },
    { path: '/article/:id', component: Article },
    { path: '/login', component: Login, meta: { requiresGuest: true } },
    { path: '/logout', component: Logout, meta: { requiresAuth: true } },
    { path: '/admin', component: AdminIndex, meta: { requiresAdmin: true } },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to) {
        if (!to.hash) return
        const element = document.querySelector(to.hash)
        element.scrollIntoView({ behavior: 'smooth', block: 'start' })
    }
})

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')
    if (to.matched.some((route) => route.meta.requiresAuth) && !token) {
        next('/login')
    } else if (to.matched.some((route) => route.meta.requiresGuest) && token) {
        next('/')
    } else if (to.matched.some((route) => route.meta.requiresAdmin) && !token) {
        if (!checkIsAdmin(token)) next('/')
    } else {
        next()
    }
});

function checkIsAdmin(token) {
    let isAdmin = false

    axios.get('/api/auth/is-admin', {
        headers: { "Authorization" : `Bearer ${token}` }
    }).then(response => {
        isAdmin = !!response.data
    }).catch(error => {
        console.log(error)
        isAdmin = false
    })

    return isAdmin
}

export default router
