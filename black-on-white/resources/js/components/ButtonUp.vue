<template>
    <div id=button-up @click=up :style="{ opacity: hidden ? 0 : 1 }">
        <span class=user-select-none>Наверх</span>
    </div>
</template>

<script>
export default {
    name: "ButtonUp",
    data() {
        return {
            hidden: true
        };
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
        up() {
            document.body.scrollTop = 0
            document.documentElement.scrollTop = 0;
        },
        handleScroll() {
            this.hidden = window.scrollY < 50;
        }
    }
}


</script>

<style scoped>
#button-up {
    opacity: 0;
    right: 0;
    margin: 0;
    position: fixed;
    bottom: 50px;
    outline:none;
    width: auto;
    color: var(--my-black);
    line-height: 30px;
    text-decoration: none;
    padding: 5px 20px;
    background: var(--my-white);

    border-radius: 4px 0 0 4px;
    -webkit-border-radius: 4px 0 0 4px;
    -moz-border-radius: 4px 0 0 4px;

    box-shadow: 0 2px 4px #999;
    -webkit-box-shadow: 0 2px 4px #999;
    -moz-box-shadow: 0 2px 4px #999;
    -o-box-shadow: 0 2px 4px #999;
    cursor:pointer;

    transition: opacity .1s ease-in-out;
}

#button-up:hover {
    background-color: var(--my-light-gray);
    transition: background-color .1s ease-in-out;
}
</style>
