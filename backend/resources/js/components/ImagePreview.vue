<template>
  <div id="file-preview">
    <div class="card form-group" style="margin:10px;">
      <div class="card-body">
        <h6 class="card-title">画像</h6>
        <input type="file" accept="image/*" v-on:change="onFileChange" name="image">
      </div>
    </div>
    <img class="image_preview" v-bind:src="imageData" v-if="imageData">
  </div>
</template>

<script>
export default {
  data() {
    return {
      imageData: ''
    }
  },
  methods: {
    onFileChange(e) {
      const files = e.target.files;

      if(files.length > 0) {

        const file = files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
          this.imageData = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
  }
}
</script>