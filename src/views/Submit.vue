<template>
  <div>
    <form @submit="submit">
      <div class="form-group">
        <label for="feedback">{{$t("submit_feedback")}}</label>
        <textarea class="form-control" id="feedback" v-model="feedback"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" class="btn btn-primary" :value="$t('btn_submit')">
      </div>
    </form>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';

  @Component({})
  export default class Submit extends Vue {
    private feedback: string = '';

    private submit(event: Event) {
      event.preventDefault();

      this.$store.dispatch('submitSurvey', this.feedback)
        .then(() => {
          this.$router.push('/thanks');
        });
    }
  }
</script>

<style scoped>

</style>
