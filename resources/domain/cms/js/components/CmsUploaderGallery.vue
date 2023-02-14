<template>
  <div class="uploader" :class="{'uploader--loading': loading}">
    <input type="hidden" :name="modelAttribute" :value="JSON.stringify(files)">
    <input class="hidden" @change="uploadFile" ref="uploader" multiple type="file" accept="image/*"/>

    <div class="uploader__form">
      <button type="button" @click="browseFiles" class="uploader__button--upload btn btn--primary"
              :class="{ 'btn--outlined' : ! loading }">
        <i class="fa fa-upload"></i>
        <span v-text="loading ? 'Идет загрузка...' : 'Загрузить файлы'"></span>
      </button>
    </div>

    <div class="uploader__gallery" v-if="files.length">
      <div class="uploader__gallery__item" v-for="file in files">
        <div class="uploader__gallery__delete" @click="removeFile(file)">
          <i class="fas fa-times"></i>
        </div>
        <img :src="file">
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'CmsUploaderGallery',
    props: {
      modelAttribute: {
        type: String,
        default: '',
      },
      uploadFolder: {
        type: String,
        required: true,
      },
      uploadedFiles: {
        type: Array,
        required: [],
      },
    },
    data () {
      return {
        loadingCount: 0,
        files: [],
      }
    },
    mounted () {
      this.files = this.uploadedFiles
    },
    computed: {
      loading () {
        return this.loadingCount > 0
      },
    },
    methods: {
      browseFiles () {
        if (!this.loading) {
          this.$refs.uploader.click()
        }
      },
      decreaseLoading () {
        this.loadingCount--
      },
      removeFile (path) {
        if (!this.loading) {
          this.loadingCount = 1

          window.axios.delete('/cms/uploads', {
            params: { path: path }
          }).then(() => {
            let tempFiles = this.files
            tempFiles.splice(tempFiles.indexOf(path), 1)

            this.files = tempFiles
            this.decreaseLoading()
          }).catch(() => {
            this.decreaseLoading()
          })
        }
      },
      uploadFile (e) {
        if (!this.loading && e.target.files.length) {
          for (let i = 0; i < e.target.files.length; i++) {
            let formData = new FormData()
            formData.append('upload', e.target.files[i])
            formData.append('folder', this.uploadFolder)

            this.loadingCount++

            window.axios.post('/cms/uploads', formData, {
              headers: { 'Content-Type': 'multipart/form-data' }
            }).then(({ data }) => {
              this.files.push(data.url)
              this.decreaseLoading()
            }).catch(() => {
              this.decreaseLoading()
            })
          }

          this.$refs.uploader.value = ''
        }
      },
    },
  }
</script>
