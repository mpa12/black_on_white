<template>
    <div class="admin-section-wrapper">
        <admin-section title=Новости href=/admin/articles img-src=/images/postcard.svg />
        <admin-section title=Фотогалерея href=/admin/photo-gallery img-src=/images/card-image.svg />
        <admin-section title=Участники href=/admin/participants img-src=/images/people.svg />
        <admin-section title=Сообщения href=/admin/messages img-src=/images/envelope.svg />
    </div>
</template>

<script>
import AdminSection from '../../components/AdminSection.vue'

export default {
    name: "AdminIndex",
    components: {AdminSection}
}
</script>

<style scoped>
.admin-section-wrapper {
    width: 100%;
    height: auto;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
</style>
