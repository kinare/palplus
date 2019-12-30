<template>
  <div class="box">
    <logo />

    <div class="content has-text-left">
      <!--        user name-->
      <b-field label="User Name">
        <b-input type="text" v-model="formData.email" />
      </b-field>

      <!--        Password-->
      <b-field label="Password">
        <b-input
          type="password"
          :password-reveal="true"
          v-model="formData.password"
        />
      </b-field>

      <!--        Remember me-->
      <b-field>
        <b-checkbox> Remember Me</b-checkbox>
      </b-field>

      <!--        Password-->
      <b-field>
        <b-button type="is-primary" class="is-fullwidth" @click="login"
          >Login</b-button
        >
      </b-field>

      <div class="has-text-centered is-size-7">
        Dont have an account?
        <router-link to="/auth/signup">Sign up Here</router-link> <br />

        Forgot your password?
        <router-link to="/auth/reset">Reset Password</router-link> <br />
      </div>
    </div>
  </div>
</template>

<script>
import BField from "buefy/src/components/field/Field";
import BInput from "buefy/src/components/input/Input";
import BButton from "buefy/src/components/button/Button";
import BCheckbox from "buefy/src/components/checkbox/Checkbox";
import  Logo  from "../../../components/logo";
import { helper } from "../../../utils";

export default {
  name: "Login",
  components: { Logo, BCheckbox, BButton, BInput, BField },
  data: function() {
    return {
      formData: {
        email: "",
        password: ""
      }
    };
  },
  methods: {
    login: function() {
      //todo validation
      this.$store.dispatch("Auth/login", helper.prepareFormData(this.formData));
    }
  }
};
</script>

<style scoped />
