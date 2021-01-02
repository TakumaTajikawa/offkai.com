<template>
<div>
  
</div>
</template>

<script>
export default {
  name: 'ImagePreview',
  data() {
    return {
      imageData: ''
    }
  },
  methods: {
    onFileChange(e) {
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