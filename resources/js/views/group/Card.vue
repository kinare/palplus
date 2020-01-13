<template>
    <section class="section is-main-section">
       <card-component  title="Group Profile" icon="account-group" class="tile is-child">
            <user-avatar :avatar="group.avatar_url" class="image has-max-width is-aligned-center"/>
            <hr>
            <b-field label="Name">
                <b-input :value="group.name" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="Description">
                <b-input :value="group.description" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="Access Level">
                <b-input :value="group.access_level" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="Country">
                <b-input :value="group.country" custom-class="is-static" readonly/>
            </b-field>
            <b-field label="Currency">
                <b-input :value="group.currency" custom-class="is-static" readonly/>
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
                v.$store.dispatch('Group/getGroup', to.params.id);
            })
        },
        computed : {
            group(){
                return this.$store.getters['Group/group'];
            }
        }
    }
</script>

<style scoped>

</style>
