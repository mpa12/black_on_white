<template>
    <toast v-if=success title="На почту отправлено письмо" />
    <section class=reset-password-section>
        <form class=reset-password-wrapper @submit.prevent=resetPassword>
            <h1 class=mb-4>Восстановление пароля</h1>
            <div class=mb-3>
                <label for=email class=form-label>E-mail</label>
                <input v-model=email type=text class=form-control id=email placeholder=E-mail>
                <small v-if="errors.hasOwnProperty('email')" class=text-danger>{{ errors.email }}</small>
            </div>
            <button type=submit class="btn btn-circle mb-4">Восстановить</button>
        </form>
    </section>
</template>

<script>
import Toast from "../components/Toast.vue"

export default {
    name: "ResetPassword",
    components: { Toast },
    data() {
        return {
            email: null,
            errors: [],
            success: false,
        }
    },
    methods: {
        resetPassword() {
            axios.post('/api/auth/reset-password', {
                email: this.email,
            }).then(() => {
                this.success = true
                this.email = null
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
.reset-password-section {
    background: var(--my-white);
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
}

.reset-password-section .reset-password-wrapper {
    width: 500px;
    padding: 20px 0;
}

.reset-password-section .reset-password-wrapper button.btn {
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

.reset-password-section .register-wrapper button.btn:hover {
    background: var(--my-gray);
}

.reset-password-section .register-wrapper a {
    color: var(--my-black);
}

.reset-password-section .register-wrapper a:hover {
    color: var(--my-gray);
}
</style>
