<template>
  <div class="uploader" :class="{'uploader--loading': loading}">
    <input type="hidden" :name="modelAttribute" :value="file">
    <input class="hidden" @change="uploadFile" ref="uploader" type="file" :accept="accept"/>

    <div class="uploader__form">
      <button type="button" @click="browseFiles" class="uploader__button--upload btn btn--primary"
              :class="{ 'btn--outlined' : ! loading }">
        <i class="fa fa-upload"></i>
        <span v-text="loading ? 'Идет загрузка...' : 'Загрузить файл'"></span>
      </button>

      <template v-if="file">
        <button type="button" class="uploader__button--remove btn btn--danger btn--outlined" @click="removeFile">
          <i class="fa fa-trash"></i>
        </button>

        <a :href="file" target="_blank" class="uploader__button--download btn">
          Скачать файл
        </a>
      </template>
    </div>

    <div class="uploader__preview" v-if="acceptOnlyImages && file">
      <img :src="file">
    </div>
  </div>
</template>

<script>
  export default {
    name: 'CmsUploader',
    props: {
      modelAttribute: {
        type: String,
        default: '',
      },
      uploadFolder: {
        type: String,
        required: true,
      },
      accept: {
        type: String,
        default: '*',
      },
      uploadedFile: {
        type: String,
        required: false,
      },
    },
    data () {
      return {
        loading: false,
        file: '',
      }
    },
    mounted () {
      this.file = this.uploadedFile
    },
    computed: {
      acceptOnlyImages () {
        return this.accept === 'image/*'
      },
    },
    methods: {
      browseFiles () {
        if (!this.loading) {
          this.$refs.uploader.click()
        }
      },
      removeFile () {
        if (!this.loading && this.file) {
          this.loading = true

          window.axios.delete('/cms/uploads', {
            params: { path: this.file }
          }).then(() => {
            this.file = ''
            this.loading = false
          }).catch(() => {
            this.loading = false
          })
        }
      },
      uploadFile (e) {
        if (!this.loading && e.target.files.length) {
          let formData = new FormData()
          formData.append('upload', e.target.files[0])
          formData.append('folder', this.uploadFolder)

          this.loading = true

          window.axios.post('/cms/uploads', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
          }).then(({ data }) => {
            this.file = data.url
            this.loading = false
          }).catch(() => {
            this.$refs.uploader.value = ''
            this.loading = false
          })
        }
      },
    },
  }
</script>
