<template>
    <header class="container mb-2">
        <div class="header d-flex justify-content-between align-items-center">
            <div class="flex-grow-1">
                <a href="/" class="fw-bold fs-5">Черным по белому</a>
            </div>
            <div class="d-lg-none d-flex">
                <svg @click=openMenu xmlns="http://www.w3.org/2000/svg" width=20 height=20 fill=currentColor id=menu_icon class="bi bi-list fs-5 text-dark" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </div>
            <div class="d-lg-flex d-none flex-lg-row flex-column" id=menu>
                <div class="d-lg-none d-flex">
                    <svg @click=closeMenu xmlns="http://www.w3.org/2000/svg" width=16 height=16 fill=currentColor id=close_menu_icon class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                </div>
                <div class="d-flex justify-content-between w-auto me-5 gap-3 flex-lg-row flex-column">
                    <nav><a @click=closeMenu class=fs-6 href="/#about_us">(О НАС)</a></nav>
                    <nav><a @click=closeMenu class=fs-6 href="participants.html">(УЧАСТНИКИ)</a></nav>
                    <nav><a @click=closeMenu class=fs-6 href="news.html">(НОВОСТИ)</a></nav>
                    <nav><a @click=closeMenu class=fs-6 href="photo_gallery.html">(ФОТОГАЛЕРЕЯ)</a></nav>
                    <nav><a @click=closeMenu class=fs-6 href="/#write_to_us">(НАПИСАТЬ НАМ)</a></nav>
                </div>
                <div>
                    <span class=fs-6>+7 (999) 999 99 99</span>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header",
    methods: {
        openMenu() {
            let menu = document.querySelector('#menu')
            menu.classList.remove('d-none')
            menu.classList.add('d-flex')
        },
        closeMenu() {
            let menu = document.querySelector('#menu')
            menu.classList.add('d-none')
            menu.classList.remove('d-flex')
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
