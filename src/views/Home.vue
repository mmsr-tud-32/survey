<template>
  <div>
    <div class="row">
      <h1 class="col">{{$t("welcome")}}</h1>
      <LocaleChanger class="col-auto"></LocaleChanger>
    </div>
    <form @submit="submitForm">
      <div class="form-group">
        <label for="surveyUuid">{{$t("surveyUuid")}}</label>
        <input id="surveyUuid" v-model="surveyUuid" class="form-control" required>
      </div>
      <input type="submit" class="btn btn-primary" :value="$t('submit')">
    </form>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';
  import LocaleChanger from '@/components/LocaleChanger.vue';

  @Component({
    components: {LocaleChanger},
  })
  export default class Home extends Vue {
    private surveyUuid: string = '';

    private submitForm(event: Event) {
      event.preventDefault();

      this.$store.dispatch('setSurveyUuid', this.surveyUuid)
        .then(() => this.$router.push(`/survey/${this.surveyUuid}`))
        .catch(() => this.$router.push('/error'));
    }
  }
</script>

<style scoped>

</style>
