<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="fas fa-heart mr-1"/>
      興味あり！
    </button>
    {{ countInterests }}
  </div>
</template>

<script>
  export default {
    props: {
      initialIsInterestedBy: {
        type: Boolean,
        default: false,
      },
      initialCountLikes: {
        type: Number,
        default: 0,
      },
    },
    data() {
      return {
        isInterestedBy: this.initialIsInterestedBy,
        countLikes: this.initialCountLikes,
      }
    },
  }
</script>
