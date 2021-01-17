<template>
  <div>
    <button
      class="btn-sm shadow-none"
      :class="buttonColor"
      @click="clickFollow" 
    >
      <i
        :class="buttonIcon"
      ></i>
      {{ buttonText }}
    </button>
  </div>
</template>

<script>
  export default {
    props: {
      initialIsFollowedBy: {
        type: Boolean,
        default: false,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isFollowedBy: this.initialIsFollowedBy,
      }
    },
    computed: {
      buttonColor() {
        return this.isFollowedBy
          ? 'follow-color bg-white'
          : 'unfollow-color text-white'
      },
      buttonIcon() {
        return this.isFollowedBy
          ? 'fas fa-user-check'
          : 'fas fa-user-plus'
      },
      buttonText() {
        return this.isFollowedBy
          ? 'フォロー中'
          : 'フォローする'
      },
    },
    methods: {
      clickFollow() {
        if (!this.authorized) {
          alert('フォロー機能はログイン中のみ使用できます')
          return
        }

        this.isFollowedBy
          ? this.unfollow()
          : this.follow()
      },
      async follow() {
        const response = await axios.put(this.endpoint)
        this.isFollowedBy = true
      },
      async unfollow() {
        const response = await axios.delete(this.endpoint)

        this.isFollowedBy = false
      },
    },
  }
</script>

<style lang="css" scoped>
.unfollow-color {
  background-color: rgb(0,200,179);
  border: 1px solid rgb(0,200,179);
  font-size: 13px;
  padding: 5px 7px;
  border-radius: 20px;
}

.follow-color {
  border: 1px solid black;
  font-size: 13px;
  padding: 5px 12px;
  border-radius: 20px;
}

button:focus {
	outline:0;
}

@media (max-width: 575.98px) {
  .unfollow-color, .follow-color {
    font-size: 8px !important;
  }
}

</style>
