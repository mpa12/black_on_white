<template>
    <div class="modal fade" id=deleteModal>
        <div class="modal-dialog modal-dialog-centered">
            <div class=modal-content>
                <div class=modal-header>
                    <h1 class="modal-title fs-5">Удаление участника <span>&laquo;{{ deleteParticipantInfo.name }}&raquo;</span></h1>
                    <button type=button class=btn-close data-bs-dismiss=modal></button>
                </div>
                <div class=modal-body>
                    Вы уверенны, что хотите удалить участника <span>&laquo;{{ deleteParticipantInfo.name }}&raquo;</span>?
                </div>
                <div class="modal-footer justify-content-start">
                    <button type=button class="btn btn-secondary" data-bs-dismiss=modal>Отмена</button>
                    <button type=button class="btn btn-danger" @click=deleteParticipant(deleteParticipantInfo.id) data-bs-dismiss=modal>Удалить</button>
                </div>
            </div>
        </div>
    </div>

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
                <td>{{ changeDate(participant.created_at) }}</td>
                <td>{{ changeDate(participant.updated_at) }}</td>
                <td>
                    <div class=dropdown>
                        <span type=button data-bs-toggle=dropdown><img src=/images/three-dots-vertical.svg alt=three-dots-vertical type=button data-toggle=dropdown></span>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><router-link class=dropdown-item :to="'/admin/participants/update/' + participant.id">Редактировать</router-link></li>
                            <li><span @click=loadDeleteParticipant(participant.id) class=dropdown-item type=button data-bs-toggle=modal data-bs-target="#deleteModal">Удалить</span></li>
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
import { directive } from 'vue-tippy';
import { changeDate } from "../../utils/ChangeDate";

export default {
    name: "AdminParticipants",
    directives: {
        tippy: directive,
    },
    data() {
        return {
            participants: [],
            deleteParticipantInfo: [],
        }
    },
    mounted() {
        this.loadParticipants()
    },
    methods: {
        changeDate,
        loadParticipants() {
            axios.get(process.env.VUE_APP_URL + '/api/participant').then(response => {
                this.participants = response.data['data']
            })
        },
        getImgTag(src, alt) {
            return `<img width=150 style="border-radius: 10px" src="${src}" alt="${alt}">`
        },
        loadDeleteParticipant(id) {
            axios.get(process.env.VUE_APP_URL + '/api/participant/' + id).then(response => {
                this.deleteParticipantInfo = response.data['data']
            })
        },
        deleteParticipant(id) {
            axios.post(
                process.env.VUE_APP_URL + '/api/participant/' + id,
                {
                    _method: 'delete',
                },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem('token')}`
                    }
                }
            ).then(this.loadParticipants).catch(console.error)
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
