<template>
  <div>
    <Question :uuid="uuid" :timeout="timeout" :image="imageFile" @submit="submit"/>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from 'vue-property-decorator';
  import Question from '@/components/Question.vue';

  @Component({
    components: {Question},
  })
  export default class QuestionPractise extends Vue {
    private get practiseImages() {
      return this.$store.getters.practiseImages;
    }

    private get timeout() {
      return this.$store.getters.timeoutShort;
    }

    private get uuid() {
      return this.image.uuid;
    }

    private get currentPractiseIndex() {
      return this.$store.getters.currentPractiseIndex;
    }

    private get imageFile() {
      return this.image.image;
    }

    private get image() {
      return this.practiseImages[this.currentPractiseIndex].image;
    }

    private submit(fake: boolean) {
      this.$store.dispatch('answerPractiseQuestion', {uuid: this.uuid, fake})
        .then(() => {
          if (this.currentPractiseIndex > this.practiseImages.length) {
            this.$router.push('/short');
          }
        });
    }
  }
</script>

<style scoped>

</style>
