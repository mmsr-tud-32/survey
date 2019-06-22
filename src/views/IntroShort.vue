<template>
  <div>
    <h1>{{$t("intro_short_title")}}</h1>
    <p>
      {{$t("intro_short_body")}}
    </p>
    <router-link class="btn btn-primary" to="/short">{{$t("btn_short")}}</router-link>
  </div>
</template>

<script>
  export default {
    name: 'IntroShort',
  };
</script>

<style scoped>

</style>
