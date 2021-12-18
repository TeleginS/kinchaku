<template>
  <div class="submit-form">
    <div v-if="errors">
      <h4>{{ errorMessage }}</h4>
    </div>
    <div v-if="!submitted">
      <div class="form-group">
        <input class='form-control' type='file' id='file' @change='handleFileUpload( $event )' required name='file'/>
      </div>
      <button @click="submitFile" class="btn btn-success">Submit</button>
    </div>
    <div v-else>
      <h4>You submitted successfully!</h4>
    </div>
  </div>
</template>

<script>
import ArticlesDataService from '../services/ArticleDataService'

export default {
  name: "upload-articles",
  data() {
    return {
      file: '',
      submitted: false,
      errors: false,
      errorMessage: '',
    }
  },
  methods: {
    handleFileUpload(event) {
      this.file = event.target.files[0]
      this.errors = false
    },
    submitFile() {
      this.errors = false

      if ('' === this.file) {
        this.errors = true
        this.errorMessage = 'Choose file for uploading'
        return
      }

      if ('application/json' !== this.file.type) {
        this.errors = true
        this.errorMessage = 'Allowed only json files'
        return
      }

      let formData = new FormData()
      formData.append('file', this.file)
      ArticlesDataService.upload(formData)
          .then(response => {
            console.log(response.data)
            this.submitted = true
          })
          .catch(e => {
            console.log(e)
            this.errors = true
            this.errorMessage = e.response.data.message
          })
    },
  }
}
</script>

<style>
.submit-form {
  max-width: 300px;
  margin: auto;
}
</style>