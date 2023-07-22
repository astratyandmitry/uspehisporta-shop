<template>
  <div class="media-gallery">
    <div class="media-gallery__main">
      <a data-lightbox="image-1" :href="imgs[active]" style="max-height: 100%; display: flex; align-items: center; justify-content: center">
        <img :src="imgs[active]" :alt="name" class="media__image">
      </a>
    </div>

    <div class="media-gallery__list" v-if="imgs.length > 1">
      <div :class="key == active ? 'media-gallery__item media-gallery__item--active' : 'media-gallery__item'"
           v-for="(img, key) in imgs"
           @click="active = key">
        <img :src="img" :alt="name" class="media-gallery__image">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductGallery',
  props: {
    name: {
      type: String,
      required: true
    },
    main: {
      type: String,
      required: true
    },
    gallery: {
      type: Array,
      required: false,
      default: []
    },
  },
  mounted () {
    if (this.gallery) {
      this.imgs = [this.main, ...this.gallery]
    } else {
      this.imgs = [this.main]
    }
  },
  data () {
    return {
      imgs: [],
      active: 0,
    }
  },
}
</script>
