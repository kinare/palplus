<template>
    <section class="section is-main-section">
       <card-component  title="Member Profile" icon="account-group" class="tile is-child">
            <b-field label="Name">
                <b-input :value="member.name" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="Phone">
                <b-input :value="member.phone" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="Access Level">
                <b-input :value="member.email" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="Status">
                <b-input :value="member.active ? 'active' : 'inactive'" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="WEF">
                <b-input :value="member.created_at" custom-class="is-static" readonly/>
            </b-field>
            <hr>
        </card-component>
    </section>
</template>

<script>
    import CardComponent from "../../components/CardComponent";
    import UserAvatar from "../../components/UserAvatar";
    export default {
        name: "Card",
        components: {UserAvatar, CardComponent},
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Member/getMember', to.params.id);
            })
        },
        computed : {
            member(){
                return this.$store.getters['Member/member'];
            }
        }
    }
</script>

<style scoped>

</style>
