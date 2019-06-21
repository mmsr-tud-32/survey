<template>
  <div>
    <h1>{{$t("introduction")}}</h1>
    <p>
      {{$t("introduction_body")}}
    </p>
    <router-link class="btn btn-primary" to="/question">{{$t("btn_practise")}}</router-link>
  </div>
</template>

<script>
  export default {
    name: 'Intro',
  };
</script>

<style scoped>

</style>
