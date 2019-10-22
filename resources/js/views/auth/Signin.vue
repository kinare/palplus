<template>
  <div class="box">
    <div class="content has-text-centered">
      <figure>
        <router-link to="/">
          <img src="@/assets/logo.png" alt="Boma point" />
        </router-link>
      </figure>

      <h4 class="title is-marginless">Welcome</h4>
      <small class="has-text-centered">Sign in to see it in action</small>
    </div>
    <div class="field" style="margin-bottom: 30px">
      <button @click="googleSignin" class="button is-medium is-fullwidth">
        <font-awesome-icon class="has-text-danger" :icon="['fab', 'google']" />
        &nbsp; Google
      </button>
    </div>
    <div class="level">
      <div class="level-item has-text-centered">
        <router-link to="/auth/login" class="is-link has-text-dark"
          >Sign In</router-link
        >
      </div>
      |
      <div class="level-item has-text-centered">
        <router-link to="/auth/signup" class="is-link has-text-dark"
          >Register</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Signin",
  methods: {
    googleSignin: function() {
      this.$gAuth
        .signIn()
        .then(GoogleUser => {
          //on success
          this.$store.dispatch(
            "Auth/verifyGoogleToken",
            GoogleUser.Zi.id_token
          );
        })
        .catch(error => {
          //on fail do something
          console.log(error);
        });
    }
  }
};
</script>

<style scoped></style>
