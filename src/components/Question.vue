<template>
  <div v-if="displayImg" class="text-center">
    <img :alt="uuid" :src="imgUrl" class="rounded img-fluid"/>
  </div>
  <div v-else>
    <h1>{{$t("make_a_choice")}}</h1>
    <div class="row justify-content-center">
      <div class="col-auto">
        <button class="btn btn-primary btn-lg" @click="$emit('submit', false)" :disabled="disabled">{{$t("real")}}</button>
      </div>
      <div class="col-auto">
        <button class="btn btn-primary btn-lg" @click="$emit('submit', true)" :disabled="disabled">{{$t("fake")}}</button>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
  import {Component, Prop, Vue, Watch} from 'vue-property-decorator';

  @Component({})
  export default class Question extends Vue {
    @Prop(String) private readonly uuid: string | undefined;
    @Prop(String) private readonly image: string | undefined;
    @Prop(Number) private readonly timeout!: number;
    @Prop(Boolean) private readonly disabled!: boolean;

    private displayImg = true;

    private created() {
      this.uuidChanged();
    }

    @Watch('uuid')
    private uuidChanged() {
      this.displayImg = true;
      setTimeout(() => {
        this.displayImg = false;
      }, this.timeout * 1000);
    }

    private get imgUrl() {
      if (this.image!.startsWith('http')) {
        return this.image;
      } else {
        return `${process.env.VUE_APP_IMG_PATH}/${this.image}`;
      }
    }
  }
</script>

<style scoped>

</style>
