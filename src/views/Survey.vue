<template>
  <div class="home">
    <div class="row">
      <h1 class="col">{{$t("welcome")}}</h1>
      <LocaleChanger class="col-auto"></LocaleChanger>
    </div>
    <p>{{$t("welcome_msg")}}</p>
    <form @submit="startSurvey">
      <div class="form-group">
        <label for="name">{{$t("name")}}</label>
        <input type="text" class="form-control" id="name" :placeholder="$t('name')" v-model="name" required>
      </div>
      <div class="form-group">
        <label for="age">{{$t("age")}}</label>
        <input type="number" class="form-control" id="age" :placeholder="$t('age')" v-model="age" required>
      </div>
      <input type="submit" class="btn btn-primary" :value="$t('start')">
    </form>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';
  import LocaleChanger from '@/components/LocaleChanger.vue';
  import {preload} from '@/util';

  @Component({
    components: {
      LocaleChanger,
    },
  })
  export default class Survey extends Vue {
    private name: string = '';
    private age: number | null = null;

    private created() {
      this.$store.dispatch('setSurveyUuid', this.$route.params.uuid);
    }

    private startSurvey(event: Event) {
      event.preventDefault();

      this.$store.dispatch('createSubmission', {name: this.name, age: this.age})
        .then(() => this.$router.push('/intro-practise'))
        .then(() => preload(this.images))
        .catch(() => this.$router.push('/error'));
    }

    private get images() {
      const images = [
        ...this.$store.getters.practiseImages,
        ...this.$store.getters.shortImages,
        ...this.$store.getters.longImages,
      ];

      return images.map((i: any) => `${process.env.VUE_APP_IMG_PATH}/${i.image.image}`);
    }
  }
</script>
