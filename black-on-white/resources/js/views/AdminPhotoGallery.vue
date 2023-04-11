<template>
    <div class="modal fade" id=deleteModal>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Вы действительно хотите удалить изображение?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <img :src="deleteSrc" class="w-100 rounded-2" alt="Фото" />
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss=modal>Закрыть</button>
                    <button type="button" class="btn btn-danger" @click="deleteImage(deleteId, deleteIndex)" data-bs-dismiss=modal>Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <div class="title my-3 d-flex align-items-center gap-3">
        <h1>Управление фотогалереей</h1>
        <span class="btn btn-primary">Добавить фотографию</span>
    </div>

    <div class="gallery">
        <div class="gallery-item" v-for="(image, index) in images" :key="index">
            <img class="gallery-image" :src="image.src" alt="Фото" />
            <div class="gallery-buttons d-flex gap-2">
                <span class="badge bg-primary" @click=openImage(index)>Смотреть</span>
                <span class="badge bg-danger" @click=openDeleteImage(index) data-bs-toggle=modal data-bs-target="#deleteModal">Удалить</span>
            </div>
            <div @click="closeImage(index)" class="overlay" v-if="image.show">
                <img @click="closeImage(index)" :src="image.src" alt="Фото" />
            </div>
        </div>
    </div>
    <div v-if="loading" class="text-center">Loading...</div>
</template>

<script>
import axios from "axios";

export default {
    name: "AdminPhotoGallery",
    data() {
        return {
            images: [],
            page: 1,
            totalPages: null,
            loading: false,
            deleteSrc: null,
            deleteId: null,
            deleteIndex: null,
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
                    return {src: x.photo, show: false, id: x.id}
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
        },
        openDeleteImage(index) {
            this.deleteSrc = this.images[index].src
            this.deleteId = this.images[index].id
            this.deleteIndex = index
        },
        deleteImage(id, index) {
            axios.delete(`/api/photo-gallery/${id}`, {
                headers: { "Authorization" : `Bearer ${localStorage.getItem('token')}` }
            }).then(response => {
                this.images.splice(index,1);
                console.log(response)
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>

<style scoped>
.title {
    border-radius: 20px;
    padding: 20px;
    box-sizing: border-box;
    background: var(--my-white);
}

.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    grid-gap: 10px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
}

.gallery-buttons {
    position: absolute;
    top: 10px;
    left: 10px;
}

.gallery-buttons span {
    cursor: pointer;
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-radius: 10px;
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
