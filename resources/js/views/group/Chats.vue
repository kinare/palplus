<template>
    <div>
        <hero-bar :has-right-visible="true">
            Group Chats
        </hero-bar>

        <section class="section is-main-section">
            <card-component
                title="Group Chats"
                icon="account-group"
                class="tile is-child"
            >
                <div class="columns">
                    <div class="column is-half">
                        Recieved Messages
                    </div>
                    <div class="column is-half">
                        Send messages
                    </div>
                </div>
            </card-component>
        </section>
    </div>
</template>

<script>
import CardComponent from "../../components/CardComponent";
import UserAvatar from "../../components/UserAvatar";
import HeroBar from "../../components/HeroBar";
export default {
    name: "Card",
    components: { UserAvatar, CardComponent, HeroBar },
    data: function () {
        return {};
    },
    beforeRouteEnter(to, from, next) {
        next((v) => {
            v.$store.dispatch("Group/getGroup", to.params.id);
        });
    },
    computed: {
        group() {
            return this.$store.getters["Group/group"];
        },
    },
    methods: {},
};
</script>

<style scoped></style>
