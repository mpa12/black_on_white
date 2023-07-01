<template>
    <section class=login-section>
        <form class=login-wrapper @submit.prevent=login>
            <h1 class=mb-4>Авторизация</h1>
            <div class=mb-3>
                <label for=email class=form-label>E-mail</label>
                <input v-model=email type=text class=form-control id=email placeholder=E-mail>
            </div>
            <div class=mb-3>
                <label for=password class=form-label>Пароль</label>
                <input v-model=password type=password class=form-control id=password placeholder=Пароль>
            </div>
            <p class="text-danger" v-if="error">Неверный e-mail или пароль</p>
            <button type=submit class="btn btn-circle mb-4">Войти</button>
            <div class=mb-3>
                <router-link to="/reset-password">Забыли пароль?</router-link>
            </div>
            <div class=mb-3>
                <router-link to="/register">Зарегистрироваться</router-link>
            </div>
        </form>
    </section>
</template>

<script>
import User from "../../models/User";

export default {
    name: "Login",
    data() {
        return {
            email: '',
            password: '',
            error: false,
        }
    },
    methods: {
        login() {
            axios.post('/api/auth/login', {
                email: this.email,
                password: this.password
            }).then(response => {
                User.login(response.data.user.api_token)

                let evt = new CustomEvent('localStorageUpdated', { detail: null })
                window.dispatchEvent(evt);

                this.$router.push('/')
            }).catch(() => {
                this.error = true
            })
        },
    }
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
