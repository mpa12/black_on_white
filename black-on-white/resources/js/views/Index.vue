<template>
    <index-banner />
    <index-info />
    <index-last-news />
    <about-us />
    <write-to-us />
</template>

<script>
import IndexBanner from "../components/IndexPage/IndexBanner.vue";
import IndexInfo from "../components/IndexPage/IndexInfo.vue";
import IndexLastNews from "../components/IndexPage/IndexLastNews.vue";
import AboutUs from "../components/IndexPage/AboutUs.vue";
import WriteToUs from "../components/IndexPage/WriteToUs.vue";

export default {
    name: "Index",
    components: { IndexBanner, IndexInfo, IndexLastNews, AboutUs, WriteToUs }
}
</script>

<style scoped>

</style>
