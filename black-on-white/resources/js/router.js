import { createRouter, createWebHistory } from 'vue-router'

import Index from './views/Index.vue'
import Participants from './views/Participants/Participants.vue'
import PhotoGallery from './views/PhotoGallery/PhotoGallery.vue'
import Articles from './views/Article/Articles.vue'
import Article from './views/Article/Article.vue'
import Login from './views/Auth/Login.vue'
import Register from './views/Auth/Register.vue'
import Logout from './views/Auth/Logout.vue'
import ResetPassword from './views/Auth/ResetPassword.vue'
import ResetPasswordResponse from './views/Auth/ResetPasswordResponse.vue'
import AdminIndex from './views/Admin/AdminIndex.vue'
import AdminArticles from './views/Article/AdminArticles.vue'
import AdminArticleCreate from './views/Article/AdminArticleCreate.vue'
import AdminArticleUpdate from './views/Article/AdminArticleUpdate.vue'
import AdminPhotoGallery from './views/PhotoGallery/AdminPhotoGallery.vue'
import AdminParticipants from './views/Participants/AdminParticipants.vue'
import AdminParticipantsCreate from './views/Participants/AdminParticipantsCreate.vue'
import AdminParticipantsUpdate from './views/Participants/AdminParticipantsUpdate.vue'
import AdminUsers from './views/Users/AdminUsers.vue'
import AdminMessages from './views/Messages/AdminMessages.vue'
import AdminMessagesView from './views/Messages/AdminMessagesView.vue'
import PrivacyPolicy from './views/PrivacyPolicy.vue'

const routes = [
    { path: '/', component: Index },
    { path: '/participants', component: Participants },
    { path: '/photo_gallery', component: PhotoGallery },
    { path: '/privacy_policy', component: PrivacyPolicy },

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
    { path: '/admin/participants/create', component: AdminParticipantsCreate, meta: { requiresAdmin: true } },
    { path: '/admin/participants/update/:id', component: AdminParticipantsUpdate, meta: { requiresAdmin: true } },

    { path: '/admin/users', component: AdminUsers, meta: { requiresAdmin: true } },

    { path: '/admin/messages', component: AdminMessages, meta: { requiresAdmin: true } },
    { path: '/admin/messages/:id', component: AdminMessagesView, meta: { requiresAdmin: true } },
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

router.beforeEach(async (to, from, next) => {
    const token = localStorage.getItem('token')
    if (to.matched.some((route) => route.meta.requiresAuth) && !token) {
        next('/login')
    } else if (to.matched.some((route) => route.meta.requiresGuest) && token) {
        next('/')
    } else if (to.matched.some((route) => route.meta.requiresAdmin)) {
        if (!token) next('/')
        else {
            try {
                const isAdmin = await checkIsAdmin(token)
                if (!isAdmin) next('/')
                else next()
            } catch (error) {
                console.log(error)
                next('/')
            }
        }
    } else {
        next()
    }
})

async function checkIsAdmin(token) {
    try {
        const response = await axios.get('/api/auth/is-admin', {
            headers: { "Authorization" : `Bearer ${token}` }
        })
        return !!response.data
    } catch (error) {
        console.log(error)
        return false
    }
}

export default router
