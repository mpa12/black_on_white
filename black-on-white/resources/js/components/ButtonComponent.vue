<template>
    <a :href="href" class="btn">
        {{ title }}
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-short fs-5" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
        </svg>
    </a>
</template>

<script>
export default {
    name: "ButtonComponent",
    props: ['title', 'href']
}
</script>

<style scoped>
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
        width: fit-content;
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
