<template>
  <div>
    <Question :uuid="uuid" :timeout="timeout" :image="imageFile" @submit="submit"/>
  </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import Question from '@/components/Question.vue';
import {SurveySubmissionImage} from '@/models';

@Component({
  components: {Question},
})
export default class QuestionShort extends Vue {
  private get shortImages(): SurveySubmissionImage[] {
    return this.$store.getters.shortImages;
  }

  private get timeout() {
    return this.$store.getters.timeoutShort;
  }

  private get uuid() {
    return this.image.uuid;
  }

  private get currentShortIndex() {
    return this.$store.getters.currentShortIndex;
  }

  private get imageFile() {
    return this.image.image;
  }

  private get image() {
    return this.shortImages[this.currentShortIndex].image;
  }

  private submit(fake: boolean) {
    this.$store.dispatch('answerQuestion', {uuid: this.uuid, fake, stage: 'short'})
      .then(() => {
        if (this.currentShortIndex >= this.shortImages.length) {
          this.$router.push('/intro-long');
        }
      });
  }
}
</script>

<style scoped>

</style>
