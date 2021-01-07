<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="fas fa-heart mr-1"
        :class="{'red-text':this.isInterestedBy, 'animated rubberBand fast':this.gotToInterest}"
        @click="clickInterest"
      />
      <span :class="{'red-text':this.isInterestedBy}"
        @click="clickInterest"
      >興味あり！</span>
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
      initialCountInterests: {
        type: Number,
        default: 0,
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
        isInterestedBy: this.initialIsInterestedBy,
        countInterests: this.initialCountInterests,
        gotToInterest: false,
      }
    },
    methods: {
      clickInterest() {
        if (!this.authorized) {
          alert('興味あり！機能はログイン中のみ使用できます')
          return
        }

        this.isInterestedBy
          ? this.uninterest()
          : this.interest()
      },
      async interest() {
        const response = await axios.put(this.endpoint)

        this.isInterestedBy = true
        this.countInterests = response.data.countInterests
        this.gotToInterest = true
      },
      async uninterest() {
        const response = await axios.delete(this.endpoint)

        this.isInterestedBy = false
        this.countInterests = response.data.countInterests
        this.gotToInterest = false
      },
    },
  }
</script>
