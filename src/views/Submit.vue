<template>
  <div>
    <button class="btn btn-primary" @click="submit">{{$t("submit")}}</button>
  </div>
</template>

<script>
  import {Component, Vue} from 'vue-property-decorator';

  @Component({})
  export default class Submit extends Vue {
  }
</script>

<style scoped>

</style>
