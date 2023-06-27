<template>
    <div class="write_to_us gap-3 mt-3 flex-column flex-lg-row" id=write_to_us>
        <div class=write_to_us__left>
            <h1 class=fs-2>Хотите что-нибудь узнать или предложить? Напишите&nbsp;нам!</h1>
        </div>
        <div class=write_to_us__right>
            <form method=post class="d-flex justify-content-between flex-column" @submit.prevent=createMessage>
                <div v-if=created class="alert alert-light">Сообщение успешно отправлено</div>
                <div class="form-floating mb-3">
                    <input v-model=name type=text name=name id=name placeholder=ИМЯ class=form-control>
                    <label for=name>ИМЯ</label>
                    <small v-if="errors.hasOwnProperty('name')" class=text-danger>{{ errors.name }}</small>
                </div>
                <div class="form-floating mb-3">
                    <input v-model=phone type=text name=phone id=phone placeholder=ТЕЛЕФОН class=form-control>
                    <label for=phone>ТЕЛЕФОН</label>
                    <small v-if="errors.hasOwnProperty('phone')" class=text-danger>{{ errors.phone }}</small>
                </div>
                <div class="form-floating mb-3">
                    <input v-model=email type=email name=email id=email placeholder=E-MAIL class=form-control>
                    <label for=email>E-MAIL</label>
                    <small v-if="errors.hasOwnProperty('email')" class=text-danger>{{ errors.email }}</small>
                </div>
                <div class="form-floating">
                    <textarea v-model=message type=text name=message id=message placeholder=СООБЩЕНИЕ class=form-control></textarea>
                    <label for=message>СООБЩЕНИЕ</label>
                    <small v-if="errors.hasOwnProperty('message')" class=text-danger>{{ errors.message }}</small>
                </div>
                <div class=my-3>
                    <div class="d-flex gap-2 privacy_policy">
                        <input v-model=privacy_policy type=checkbox id=privacy_policy name=privacy_policy>
                        <label class=black_label for=privacy_policy>
                            Нажав кнопку, Вы соглашаетесь с <router-link to=/privacy_policy>Политикой конфиденциальности</router-link>
                        </label>
                    </div>
                    <small v-if="errors.hasOwnProperty('privacy_policy')" class=text-danger>{{ errors.privacy_policy }}</small>
                </div>
                <button type=submit class=btn>
                    ЗАКАЗАТЬ ОБРАТНЫЙ ЗВОНОК
                    <svg xmlns="http://www.w3.org/2000/svg" width=25 height=25 fill=currentColor class="bi bi-arrow-right-short fs-5" viewBox="0 0 16 16">
                        <path d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "WriteToUs",
    data() {
        return {
            'name': null,
            'phone': null,
            'email': null,
            'message': null,
            'privacy_policy': false,
            'created': false,
            'errors': [],
        }
    },
    methods: {
        createMessage() {
            if (!this.privacy_policy) {
                this.errors = { privacy_policy: 'Необходимо принять политику конфиденциальности' };
                return;
            } else {
                this.errors = {};
            }
            this.created = false;

            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('phone', this.phone);
            formData.append('email', this.email);
            formData.append('message', this.message);

            this.create(formData);
        },
        create(formData) {
            const url = '/api/message';
            const config = { headers: { 'Content-Type': 'multipart/form-data' } };
            axios.post(url, formData, config).then(() => {
                this.created = true;
                this.name = null;
                this.phone = null;
                this.email = null;
                this.message = null;
                this.privacy_policy = false;
            }).catch(error => {
                if (error.response.status !== 422) return;

                let errors_list = JSON.parse(error.request.responseText).errors;
                for (const key in errors_list) this.errors[key] = errors_list[key][0];
            });
        }
    }
}
</script>

<style scoped>
.black_label {
    color: var(--my-black)!important;
}

.write_to_us {
    box-sizing: border-box;
    align-items: stretch;
    display: flex;
    justify-content: space-between;
}

.write_to_us__left {
    width: 50%;
    color: var(--my-white);
    background-color: var(--my-black);
    box-sizing: border-box;
    padding: 20px;
    border-radius: 20px;
    overflow: hidden;
}

.write_to_us__right {
    width: 50%;
    background-color: var(--my-white);
    box-sizing: border-box;
    padding: 20px;
    border-radius: 20px;
    overflow: hidden;
}

.write_to_us__right label {
    color: #c5c5c5;
}

.write_to_us__right input,
.write_to_us__right textarea {
    background-color: var(--my-light-gray);
    border: none;
    border-radius: 10px;
}

.write_to_us__right textarea {
    min-height: 150px !important;
}
.write_to_us__right .black_label a {
    color: var(--my-gray);
    filter: opacity(.8);
}

.write_to_us__right .black_label a:hover {
    filter: opacity(1);
}

.write_to_us .privacy_policy input,
.write_to_us .privacy_policy label {
    align-self: baseline;
}

@media(max-width: 992px) {
    .write_to_us div {
        width: 100%;
    }
}

.btn {
    background-color: var(--my-black);
    color: var(--my-white);
    border-radius: 25px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    padding: 0 30px;
    width: 100%;
    text-transform: uppercase;
}

.btn:hover {
    background-color: var(--my-gray);
    color: var(--my-white);
}

.btn:hover svg.bi-arrow-right-short {
    position: relative;
    animation: arrow 0.2s forwards;
}

@keyframes arrow {
    0% { left: 0; }
    100% { left: 5px; }
}
</style>
