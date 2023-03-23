<template>
    <section class="admin-section">
        <img :src="imgSrc" :alt="title" class="admin-section-img">
        <v-button :title="title" :href="href"></v-button>
    </section>
</template>

<script>
export default {
    name: "AdminSection",
    props: ['title', 'imgSrc', 'href']
}
</script>

<style scoped>
.admin-section {
    width: calc((100% / 3) - (40px / 3));
    display: flex;
    height: 400px;
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
    color: var(--my-black);
    text-decoration: none;
    transition: background .3s ease-in-out;
    align-items: flex-end;
    position: relative;
    overflow: hidden;
}

.admin-section:hover {
    background: var(--my-light-gray);
}

.admin-section .admin-section-img {
    position: absolute;
    width: 300px;
    height: 300px;
    top: 0;
    left: -30%;
    filter: opacity(.5);
    transition: all .3s ease-in-out;
}

.admin-section:hover .admin-section-img {
    filter: opacity(.6);
    left: 20px;
}

@media(max-width: 992px) {
    .admin-section {
        width: calc((100% / 2) - (20px / 2));
    }
}

@media(max-width: 768px) {
    .admin-section {
        width: 100%;
    }

    .admin-section .admin-section-img {
        left: -10%;
    }
}
</style>
