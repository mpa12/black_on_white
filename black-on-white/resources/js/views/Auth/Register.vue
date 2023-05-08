<template>
    <toast v-if=created title="Аккаунт успешно создан" />
    <section class=register-section>
        <form class=register-wrapper @submit.prevent=register>
            <h1 class=mb-4>Регистрация</h1>
            <div class=mb-3>
                <label for=name class=form-label>Имя пользоватлея</label>
                <input v-model=name type=text class=form-control id=name placeholder="Имя пользоватлея">
                <small v-if="errors.hasOwnProperty('name')" class=text-danger>{{ errors.name }}</small>
            </div>
            <div class=mb-3>
                <label for=email class=form-label>E-mail</label>
                <input v-model=email type=text class=form-control id=email placeholder=E-mail>
                <small v-if="errors.hasOwnProperty('email')" class=text-danger>{{ errors.email }}</small>
            </div>
            <div class=mb-3>
                <label for=password class=form-label>Пароль</label>
                <input v-model=password type=password class=form-control id=password placeholder=Пароль>
                <small v-if="errors.hasOwnProperty('password')" class=text-danger>{{ errors.password }}</small>
            </div>
            <button type=submit class="btn btn-circle mb-4">Зарегистрироваться</button>
        </form>
    </section>
</template>

<script>
import Toast from "../../components/Toast.vue"

export default {
    name: "Register",
    components: { Toast },
    data() {
        return {
            name: null,
            email: null,
            password: null,
            errors: [],
            created: false
        }
    },
    methods: {
        register() {
            axios.post('/api/auth/register', {
                name: this.name,
                email: this.email,
                password: this.password
            }).then(() => {
                this.created = true
                this.name = null
                this.email = null
                this.password = null
                this.errors = []
            }).catch(error => {
                console.log(error)
                if (error.response.status === 422) {
                    let errors = JSON.parse(error.request.responseText).errors
                    for (const key in errors) errors[key] = errors[key][0]
                    this.errors = errors
                }
            })
        }
    }
}
</script>

<style scoped>
.register-section {
    background: var(--my-white);
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
}

.register-section .register-wrapper {
    width: 500px;
    padding: 20px 0;
}

.register-section .register-wrapper button.btn {
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

.register-section .register-wrapper button.btn:hover {
    background: var(--my-gray);
}

.register-section .register-wrapper a {
    color: var(--my-black);
}

.register-section .register-wrapper a:hover {
    color: var(--my-gray);
}
</style>
