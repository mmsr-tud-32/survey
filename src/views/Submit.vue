<template>
  <div>
    <button class="btn btn-primary" @click="submit">{{$t("btn_submit")}}</button>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';

  @Component({})
  export default class Submit extends Vue {
    private submit() {
      this.$store.dispatch('submitSurvey')
        .then(() => {
          this.$router.push('/thanks');
        });
    }
  }
</script>

<style scoped>

</style>
