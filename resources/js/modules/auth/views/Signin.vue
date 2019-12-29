<template>
  <div class="box">
    <div class="content has-text-centered">
     <logo/>
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
import Logo from "../../../components/logo";
export default {
  name: "Signin",
    components: {Logo},
    methods: {
    googleSignin: function() {
      let height = window.outerHeight * 0.75;
      let width = 589;

      let left = screen.width / 2 - width / 2;
      let top = screen.height / 2 - height / 2;

      let newwindow = window.open(
        "http://bomapoint.com/uaa-services/oauth2/authorization/google",
        "Bomapoint",
        "toolbar=no, " +
          "location=no, " +
          "directories=no, " +
          "status=no, menubar=no, " +
          "scrollbars=no, " +
          "resizable=no, " +
          "copyhistory=no, " +
          "width=" +
          width +
          ", " +
          "height=" +
          height +
          ", " +
          "top=" +
          top +
          ", " +
          "left=" +
          left
      );
      if (window.focus) {
        newwindow.focus();
      }
      return false;
    }
  }
};
</script>

<style scoped />
