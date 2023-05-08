<template>

</template>

<script>
export default {
    name: "Logout",
    created() {
        localStorage.removeItem('token');

        let evt = new CustomEvent('localStorageUpdated', { detail: null });
        window.dispatchEvent(evt);

        this.$router.push('/');
    },
}
</script>

<style scoped>

</style>
