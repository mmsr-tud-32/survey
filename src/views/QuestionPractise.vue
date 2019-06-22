<template>
  <div>
    <Question :uuid="uuid" :timeout="timeout" :image="imageFile" @submit="submit"/>
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
  private get practiseImages(): SurveySubmissionImage[] {
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
    this.$store.dispatch('answerQuestion', {uuid: this.uuid, fake, stage: 'practise'})
      .then(() => {
        if (this.currentPractiseIndex >= this.practiseImages.length) {
          this.$router.push('/intro-short');
        }
      });
  }
}
</script>

<style scoped>

</style>
