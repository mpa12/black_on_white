<template>
    <div class="participants-card">
        <div class="participants-card-img">
            <img :alt="name" :src="src">
        </div>
        <h5 class="text-center">{{ name }}</h5>
        <p class="text-secondary text-center">{{ role }}</p>
    </div>
</template>

<script>
export default {
    name: "ParticipantCard",
    props: ['name', 'role', 'src']
}
</script>

<style scoped>
.participants-card {
    width: calc(100% / 4 - (60px / 4));
    height: 350px;
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-light);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.participants-card-img {
    width: 100%;
    height: 300px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.participants-card-img img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    object-position: center;
}

@media (max-width: 992px) {
    .participants-card {
        width: calc(100% / 2 - (20px / 2));
    }
}

@media (max-width: 768px) {
    .participants-card {
        width: 100%;
    }

    .participants-card-img {
        height: 200px;
    }

    .participants-card-img img {
        width: 150px;
        height: 150px;
    }
}
</style>
