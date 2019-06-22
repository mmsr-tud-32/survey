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
      <input type="submit" class="btn btn-primary" :value="$t('start')">
    </form>
  </div>
</template>

<script lang="ts">
  import {Component, Vue} from 'vue-property-decorator';
  import LocaleChanger from '@/components/LocaleChanger.vue';

  @Component({
    components: {
      LocaleChanger,
    },
  })
  export default class Survey extends Vue {
    private name: string = '';

    private created() {
      this.$store.dispatch('setSurveyUuid', this.$route.params.uuid);
    }

    private startSurvey(event: Event) {
      event.preventDefault();

      this.$store.dispatch('createSubmission', this.name)
        .then(() => this.$router.push('/intro'))
        .catch(() => this.$router.push('/error'));
    }
  }
</script>
