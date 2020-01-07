<template>
    <div class="box">
        <logo/>

        <div v-if="admin" class="content has-text-left">
            <!--        user name-->
            <b-field label="Name">
                <b-input type="text" v-model="admin.name"></b-input>
            </b-field>

            <b-field label="Email">
                <b-input type="text" v-model="admin.email"></b-input>
            </b-field>

            <b-field label="Phone">
                <b-input type="text" v-model="admin.phone"></b-input>
            </b-field>

            <b-field label="Role">
                <b-input disabled type="text" v-model="admin.access_type"></b-input>
            </b-field>

            <b-field label="Status">
                <b-input disabled type="text" v-model="admin.active"></b-input>
            </b-field>

            <!--        Password-->
            <b-field label="Password">
                <b-input
                    type="password"
                    :password-reveal="true"
                    v-model="password"
                ></b-input>
            </b-field>



            <b-field>
                <b-button type="is-primary" class="is-fullwidth" @click="finish"
                >Finish</b-button
                >
            </b-field>

            <div class="has-text-centered is-size-7">
                Forgot your password?
                <router-link to="/auth/reset">Reset Password</router-link> <br />
            </div>
        </div>
    </div>
</template>

<script>

    import {mapState} from "vuex";
    import Logo from "../../components/logo";

    export default {
        name: "Invitation",
        components: {Logo},
        data : function(){
            return {
                password : ''
            }
        },
        beforeRouteEnter(to, from, next){
            next(v =>{
                v.$store.dispatch('Admin/validate', {token : to.params.token});
            })
        },
        computed : {
            ...mapState('Admin',{
                admin : state => state.admin
            })
        },
        methods : {
            finish : function () {
                let data = {...this.admin};
                data.password = this.password;
                this.$store.dispatch('Admin/register', data);
            }
        }

    }
</script>

<style scoped>

</style>
