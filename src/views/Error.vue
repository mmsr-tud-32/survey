<template>
  <div>
    <h2>{{$t("error_title")}}</h2>
    <p>{{$t("error")}}</p>
    <router-link class="btn btn-primary" to="/">{{$t("back")}}</router-link>
  </div>
</template>

<script>
  export default {
    name: 'Error',
  };
</script>

<style scoped>

</style>
