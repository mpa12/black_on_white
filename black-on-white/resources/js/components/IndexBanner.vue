<template>
    <div class="d-flex gap-3 flex-lg-row flex-column">
        <div class=index-image-wrapper>
            <img src=/images/index-banner.avif alt=Маска class=index-image>
        </div>
        <div class="index-text">
            <h1 class="fw-bold">СТУДЕНЧЕСКИЙ ТЕАТР «ЧЕРНЫМ&nbsp;ПО&nbsp;БЕЛОМУ»</h1>
            <p class="mt-3 flex-grow-1 w-50">
                Студенческий театр Хабаровского колледжа отраслевых технологий и&nbsp;сферы обслуживания.<br>
                Руководитель - Юлия&nbsp;Пирюткина
            </p>
            <v-button title=Смотреть спектакли href=/article></v-button>
        </div>
    </div>
</template>

<script>
export default {
    name: "IndexBanner"
}
</script>

<style scoped>
.index-image-wrapper {
    width: 50%;
}

.index-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    object-position: center;
    border-radius: 20px;
}

.index-text {
    width: 50%;
    padding: 20px;
    box-sizing: border-box;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    background-color: var(--my-white);
}

.index-text h1 {
    color: var(--my-black);
}

.index-text p {
    color: var(--my-gray);
}

@media(max-width: 992px) {
    .index-image-wrapper {
        width: 100%;
    }

    .index-text h1 {
        font-size: 22px;
    }

    .index-text,
    .index-text p {
        width: 100%!important;
    }
}
</style>
