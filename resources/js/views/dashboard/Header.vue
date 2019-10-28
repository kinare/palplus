<template>
    <header class="hero is-light">
        <b-navbar>
            <template slot="brand">
                <b-navbar-item tag="router-link" :to="{ path: '/' }">
                    <img src="/img/logo.jfif" alt="Logo" />
                </b-navbar-item>
            </template>
            <template slot="end">
                <b-navbar-item  tag="div">
                    <router-link to="/auth/signin" class="button is-primary">
                        <strong>Login</strong>
                    </router-link>
                </b-navbar-item>
            </template>
        </b-navbar>
    </header>
</template>

<script>
    export default {
        name: "Header"
    }
</script>

<style scoped>

</style>
