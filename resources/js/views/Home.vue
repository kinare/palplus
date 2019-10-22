<template>
 <section class="hero is-fullheight is-white is-bold"
         id="home"
        >
  <!--    Hero head-->
  <div class="hero-head has-padding-left-80 has-padding-right-80">
      <b-navbar>
          <template slot="brand">
              <b-navbar-item tag="router-link" :to="{ path: '/' }">
                  <img src="/img/logo.jfif" alt="Logo" />
              </b-navbar-item>
          </template>
          <template slot="end">
          <b-navbar-item :class="{ 'is-active': filter === 'buy' }">
            <span class="menuitem" @click="setPropertyType('buy')">
                About
            </span>
          </b-navbar-item>

          <b-navbar-item tag="router-link" :to="{ path: '/listing' }">
              <span class="menuitem">Login</span>
          </b-navbar-item>
          </template>
      </b-navbar>
  </div>

  <!--    Hero content-->
  <div class="hero-body">
   <div class="container">
    <h1 class="title">
     Palplus Admin Dashboard
    </h1>
    <h2 class="subtitle">Login to see it in action</h2>
   </div>
  </div>
 </section>
</template>
<script>
export default {
  name: "home",
};
</script>
