<template>
  <div class="home">
      <LocaleChanger></LocaleChanger>
    <h1>{{$t("welcome")}}</h1>
    <div>
      <input type="text" :placeholder="$t('name')" v-model="name">
      <button @click="start">{{$t("start")}}</button>
    </div>
  </div>
</template>

<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import HelloWorld from '@/components/HelloWorld.vue';
import LocaleChanger from '@/components/LocaleChanger.vue';

@Component({
  components: {
    LocaleChanger,
    HelloWorld,
  },
})
export default class Home extends Vue {
  private name: string = '';

  private created() {
    this.$store.dispatch('setSurveyUuid', this.$route.params.uuid);
  }

  private start() {
    this.$store.dispatch('createSubmission', this.name);
  }
}
</script>
