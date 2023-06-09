<template>
    <toast v-if=success title="Пароль успешно изменен" />

    <section class=invalid-token v-if=(!token_valid)>
        <h3>Пользователь не найден</h3>
    </section>

    <section class=reset-password-response v-if=token_valid>
        <form class=reset-password-response-wrapper @submit.prevent=resetPassword>
            <h1 class=mb-4>Восстановление пароля</h1>
            <div class=mb-3>
                <label for=password class=form-label>Пароль</label>
                <input v-model=new_password type=password class=form-control id=password placeholder="Введите новый пароль">
                <small v-if="errors.hasOwnProperty('new_password')" class=text-danger>{{ errors.new_password }}</small>
            </div>
            <button type=submit class="btn btn-circle mb-4">Восстановить пароль</button>
        </form>
    </section>
</template>

<script>
import Toast from "../../components/Toast.vue";

export default {
    name: "ResetPasswordResponse",
    components: { Toast },
    data() {
        return {
            remember_token: null,
            token_valid: true,
            new_password: null,
            errors: [],
            success: false,
        }
    },
    mounted() {
        this.remember_token = this.$route.params.remember_token
        this.tokenIsValid()
    },
    methods: {
        tokenIsValid() {
            axios.post(process.env.VUE_APP_URL + '/api/auth/validate-token', {
                remember_token: this.remember_token
            }).then(() => {
                this.token_valid = true
            }).catch(error => {
                console.log(error)
                this.token_valid = false
            })
        },
        resetPassword() {
            axios.post(process.env.VUE_APP_URL + '/api/auth/reset-password-response', {
                remember_token: this.remember_token,
                new_password: this.new_password
            }).then(() => {
                this.new_password = null
                this.errors = []
                this.success = true
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
.invalid-token {
    border-radius: 20px;
    background: var(--my-white);
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
}

.invalid-token h3 {
    color: var(--bs-danger);
}

.reset-password-response {
    border-radius: 20px;
    background: var(--my-white);
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
}

.reset-password-response .reset-password-response-wrapper {
    width: 500px;
    padding: 20px 0;
}

.reset-password-response .reset-password-response-wrapper button.btn {
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

.reset-password-response .reset-password-response-wrapper button.btn:hover {
    background: var(--my-gray);
}

.reset-password-response .reset-password-response-wrapper a {
    color: var(--my-black);
}

.reset-password-response .reset-password-response-wrapper a:hover {
    color: var(--my-gray);
}
</style>
