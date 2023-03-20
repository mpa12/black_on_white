<template>
    <section class=login-section>
        <form class=login-wrapper method=post>
            <h1 class=mb-4>Авторизация</h1>
            <div class=mb-3>
                <label for=email class=form-label>E-mail</label>
                <input type=text class=form-control id=email placeholder=E-mail>
            </div>
            <div class=mb-3>
                <label for=password class=form-label>Пароль</label>
                <input type=password class=form-control id=password placeholder=Пароль>
            </div>
            <div class="form-check mb-3">
                <input class=form-check-input type=checkbox id=rememberMe>
                <label class=form-check-label for=rememberMe>Запомнить меня</label>
            </div>
            <button type=submit class="btn btn-circle mb-4">Войти</button>
            <div class=mb-3>
                <router-link to="/password-reset">Забыли пароль?</router-link>
            </div>
            <div class=mb-3>
                <router-link to="/password-reset">Зарегистрироваться</router-link>
            </div>
        </form>
    </section>
</template>

<script>
export default {
    name: "Login"
}
</script>

<style scoped>
.login-section {
    background: var(--my-white);
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
}

.login-section .login-wrapper {
    width: 500px;
    padding: 20px 0;
}

.login-section .login-wrapper button.btn {
    background-color: var(--my-black);
    color: var(--my-white);
    border-radius: 20px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    text-transform: uppercase;
    width: 100%;
}

.login-section .login-wrapper button.btn:hover {
    background: var(--my-gray);
}

.login-section .login-wrapper a {
    color: var(--my-black);
}

.login-section .login-wrapper a:hover {
    color: var(--my-gray);
}
</style>
