import { createRouter, createWebHistory } from 'vue-router'
import Loader from "./components/Loader.vue";
import {defineAsyncComponent} from "vue";
import store from "./store";

const routes = [
    {
        path: '/',
        component: defineAsyncComponent({
            loader: () => import('./views/Index.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
    },
    {
        path: '/participants',
        component: defineAsyncComponent({
            loader: () => import('./views/Participants/Participants.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
    },
    {
        path: '/photo_gallery',
        component: defineAsyncComponent({
            loader: () => import('./views/PhotoGallery/PhotoGallery.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
    },
    {
        path: '/privacy_policy',
        component: defineAsyncComponent({
            loader: () => import('./views/PrivacyPolicy.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
    },

    {
        path: '/article',
        component: defineAsyncComponent({
            loader: () => import('./views/Article/Articles.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
    },
    {
        path: '/article/:id',
        component: defineAsyncComponent({
            loader: () => import('./views/Article/Article.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
    },

    {
        path: '/login',
        component: defineAsyncComponent({
            loader: () => import('./views/Auth/Login.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresGuest: true }
    },
    {
        path: '/register',
        component: defineAsyncComponent({
            loader: () => import('./views/Auth/Register.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresGuest: true }
    },
    {
        path: '/logout',
        component: defineAsyncComponent({
            loader: () => import('./views/Auth/Logout.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAuth: true }
    },
    {
        path: '/reset-password',
        component: defineAsyncComponent({
            loader: () => import('./views/Auth/ResetPassword.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresGuest: true }
    },
    {
        path: '/reset-password/:remember_token',
        component: defineAsyncComponent({
            loader: () => import('./views/Auth/ResetPasswordResponse.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresGuest: true }
    },

    {
        path: '/admin',
        component: defineAsyncComponent({
            loader: () => import('./views/Admin/AdminIndex.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },
    {
        path: '/admin/articles',
        component: defineAsyncComponent({
            loader: () => import('./views/Article/AdminArticles.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },
    {
        path: '/admin/articles/create',
        component: defineAsyncComponent({
            loader: () => import('./views/Article/AdminArticleCreate.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },
    {
        path: '/admin/articles/update/:id',
        component: defineAsyncComponent({
            loader: () => import('./views/Article/AdminArticleUpdate.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },

    {
        path: '/admin/photo-gallery',
        component: defineAsyncComponent({
            loader: () => import('./views/PhotoGallery/AdminPhotoGallery.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },

    {
        path: '/admin/participants',
        component: defineAsyncComponent({
            loader: () => import('./views/Participants/AdminParticipants.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },
    {
        path: '/admin/participants/create',
        component: defineAsyncComponent({
            loader: () => import('./views/Participants/AdminParticipantsCreate.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },
    {
        path: '/admin/participants/update/:id',
        component: defineAsyncComponent({
            loader: () => import('./views/Participants/AdminParticipantsUpdate.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },

    {
        path: '/admin/users',
        component: defineAsyncComponent({
            loader: () => import('./views/Users/AdminUsers.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },

    {
        path: '/admin/messages',
        component: defineAsyncComponent({
            loader: () => import('./views/Messages/AdminMessages.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },
    {
        path: '/admin/messages/:id',
        component: defineAsyncComponent({
            loader: () => import('./views/Messages/AdminMessagesView.vue'),
            loadingComponent: Loader,
            suspensible: true
        }),
        meta: { requiresAdmin: true }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to) {
        if (!to.hash) return;
        const element = document.querySelector(to.hash);
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    },
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    if (to.matched.some((route) => route.meta.requiresAuth) && !token) {
        next('/login');
    } else if (to.matched.some((route) => route.meta.requiresGuest) && token) {
        next('/');
    } else if (to.matched.some((route) => route.meta.requiresAdmin)) {
        if (!token) next('/');
        else {
            store.commit('setLoading', true); // Устанавливаем состояние загрузки в true
            checkIsAdmin(token)
                .then((isAdmin) => {
                    if (!isAdmin) next('/');
                    else next();
                })
                .catch((error) => {
                    console.log(error);
                    next('/');
                })
                .finally(() => {
                    store.commit('setLoading', false); // После завершения проверки устанавливаем состояние загрузки в false
                });
        }
    } else {
        next();
    }
});

router.afterEach(() => {
    store.commit('setLoading', false);
});

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
