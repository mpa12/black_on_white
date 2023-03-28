import { createRouter, createWebHistory } from 'vue-router'

import Index from './views/Index.vue'
import Participants from './views/Participants.vue'
import PhotoGallery from './views/PhotoGallery.vue'
import Articles from './views/Articles.vue'
import Article from './views/Article.vue'
import Login from './views/Login.vue'
import Register from './views/Register.vue'
import Logout from './views/Logout.vue'
import ResetPassword from './views/ResetPassword.vue'
import ResetPasswordResponse from './views/ResetPasswordResponse.vue'
import AdminIndex from './views/AdminIndex.vue'
import AdminArticles from './views/AdminArticles.vue'
import AdminArticleCreate from './views/AdminArticleCreate.vue'
import AdminArticleUpdate from './views/AdminArticleUpdate.vue'
import AdminPhotoGallery from './views/AdminPhotoGallery.vue'
import AdminParticipants from './views/AdminParticipants.vue'
import AdminUsers from './views/AdminUsers.vue'
import AdminMessages from './views/AdminMessages.vue'

const routes = [
    { path: '/', component: Index },
    { path: '/participants', component: Participants },
    { path: '/photo-gallery', component: PhotoGallery },

    { path: '/article', component: Articles },
    { path: '/article/:id', component: Article },

    { path: '/login', component: Login, meta: { requiresGuest: true } },
    { path: '/register', component: Register, meta: { requiresGuest: true } },
    { path: '/logout', component: Logout, meta: { requiresAuth: true } },
    { path: '/reset-password', component: ResetPassword, meta: { requiresGuest: true } },
    { path: '/reset-password/:remember_token', component: ResetPasswordResponse, meta: { requiresGuest: true } },

    { path: '/admin', component: AdminIndex, meta: { requiresAdmin: true } },
    { path: '/admin/articles', component: AdminArticles, meta: { requiresAdmin: true } },
    { path: '/admin/articles/create', component: AdminArticleCreate, meta: { requiresAdmin: true } },
    { path: '/admin/articles/update/:id', component: AdminArticleUpdate, meta: { requiresAdmin: true } },

    { path: '/admin/photo-gallery', component: AdminPhotoGallery, meta: { requiresAdmin: true } },
    { path: '/admin/participants', component: AdminParticipants, meta: { requiresAdmin: true } },
    { path: '/admin/users', component: AdminUsers, meta: { requiresAdmin: true } },
    { path: '/admin/messages', component: AdminMessages, meta: { requiresAdmin: true } },
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
