<template>
  <div class="box">
    <div class="content has-text-centered">
      <logo />

      <h4 class="title is-marginless">Set Password</h4>
    </div>
    <div class="field">
      <label class="label">New Password</label>
      <input v-model="formData.newPassword" type="password" class="input" />
    </div>
    <div class="field">
      <label class="label">Confirm Password</label>
      <input
        v-model="formData.newPasswordConfirm"
        type="password"
        class="input"
      />
    </div>
    <div class="field">
      <button class="button is-primary is-fullwidth" @click="setpassword">
        Reset Password
      </button>
    </div>
  </div></template
>

<script>
import  Logo  from "../../../components/logo";
export default {
  name: "Password",
  components: { Logo },
  data: function() {
    return {
      formData: {
        code: "",
        newPassword: "",
        newPasswordConfirm: ""
      }
    };
  },
  beforeRouteEnter(to, from, next) {
    next(v => {
      v.formData.code = v.to.params.code;
    });
  },
  methods: {
    setpassword: function() {
      this.$store.dispatch("Property/setPassword", this.formData);
    }
  }
};
</script>

<style scoped />
