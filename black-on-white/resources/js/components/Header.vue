<template>
    <header class="container mb-3" @localStorageUpdated="handleLocalStorageUpdated">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="flex-grow-1">
                <router-link to="/" class="fw-bold fs-5">Черным по белому</router-link>
            </div>
            <div class="d-lg-none d-flex">
                <svg @click=openMenu xmlns="http://www.w3.org/2000/svg" width=20 height=20 fill=currentColor id=menu_icon class="bi bi-list fs-5 text-dark" viewBox="0 0 16 16">
                    <path d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <div class="d-lg-flex d-none flex-lg-row flex-column" id=menu>
                <div class="d-lg-none d-flex">
                    <svg @click=closeMenu xmlns="http://www.w3.org/2000/svg" width=16 height=16 fill=currentColor id=close_menu_icon class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                </div>
                <div class="d-flex justify-content-between w-auto gap-3 flex-lg-row flex-column">
                    <nav v-for="link in visibleLinks" :key="link.href">
                        <router-link @click=closeMenu class=fs-6 :to="{ path: link.href, hash: link.hash, exact: true }">
                            {{ link.title }}
                        </router-link>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
    computed: {
        visibleLinks() {
            const token = localStorage.getItem('token')

            return this.links.filter((link) => {
                if (link.meta && link.meta.requiresAuth && !token) {
                    return false
                } else if (link.meta && link.meta.requiresGuest && token) {
                    return false
                } else if (link.meta && link.meta.requiresAdmin) {
                    if (!token) return false
                    this.checkIsAdmin(token)
                    if (!this.isAdmin) return false
                }

                return true
            })
        },
    },
    created() {
        window.addEventListener('localStorageUpdated', this.localStorageUpdated);
    },
    beforeDestroy() {
        window.removeEventListener('localStorageUpdated', this.localStorageUpdated);
    },
    mounted() {
        this.setLinks()
    },
    methods: {
        localStorageUpdated() {
            const token = localStorage.getItem('token')
            if (token) this.checkIsAdmin(token)

            this.setLinks()
        },
        setLinks() {
            this.links = [
                { title: '(О НАС)', href: '/', hash: '#about_us' },
                { title: '(УЧАСТНИКИ)', href: '/participants', hash: '' },
                { title: '(НОВОСТИ)', href: '/article', hash: '' },
                { title: '(ФОТОГАЛЕРЕЯ)', href: '/photo_gallery', hash: '' },
                { title: '(НАПИСАТЬ НАМ)', href: '/', hash: '#write_to_us' },
                { title: '(ВОЙТИ)', href: '/login', hash: '', meta: { requiresGuest: true } },
                { title: '(ВЫЙТИ)', href: '/logout', hash: '', meta: { requiresAuth: true } },
                { title: '(АДМИН ПАНЕЛЬ)', href: '/admin', hash: '', meta: { requiresAdmin: true } },
            ]
        },
        openMenu() {
            let menu = document.querySelector('#menu')
            menu.classList.remove('d-none')
            menu.classList.add('d-flex')
        },
        closeMenu() {
            let menu = document.querySelector('#menu')
            menu.classList.add('d-none')
            menu.classList.remove('d-flex')
        },
        checkIsAdmin(token) {
            axios.get('/api/auth/is-admin', {
                headers: { "Authorization" : `Bearer ${token}` }
            }).then(response => {
                this.isAdmin = !!response.data
            }).catch(error => {
                console.log(error)
                this.isAdmin = false
            })
        }
    },
    data() {
        return {
            links: [],
            isAdmin: false,
        }
    }
}
</script>

<style scoped>
.header {
    height: 50px;
    background-color: var(--my-white);
    padding: 20px;
    border-radius: 20px;
}

.header span,
.header a {
    color: var(--my-black);
    text-decoration: none;
}

@media(max-width: 992px) {
    .header {
        flex-direction: row-reverse;
    }

    .header .flex-grow-1 {
        justify-content: flex-end;
        display: flex;
        align-items: center;
    }

    .header nav a,
    .header span {
        font-size: 16px!important;
    }

    #menu_icon {
        font-size: 1.25rem!important;
    }
}

@media(max-width: 1200px) {
    .header nav a,
    .header span {
        font-size: 14px!important;
    }

    .header .me-5 {
        margin-right: 10px!important;
    }

    #menu_icon {
        font-size: 1.25rem!important;
    }
}
</style>
