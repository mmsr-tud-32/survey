<template>
  <div>
    <h1>{{$t("intro_short_title")}}</h1>
    <p>
      {{$tc("intro_short_body", timeoutShort)}}
    </p>
    <router-link class="btn btn-primary" to="/short">{{$t("btn_short")}}</router-link>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';

  @Component({})
  export default class Submit extends Vue {
    private get timeoutShort() {
      return this.$store.getters.timeoutShort.length;
    }
  }
</script>

<style scoped>

</style>
