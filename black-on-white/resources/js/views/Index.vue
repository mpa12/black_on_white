<template>
    <index-banner />
    <index-info />
    <index-last-news />
    <about-us />
    <write-to-us />
</template>

<script>
import IndexBanner from "../components/IndexBanner.vue";
import IndexInfo from "../components/IndexInfo.vue";
import IndexLastNews from "../components/IndexLastNews.vue";
import AboutUs from "../components/AboutUs.vue";
import WriteToUs from "../components/WriteToUs.vue";

export default {
    name: "Index",
    components: { IndexBanner, IndexInfo, IndexLastNews, AboutUs, WriteToUs }
}
</script>

<style scoped>

</style>
