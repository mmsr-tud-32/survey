<template>
  <div>
    <h1>{{$t("not_found")}}</h1>
    <p>{{$t("not_found_more")}}</p>
    <p>
      <router-link class="btn btn-primary" to="/">{{$t("back")}}</router-link>
    </p>
  </div>
</template>

<script>
  export default {
    name: 'Error404.vue',
  };
</script>
