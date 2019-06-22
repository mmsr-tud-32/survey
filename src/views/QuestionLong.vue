<template>
  <div>
    <Question :uuid="uuid" :timeout="timeout" :image="imageFile" @submit="submit"/>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';
  import Question from '@/components/Question.vue';

  @Component({
    components: {Question},
  })
  export default class QuestionLong extends Vue {
    private get longImages() {
      return this.$store.getters.longImages;
    }

    private get timeout() {
      return this.$store.getters.timeoutLong;
    }

    private get uuid() {
      return this.image.uuid;
    }

    private get currentLongIndex() {
      return this.$store.getters.currentLongIndex;
    }

    private get imageFile() {
      return this.image.image;
    }

    private get image() {
      return this.longImages[this.currentLongIndex].image;
    }

    private submit(fake: boolean) {
      this.$store.dispatch('answerLongQuestion', {uuid: this.uuid, fake})
        .then(() => {
          if (this.currentLongIndex >= this.longImages.length) {
            this.$router.push('/submit');
          }
        });
    }
  }
</script>

<style scoped>

</style>
