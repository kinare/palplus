<template>
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container">
        <div class="columns">
          <div class="column is-one-third is-offset-one-third">
            <router-view />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: "Auth"
};
</script>

<style scoped></style>
