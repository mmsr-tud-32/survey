<template>
  <div>
    <h1>{{$t("introduction")}}</h1>
    <p>
      {{$t("introduction_body")}}
    </p>
    <router-link class="btn btn-primary" to="/practise">{{$t("btn_practise")}}</router-link>
  </div>
</template>

<script>
  export default {
    name: 'IntroPractise',
  };
</script>

<style scoped>

</style>
