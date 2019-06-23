<template>
  <div>
    <h1>{{$t("intro_long_title")}}</h1>
    <p>
      {{$tc("intro_long_body", timeoutLong)}}
    </p>
    <router-link class="btn btn-primary" to="/long">{{$t("btn_long")}}</router-link>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';

  @Component({})
  export default class Submit extends Vue {
    private get timeoutLong() {
      return this.$store.getters.timeoutLong.length;
    }
  }
</script>

<style scoped>

</style>
