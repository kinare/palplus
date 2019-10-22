<template>
  <div class="box">
    <div class="content has-text-centered">
      <figure>
        <a href="index.html">
          <img src="image/logo.png" alt="Boma point" />
        </a>
      </figure>
      <h4 class="title is-marginless">Reset Password</h4>
    </div>

    <div class="field">
      <label class="label">Email</label>
      <input type="text" class="input" />
    </div>

    <div class="field">
      <button class="button is-primary is-fullwidth">Send reset link</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "PasswordRequest"
};
</script>

<style scoped></style>
