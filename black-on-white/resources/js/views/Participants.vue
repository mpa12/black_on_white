<template>
    <div class="title my-3">
        <h1>Участники театра</h1>
    </div>
    <section class="participants-section my-3">
        <participant-card name="Андрей Андреевич" role="Актер" src="https://i.etsystatic.com/23559605/r/il/e4cc77/2435317011/il_794xN.2435317011_jgsj.jpg"/>
        <participant-card name="Андрей Андреевич" role="Актер" src="https://i.etsystatic.com/23559605/r/il/e4cc77/2435317011/il_794xN.2435317011_jgsj.jpg"/>
        <participant-card name="Андрей Андреевич" role="Актер" src="https://i.etsystatic.com/23559605/r/il/e4cc77/2435317011/il_794xN.2435317011_jgsj.jpg"/>
        <participant-card name="Андрей Андреевич" role="Актер" src="https://i.etsystatic.com/23559605/r/il/e4cc77/2435317011/il_794xN.2435317011_jgsj.jpg"/>
        <participant-card name="Андрей Андреевич" role="Актер" src="https://i.etsystatic.com/23559605/r/il/e4cc77/2435317011/il_794xN.2435317011_jgsj.jpg"/>
    </section>
</template>

<script>
import ParticipantCard from "../components/ParticipantCard.vue";
export default {
    name: "Participants",
    components: {ParticipantCard}
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
