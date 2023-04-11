<template>
    <div class="gallery">
        <div class="gallery-item" v-for="(image, index) in images" :key="index">
            <img class="gallery-image" :src="image.src" @click="openImage(index)" alt="Фото" />
            <div @click="closeImage(index)" class="overlay" v-if="image.show">
                <img :src="image.src" @click="closeImage(index)" alt="Фото" />
            </div>
        </div>
    </div>
    <div v-if="loading" class="text-center">Loading...</div>
</template>

<script>
import axios from "axios";

export default {
    name: "PhotoGallery",
    data() {
        return {
            images: [],
            page: 1,
            totalPages: null,
            loading: false,
        };
    },
    mounted() {
        this.loadImages()
        window.addEventListener('scroll', this.handleScroll)
    },
    destroyed() {
        window.removeEventListener('scroll', this.handleScroll)
    },
    methods: {
        openImage(index) {
            this.images[index].show = true;
            document.body.style.overflow = 'hidden';
        },
        closeImage(index) {
            this.images[index].show = false;
            document.body.style.overflow = 'auto';
        },
        loadImages() {
            this.loading = true
            let params = { page: this.page }
            axios.get('/api/photo-gallery', {params}).then(response => {
                let newData = response.data['data'].map(x => {
                    return {src: x.photo, show: false}
                })
                this.images = [...this.images, ...newData]
                this.totalPages = response.data['meta'].last_page
                this.loading = false
            })
        },
        handleScroll() {
            if (this.loading) return
            if (window.pageYOffset + window.innerHeight >= document.body.offsetHeight) {
                if (this.page < this.totalPages) {
                    this.page += 1
                    this.loadImages()
                }
            }
        }
    },
}
</script>

<style scoped>
.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    grid-gap: 10px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-radius: 10px;
    cursor: pointer;
}

.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10;
}

.overlay img {
    max-width: 90%;
    max-height: 90%;
    object-fit: cover;
    cursor: pointer;
}
</style>
