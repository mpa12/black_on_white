<template>

</template>

<script>
import User from "../../models/User";

export default {
    name: "Logout",
    created() {
        User.logout();

        let evt = new CustomEvent('localStorageUpdated', { detail: null });
        window.dispatchEvent(evt);

        this.$router.push('/');
    },
}
</script>

<style scoped>

</style>
