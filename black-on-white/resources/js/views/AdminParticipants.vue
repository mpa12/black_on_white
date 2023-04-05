<template>
    <div class="title my-3 d-flex align-items-center gap-3">
        <h1>Управление участниками театра</h1>
        <router-link to="/admin/participants/create" class="btn btn-primary">Создать</router-link>
    </div>

    <div class=table-wrapper>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>ID</th>
                <th>ФИО</th>
                <th>Роль</th>
                <th>Фото</th>
                <th>Создано</th>
                <th>Обновлено</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(participant, index) in participants">
                <th>{{ index + 1 }}</th>
                <td>{{ participant.id }}</td>
                <td class="text-truncate user-select-none" :title="participant.name">{{ participant.name }}</td>
                <td class=text-truncate :title="participant.role">{{ participant.role }}</td>
                <td>
                    <svg v-tippy="{ content: getImgTag(participant.photo, participant.name) }" width=20 height=20 fill=gray class=bi-card-image viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                    </svg>
                </td>
                <td>{{ convertDate(participant.created_at) }}</td>
                <td>{{ convertDate(participant.updated_at) }}</td>
                <td>
                    <div class=dropdown>
                        <span type=button data-bs-toggle=dropdown>
                            <img src=/images/three-dots-vertical.svg alt=three-dots-vertical type=button data-toggle=dropdown>
                        </span>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><router-link class=dropdown-item :to="'/admin/participants/update/' + participant.id">Редактировать</router-link></li>
                            <li>
                                <span @click=loadDeleteParticipant(participant.id) class=dropdown-item type=button data-bs-toggle=modal data-bs-target="#deleteModal">
                                    Удалить
                                </span>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
import moment from 'moment/min/moment-with-locales'
import { directive } from 'vue-tippy'

export default {
    name: "AdminParticipants",
    directives: {
        tippy: directive,
    },
    data() {
        return {
            'participants': [],
        }
    },
    mounted() {
        this.loadParticipants()
    },
    methods: {
        loadParticipants() {
            axios.get('/api/participant').then(response => {
                this.participants = response.data['data']
            })
        },
        convertDate(date) {
            date = new Date(date)
            const diff = moment.duration(moment().diff(date))
            if (diff.asMinutes() < 60) {
                let test = (new Date()).getTime() - date.getTime()
                test = (new Date(test)).getMinutes()
                return test + ' минут назад'
            } else if (diff.asHours() < 24) {
                return moment().subtract(diff).format('HH часов назад')
            } else if (diff.asDays() < 2) {
                return moment().subtract(diff).format('Вчера в HH:mm')
            } else {
                moment.locale('ru')
                return moment(date).format('D MMMM в HH:mm YYYY')
            }
        },
        getImgTag(src, alt) {
            return `<img width=150 style="border-radius: 10px" src="${src}" alt="${alt}">`
        }
    }
}
</script>

<style scoped>
.table-wrapper,
.title {
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
}

.table-wrapper .text-truncate {
    max-width: 300px;
}

.bi-card-image:hover {
    fill: var(--bs-primary);
}
</style>
