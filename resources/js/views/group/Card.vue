<template>
  <div>
    <hero-bar :has-right-visible="true">
      Group Card
      <a
        slot="right"
        class="button"
        @click="toggleActive(group.id)"
      >{{group.active ? 'Deactivate' : 'Activate'}}</a>
      <a slot="right" class="button" @click="suspend(group.id)">Suspend</a>
    </hero-bar>

    <section class="section is-main-section">
      <card-component title="Group Profile" icon="account-group" class="tile is-child">
        <div class="columns">
          <div class="column is-half">
            <b-field horizontal label="Name">
              <b-input :value="group.name" custom-class="is-static" readonly />
            </b-field>
            <b-field horizontal label="Description">
              <b-input :value="group.description" custom-class="is-static" readonly />
            </b-field>
            <b-field horizontal label="Access Level">
              <b-input :value="group.access_level" custom-class="is-static" readonly />
            </b-field>
            <b-field horizontal label="Status">
              <b-input
                :value="group.active ? 'Active' : 'Inactive'"
                custom-class="is-static"
                readonly
              />
            </b-field>
            <b-field horizontal label="Reason">
              <b-input :value="group.reasons" custom-class="is-static" readonly />
            </b-field>
            <b-field horizontal label="Country">
              <b-input :value="group.country" custom-class="is-static" readonly />
            </b-field>
            <b-field horizontal label="Currency">
              <b-input :value="group.currency" custom-class="is-static" readonly />
            </b-field>
          </div>
          <div class="column is-half">
            <user-avatar :avatar="group.avatar_url" class="image has-max-width is-aligned-center" />
            <br />
            <div class="column">
              <b-field horizontal label="Group Type">
                <b-input :value="group.type.description" custom-class="is-static" readonly />
              </b-field>
              <b-field horizontal label="Created By">
                <b-input :value="group.created_by.name" custom-class="is-static" readonly />
              </b-field>

              <b-field horizontal label="Email Address">
                <b-input :value="group.created_by.email" custom-class="is-static" readonly />
              </b-field>
              <b-field horizontal label="Phone Number">
                <b-input :value="group.created_by.phone" custom-class="is-static" readonly />
              </b-field>
              <b-field horizontal label="Created Date">
                <b-input :value="group.created_at" custom-class="is-static" readonly />
              </b-field>
              <b-field horizontal label="Country">
                <b-input :value="group.country" custom-class="is-static" readonly />
              </b-field>
            </div>
          </div>
        </div>
      </card-component>
    </section>

    <b-modal
      :active.sync="isModalActivateActive"
      has-modal-card
      trap-focus
      aria-role="dialog"
      aria-modal
    >
      <form action>
        <div class="modal-card" style="width: auto">
          <header class="modal-card-head">
            <p class="modal-card-title">Please input reason</p>
          </header>
          <section class="modal-card-body">
            <b-field label="Reason">
              <textarea v-model="reason" cols="50" />
            </b-field>
          </section>
          <footer class="modal-card-foot">
            <a class="button" @click="isModalActivateActive = false">Close</a>
            <a class="button is-primary" @click.prevent="onOkToggleActive">Save</a>
          </footer>
        </div>
      </form>
    </b-modal>

    <b-modal
      :active.sync="isModalSuspendActive"
      has-modal-card
      trap-focus
      aria-role="dialog"
      aria-modal
    >
      <form action>
        <div class="modal-card" style="width: auto">
          <header class="modal-card-head">
            <p class="modal-card-title">Please input reason</p>
          </header>
          <section class="modal-card-body">
            <b-field label="Reason">
              <textarea v-model="reason" cols="50" />
            </b-field>
          </section>
          <footer class="modal-card-foot">
            <a class="button" @click="isModalSuspendActive = false">Close</a>
            <a class="button is-primary" @click.prevent="onOkSuspend">Save</a>
          </footer>
        </div>
      </form>
    </b-modal>
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
    return {
      isModalActivateActive: false,
      isModalSuspendActive: false,
      reason: "",
      id: "",
    };
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
  methods: {
    transaction: function (id) {
      alert(id);
    },

    toggleActive: function (id) {
      this.isModalActivateActive = true;
      this.id = id;
    },

    onOkToggleActive: function () {
      this.$store.dispatch("Group/toggleActiveGroup", {
        id: this.id,
        reason: this.reason,
      });

      this.reason = "";
      this.id = "";
      this.isModalActivateActive = false;
    },

    suspend: function (id) {
      this.isModalSuspendActive = true;
      this.id = id;
    },

    onOkSuspend: function () {
      this.$store.dispatch("Group/suspendGroup", {
        id: this.id,
        reason: this.reason,
      });

      this.reason = "";
      this.id = "";
      this.isModalSuspendActive = false;
    },
  },
};
</script>

<style scoped>
</style>
