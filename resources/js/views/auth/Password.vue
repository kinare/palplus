<template>
  <div class="box">
    <div class="content has-text-centered">
     <logo/>
      <h4 class="title is-marginless">Set Password</h4>
    </div>

    <div class="content has-text-left">

      <div class="field">
        <label class="label">New Password</label>
        <input type="password" class="input" />
      </div>
      <div class="field">
        <label class="label">Confirm Password</label>
        <input type="password" class="input" />
      </div>
      <div class="field">
        <button class="button is-primary is-fullwidth">Reset Password</button>
      </div>
    </div>
  </div>
</template
>

<script>
import Logo from "../../components/logo";
export default {
  name: "Password",
  components: {Logo}
};
</script>

<style scoped></style>
