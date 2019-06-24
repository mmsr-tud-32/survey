<template>
  <div id="app" class="container">
    <div v-if="!online" class="alert alert-danger">
      {{$t("offline")}}
    </div>
    <div class="py-5 text-center">
      <router-view/>
    </div>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue, Watch} from 'vue-property-decorator';

  @Component({})
  export default class App extends Vue {
    private created() {
      this.$store.dispatch('checkOnline');
    }

    private get online() {
      return this.$store.getters.online;
    }
  }
</script>

<style lang="scss">
</style>
