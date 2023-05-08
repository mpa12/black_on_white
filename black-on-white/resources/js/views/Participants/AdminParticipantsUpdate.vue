<template>
    <toast v-if=updated title="Участник успешно изменен" />

    <div class="title my-3">
        <h1>Редактирование участника</h1>
    </div>

    <div class=form-wrapper>
        <form @submit.prevent=create>
            <div class=mb-3>
                <label for=name class=form-label>ФИО участника</label>
                <input v-model=name type=text class=form-control id=name>
                <small v-if="errors.hasOwnProperty('name')" class=text-danger>{{ errors.name }}</small>
            </div>
            <div class=mb-3>
                <label for=role class=form-label>Роль участника</label>
                <input v-model=role type=text class=form-control id=role>
                <small v-if="errors.hasOwnProperty('role')" class=text-danger>{{ errors.role }}</small>
            </div>
            <div class=mb-3>
                <div v-if=installedPhoto class="w-100 d-flex align-items-center justify-content-center">
                    <img :src=installedPhoto class=w-50 alt="Фото участника">
                </div>
                <label for=photo class=form-label>Фото участника</label>
                <input v-on:change=handlePhotoUpload ref=files class=form-control type=file id=photo>
                <small v-if="errors.hasOwnProperty('photo')" class=text-danger>{{ errors.photo }}</small>
            </div>
            <div class="d-flex gap-2">
                <button type=submit class="btn btn-primary">Сохранить</button>
                <router-link class="btn btn-secondary" to="/admin/participants">Отмена</router-link>
            </div>
        </form>
    </div>
</template>

<script>
import Toast from "../../components/Toast.vue";

export default {
    name: "AdminParticipantsUpdate",
    components: { Toast },
    data() {
        return {
            errors: [],
            installedPhoto: null,
            name: null,
            role: null,
            photo: null,
            data: null,
            updated: false,
        }
    },
    mounted() {
        this.loadParticipant()
    },
    methods: {
        loadParticipant() {
            axios.get(`/api/participant/${this.$route.params.id}`, null, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "Authorization" : `Bearer ${localStorage.getItem('token')}`
                }
            }).then((response) => {
                this.name = response.data['data']['name']
                this.role = response.data['data']['role']
                this.installedPhoto = response.data['data']['photo']
            }).catch(error => {
                console.log(error)
            })
        },
        handlePhotoUpload() {
            this.photo = this.$refs.files.files[0]
        },
        getData() {
            let formData = new FormData()
            formData.append('name', this.name)
            formData.append('role', this.role)
            formData.append('photo', this.photo)

            this.data = formData
        },
        create() {
            this.getData()

            axios.post(`/api/participant/${this.$route.params.id}`, this.data, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    "Authorization" : `Bearer ${localStorage.getItem('token')}`
                }
            }).then((response) => {
                this.errors = []
                this.name = response.data['success']['name']
                this.role = response.data['success']['role']
                this.photo = null
                this.installedPhoto = response.data['success']['photo']
                this.updated = true
            }).catch(error => {
                if (error.response.status === 422) {
                    this.errors = []
                    let errors = JSON.parse(error.request.responseText).errors
                    for (const key in errors) this.errors[key] = errors[key][0]
                }
            })
        }
    }
}
</script>

<style scoped>
.form-wrapper,
.title {
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
}
</style>