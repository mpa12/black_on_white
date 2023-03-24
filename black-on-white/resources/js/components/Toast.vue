<template>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast show" role="alert">
            <div class="toast-header rounded-2">
                <span class="me-auto">{{ title }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Toast",
    props: ['title'],
}
</script>

<style scoped>

</style>
