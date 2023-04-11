<template>
    <div class="gallery">
        <div class="gallery-item" v-for="(image, index) in images" :key="index">
            <img class="gallery-image" :src="image.src" @click="openImage(index)" alt="Фото" />
            <div @click="closeImage(index)" class="overlay" v-if="image.show">
                <img :src="image.src" @click="closeImage(index)" alt="Фото" />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "PhotoGallery",
    data() {
        return {
            images: [
                { src: 'https://avatars.mds.yandex.net/i?id=f7f7f05383c16827da3b369ba44114f6b1af936d-3823851-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=c5c177e2c8b89b7f9f4de961c690e47790602e3b-8240946-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=2825d42d36bcdeebe57c1e57ca4a3c8f8030a060-8564995-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=f7a347c2a572387aa2ae96cf7288d0dcfa753eeb-9291460-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=f7f7f05383c16827da3b369ba44114f6b1af936d-3823851-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=c5c177e2c8b89b7f9f4de961c690e47790602e3b-8240946-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=2825d42d36bcdeebe57c1e57ca4a3c8f8030a060-8564995-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=f7a347c2a572387aa2ae96cf7288d0dcfa753eeb-9291460-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=2825d42d36bcdeebe57c1e57ca4a3c8f8030a060-8564995-images-thumbs&n=13', show: false },
                { src: 'https://avatars.mds.yandex.net/i?id=f7a347c2a572387aa2ae96cf7288d0dcfa753eeb-9291460-images-thumbs&n=13', show: false },
            ],
        };
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
