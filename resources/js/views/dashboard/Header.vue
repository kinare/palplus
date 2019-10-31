<template>
    <header class="hero is-light">
        <div class="hero-head has-padding-left-80 has-padding-right-80">
            <b-navbar>
            <template slot="brand">
                <b-navbar-item tag="router-link" :to="{ path: '/' }">
                    <img src="/img/logo.jfif" alt="Logo" style="height: 35px"/>
                </b-navbar-item>
            </template>
            <template slot="end">
                <b-navbar-item>
                    <b-dropdown aria-role="list">
                        <p  slot="trigger">
                            <font-awesome-icon icon="user-circle"/> &nbsp;  Account &nbsp; <font-awesome-icon class="has-text-light-grey" icon="caret-down"/>
                        </p>
                        <b-dropdown-item aria-role="listitem"> <font-awesome-icon icon="cog"/> &nbsp;Setting</b-dropdown-item>
                        <b-dropdown-item @click="logout" aria-role="listitem"><font-awesome-icon icon="sign-out-alt"/>&nbsp;Logout</b-dropdown-item>
                    </b-dropdown>
                </b-navbar-item>
            </template>
        </b-navbar>
        </div>
    </header>
</template>

<script>
    import BNavbarItem from "buefy/src/components/navbar/NavbarItem";
    export default {
        name: "Header",
        components: {BNavbarItem},
        methods : {
            logout : function () {
                this.$store.dispatch('Auth/logout');
            }
        }
    }
</script>

<style scoped>

</style>
