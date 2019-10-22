<template>
  <div class="box">
    <div class="content has-text-centered">
      <figure>
        <router-link to="/">
          <img src="@/assets/logo.png" alt="Boma point" />
        </router-link>
      </figure>
      <h4 class="title is-marginless">Sign Up</h4>
      <small class="has-text-centered">Register to see it in action</small>
    </div>
    <div class="content has-text-left">
      <b-field label="User Name">
        <b-input type="text" v-model="formData.username"></b-input>
      </b-field>

      <b-field label="Email">
        <b-input type="email" v-model="formData.email"></b-input>
      </b-field>

      <b-field label="Phone">
        <b-input type="text" v-model="formData.contactNumber"></b-input>
      </b-field>

      <b-field label="Password">
        <b-input type="password" v-model="formData.rawPassword"></b-input>
      </b-field>
    </div>

    <div class="field">
      <button class="button is-primary is-fullwidth" @click="register">
        Sign Up
      </button>
    </div>
    <div class="has-text-centered is-size-7">
      Dont have an account?
      <router-link to="auth/signup">Sign in Here</router-link> <br />
    </div>
  </div>
</template>

<script>
import BField from "buefy/src/components/field/Field";
import BInput from "buefy/src/components/input/Input";
export default {
  name: "Signup",
  components: { BInput, BField },
  data: function() {
    return {
      formData: {
        username: "",
        firstName: "",
        middleName: "",
        lastName: "",
        contactNumber: "",
        email: "",
        photoUrl: "",
        rawPassword: ""
      }
    };
  },
  methods: {
    register: function() {
      //todo validation
      this.$store.dispatch("Auth/register", this.formData);
    }
  }
};
</script>

<style scoped></style>
