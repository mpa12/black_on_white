<template>
    <router-link :to="href" class="btn" :style="cssProps">
        {{ title }}
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-short fs-5" viewBox="0 0 16 16">
            <path d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
        </svg>
    </router-link>
</template>

<script>
export default {
    name: "Button",
    props: {
        title: { type: String },
        href: { type: String },
        isBlack: { default: true, type: Boolean }
    },
    computed: {
        cssProps() {
            return {
                '--button-bg': ( (this.isBlack) ? 'var(--my-black)' : 'var(--my-white)' ),
                '--button-color': ( (!this.isBlack) ? 'var(--my-black)' : 'var(--my-white)' ),
            }
        }
    }
}
</script>

<style scoped>
    .btn {
        background-color: var(--button-bg);
        color: var(--button-color);
        border-radius: 25px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        padding: 0 30px;
        width: fit-content;
        text-transform: uppercase;
    }

    .btn:active {
        background-color: var(--button-bg)!important;
        color: var(--button-color)!important;
        filter: brightness(.9);
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
