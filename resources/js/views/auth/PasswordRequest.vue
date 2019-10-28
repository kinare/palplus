<template>
  <div class="box">
    <div class="content has-text-centered">
     <logo/>
      <h4 class="title is-marginless">Reset Password</h4>
    </div>

    <div class="content has-text-left">
      <div class="field">
        <label class="label">Email</label>
        <input type="text" class="input" />
      </div>

      <div class="field">
        <button class="button is-primary is-fullwidth">Send reset link</button>
      </div>
    </div>
  </div>
</template>

<script>
import Logo from "../../components/logo";
export default {
  name: "PasswordRequest",
  components: {Logo}
};
</script>

<style scoped></style>
