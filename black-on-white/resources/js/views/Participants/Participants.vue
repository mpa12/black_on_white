<template>
    <div class="title my-3">
        <h1>Участники театра</h1>
    </div>
    <section class="participants-section my-3">
        <participant-card
            v-for="participant in participants"
            :name="participant.name"
            :role="participant.role"
            :src="'/storage/' + participant.photo"
        />
    </section>
</template>

<script>
import ParticipantCard from "../../components/ParticipantCard.vue";
import axios from "axios";
export default {
    name: "Participants",
    components: {ParticipantCard},
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
        }
    }
}
</script>

<style scoped>
.participants-section {
    width: 100%;
    background: var(--my-white);
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.title {
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
}
</style>
