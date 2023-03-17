<template>
    <div class="d-flex justify-content-around benefits flex-wrap gap-2">
        <div class="d-flex flex-column align-items-center justify-content-start">
            <h1>3</h1>
            <p>ГОДА ПРОВОДИМ<br>СПЕКТАКЛИ</p>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-start">
            <h1>10</h1>
            <p>ТАЛАНТЛИВЫХ<br>УЧАСТНИКОВ</p>
        </div>
        <div class="d-flex flex-column align-items-center justify-content-start">
            <h1>38</h1>
            <p>ВЫСТУПЛЕНИЙ</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "IndexInfo"
}
</script>

<style scoped>
.benefits {
    padding: 80px 20px;
    margin-top: 40px;
    margin-bottom: 100px;
    border-top: 2px solid var(--my-black);
    border-bottom: 2px solid var(--my-black);
    text-align: center;
}

.benefits h1 {
    font-size: 100px;
    color: var(--my-black);
}

.benefits p {
    color: var(--my-gray);
}
</style>
