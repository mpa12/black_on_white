<template>
    <div class="d-flex justify-content-around benefits flex-wrap gap-2">
        <div class="d-flex flex-column align-items-center justify-content-start">
            <h1>{{ year }}</h1>
            <p>ГОДА ПРОВОДИМ<br>СПЕКТАКЛИ</p>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-start">
            <h1>{{ participants }}</h1>
            <p>ТАЛАНТЛИВЫХ<br>УЧАСТНИКОВ</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "IndexInfo",
    data() {
        return {
            'year': null,
            'participants': null,
        }
    },
    mounted() {
        this.getYear()
        this.getParticipants()
    },
    methods: {
        getYear() {
            this.year = new Date().getFullYear() - 2019
        },
        getParticipants() {
            axios.get('/api/participant/count').then(response => {
                this.participants = response.data
            })
        }
    }
}
</script>

<style scoped>
.benefits {
    padding: 80px 20px;
    margin-top: 40px;
    margin-bottom: 40px;
    border-top: 2px solid var(--my-black);
    border-bottom: 2px solid var(--my-black);
    text-align: center;
}

.benefits h1 {
    font-size: 100px;
    color: var(--my-black);
}

.benefits p {
    color: var(--my-gray);
}
</style>
