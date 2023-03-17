<template>
    <div class="about_us gap-3 flex-lg-row flex-column mt-3" id="about_us">
        <div class="about_us__left">
            <h1 class="fs-2">О студенческом театре</h1>
            <div>
                <p>
                    Название – <b>«Чёрным&nbsp;по&nbsp;белому»</b> – выбрано&nbsp;не случайно. Фразеологизм чёрным по белому означает
                    <b>«совершенно ясно, чётко, определённо»</b>. И&nbsp;это значит, что&nbsp;мы постараемся сделать
                    наши спектакли понятными&nbsp;и интересными для зрителя.
                </p>
                <p>
                    Стилистика театра также предполагает <b>наличие только двух цветов – чёрного и белого</b>.
                    Декорации и&nbsp;реквизит выполнены, в&nbsp;основном, в&nbsp;белом цвете, что помогает, с&nbsp;одной стороны,
                    расширить пространство небольшой сцены колледжа, с&nbsp;другой стороны, акцентировать внимание
                    зрителей на&nbsp;фигурах актёров или тенях. Кроме того, <b>чёрно-белая гамма</b> позволяет сделать костюмы
                    и&nbsp;декорации универсальными.
                </p>
                <p>
                    Ещё одной особенностью спектаклей является наличие элементов <b>театра теней</b>. Тени (картонных
                    фигурок или фигур самих актёров) проецируются на&nbsp;специальный экран из&nbsp;белой ткани – <b>изображение</b>
                    получается буквально <b>«чёрным&nbsp;по&nbsp;белому»</b>.
                </p>
            </div>
        </div>
        <div class="d-flex flex-lg-column flex-column-reverse justify-content-start align-items-start w-50">
            <p>
                Студенческий театр <b>«Чёрным&nbsp;по&nbsp;белому»</b> был основан <b>в&nbsp;2019&nbsp;году</b> в&nbsp;Хабаровском колледже отраслевых
                технологий и&nbsp;сферы обслуживания.<br>Руководитель: <b>Юлия Владимировна Пирюткина</b>
            </p>
            <img src="/images/about-us.jpg" alt="О нас" class="about_us__photo">
        </div>
    </div>
</template>

<script>
export default {
    name: "AboutUs"
}
</script>

<style scoped>
.about_us {
    margin-top: 8px;
    padding: 20px;
    box-sizing: border-box;
    align-items: stretch;
    display: flex;
    justify-content: space-between;
    border-radius: 20px;
    overflow: hidden;
    background-color: var(--my-light-gray);
}

.about_us h1 {
    color: var(--my-black);
}

.about_us p {
    color: var(--my-gray);
}

.about_us .about_us__left {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 50%;
    box-sizing: border-box;
    padding-right: 20px;
}

.about_us .about_us__photo {
    width: 100%;
    overflow: hidden;
    border-radius: 20px;
}

@media(max-width: 992px) {
    .about_us h1 {
        margin-bottom: 20px;
    }

    .about_us img {
        margin-bottom: 20px;
    }

    .about_us div {
        width: 100%!important;
    }
}
</style>
