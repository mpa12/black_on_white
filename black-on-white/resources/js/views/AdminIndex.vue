<template>
    <div class="admin-section-wrapper">
        <admin-section title=Новости href=# img-src=/images/postcard.svg />
        <admin-section title=Фотогалерея href=# img-src=/images/card-image.svg />
        <admin-section title=Участники href=# img-src=/images/people.svg />
        <admin-section title=Пользователи href=# img-src=/images/people.svg />
        <admin-section title=Сообщения href=# img-src=/images/envelope.svg />
    </div>
</template>

<script>
import AdminSection from '../components/AdminSection.vue'

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
