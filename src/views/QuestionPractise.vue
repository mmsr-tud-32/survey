<template>
  <div>
    <Question :uuid="uuid" :timeout="timeout" :image="imageFile" @submit="submit" :disabled="disabled"/>
  </div>
</template>

<script lang="ts">
import {Component, Prop, Vue} from 'vue-property-decorator';
import Question from '@/components/Question.vue';
import {SurveySubmissionImage} from '@/models';

@Component({
  components: {Question},
})
export default class QuestionPractise extends Vue {
  private disabled = false;

  private get images(): SurveySubmissionImage[] {
    return this.$store.getters.practiseImages;
  }

  private get timeout() {
    return this.$store.getters.timeoutShort;
  }

  private get uuid() {
    return this.image.uuid;
  }

  private get currentIndex() {
    return this.$store.getters.currentPractiseIndex;
  }

  private get imageFile() {
    return this.image.image;
  }

  private get image() {
    if (this.done) {
      return {image: '', uuid: ''};
    } else {
      return this.images[this.currentIndex].image;
    }
  }

  private get done() {
    return this.currentIndex >= this.images.length;
  }

  private submit(fake: boolean) {
    if (this.disabled) { return; }

    this.disabled = true;
    this.$store.dispatch('answerQuestion', {uuid: this.uuid, fake, stage: 'practise'})
      .then(() => this.disabled = false)
      .then(() => {
        if (this.done) {
          this.$router.push('/intro-short');
        }
      });
  }
}
</script>

<style scoped>

</style>
