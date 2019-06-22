<template>
  <div>
    <h1>{{$t("intro_long_title")}}</h1>
    <p>
      {{$t("intro_long_body")}}
    </p>
    <router-link class="btn btn-primary" to="/long">{{$t("btn_long")}}</router-link>
  </div>
</template>

<script>
  export default {
    name: "IntroLong"
  }
</script>

<style scoped>

</style>
