<template>
  <section class="section is-main-section">
    <card-component title="Member Profile" icon="account-group" class="tile is-child">
      <b-field label="Name">
        <b-input :value="member.name" custom-class="is-static" readonly />
      </b-field>
      <b-field label="Phone">
        <b-input :value="member.phone" custom-class="is-static" readonly />
      </b-field>
      <b-field label="Access Level">
        <b-input :value="member.email" custom-class="is-static" readonly />
      </b-field>
      <template v-if="member.active">
        <b-field label="Status">
          <b-select required v-model="member.active" @change="deactivateMember(member.id)">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </b-select>
        </b-field>
      </template>
      <template v-else>
        <b-field label="Status">
          <b-select required v-model="member.active" @change="activateMember(member.id)">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
          </b-select>
        </b-field>
      </template>
      <b-field label="WEF">
        <b-input :value="member.created_at" custom-class="is-static" readonly />
      </b-field>
      <b-field label="Active">
        <b-input :value="member.status" custom-class="is-static" readonly />
      </b-field>
      <b-button class="is-primary" @click="suspendItem(member.id)">Save</b-button>
      <hr />
    </card-component>
  </section>
</template>

<script>
import CardComponent from "../../components/CardComponent";
import UserAvatar from "../../components/UserAvatar";
export default {
  name: "Card",
  components: { UserAvatar, CardComponent },
  beforeRouteEnter(to, from, next) {
    next((v) => {
      v.$store.dispatch("Member/getMember", to.params.id);
    });
  },
  computed: {
    member() {
      return this.$store.getters["Member/member"];
    },
  },
  methods: {
    suspendItem(user_id) {
      this.$store.dispatch("Member/suspendMember", { id: user_id });
      this.$store.dispatch("Member/getMember", this.$route.params.id);
    },
  },
};
</script>

<style scoped>
</style>
