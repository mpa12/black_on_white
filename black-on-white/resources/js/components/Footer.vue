<template>
    <footer class="container my-3">
        <div class="d-flex flex-lg-row flex-column justify-content-between gap-4 footer__inner">
            <div class="flex-grow-1">
                <h5>КОНТАКТЫ</h5>
                <hr>
                <p>+7 (999) 999 99 99</p>
                <p>theatre.black.on.white@gmail.com</p>
            </div>
            <div class="flex-grow-1">
                <h5>АДРЕС</h5>
                <hr>
                <p>г. Хабаровск ул. Волочаевская д. 1</p>
            </div>
            <div class="flex-grow-1">
                <h5>ДОПОЛНИТЕЛЬНО</h5>
                <hr>
                <a href="/privacy_policy">Политика конфиденциальности</a>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3 footer__copyright">
            <span>Made by <a href="https://github.com/mpa12" target="_blank">mpa12</a> © 2023</span>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footer"
}
</script>

<style scoped>
.footer__inner {
    box-sizing: border-box;
    padding: 40px 20px 80px;
    border-radius: 20px;
    background-color: var(--my-white);
}

.footer__inner h5 {
    color: var(--my-black);
}

.footer__inner p,
.footer__inner a {
    margin-bottom: 0;
    color: var(--my-gray);
}

.footer__copyright {
    border-radius: 20px;
    background-color: var(--my-white);
    box-sizing: border-box;
    padding: 10px;
}

.footer__copyright span {
    font-size: 12px;
}

.footer__copyright a {
    text-decoration: none;
    color: var(--my-black);
}
</style>
