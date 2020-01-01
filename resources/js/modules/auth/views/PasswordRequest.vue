<template>
  <div class="box">
    <div class="content has-text-centered">
      <logo />
      <h4 class="title is-marginless">Reset Password</h4>
    </div>

    <div class="field">
      <label class="label">Email</label>
      <input v-model="formData.email" type="email" class="input" />
    </div>

    <div class="field">
      <button class="button is-primary is-fullwidth" @click="passwordRequest">
        Send reset link
      </button>
    </div>
  </div>
</template>

<script>
import  Logo  from "../../../components/logo";

export default {
  name: "PasswordRequest",
  components: { Logo },
  data: function() {
    return {
      formData: {
        email: ""
      }
    };
  },
  methods: {
    passwordRequest: function() {
      this.$store.dispatch("Property/forgotPass", this.formData);
    }
  }
};
</script>

<style scoped />
