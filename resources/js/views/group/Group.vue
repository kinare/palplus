<template>
  <div>
    <hero-bar :has-right-visible="true">Groups</hero-bar>
    <section class="section is-main-section">
      <card-component title="Groups" class="has-mobile-sort-spaced">
        <b-table
          :loading="isLoading"
          :paginated="paginated"
          :per-page="perPage"
          :striped="true"
          :hoverable="true"
          default-sort="name"
          :data="groups"
        >
          <template slot-scope="props">
            <b-table-column
              label="Name"
              field="name"
              sortable
              :searchable="true"
            >{{ props.row.name }}</b-table-column>
            <b-table-column
              label="description"
              field="description"
              sortable
              :searchable="true"
            >{{ props.row.description }}</b-table-column>
            <b-table-column
              label="country"
              field="country"
              sortable
              :searchable="true"
            >{{ props.row.country }}</b-table-column>
            <b-table-column
              label="currency"
              field="currency"
              sortable
              :searchable="true"
            >{{ props.row.currency }}</b-table-column>
            <b-table-column
              label="Access level"
              field="access_level"
              sortable
              :searchable="true"
            >{{ props.row.access_level }}</b-table-column>
            <b-table-column
              label="Status"
              field="status"
              sortable
              :searchable="true"
            >{{ props.row.status }}</b-table-column>
            <b-table-column
              label="Created at"
              field="created_at"
              sortable
              :searchable="true"
            >{{ props.row.created_at }}</b-table-column>
            <b-table-column label="Actions">
              <b-dropdown aria-role="list">
                <button class="button is-primary" slot="trigger">
                  <span>Options</span>
                  <b-icon icon="menu-down"></b-icon>
                </button>
                <b-dropdown-item has-link aria-role="listitem">
                  <router-link :to="`group-card/${props.row.id}`">details</router-link>
                  <router-link :to="`transactions/credit/Group/${props.row.id}`">deposits</router-link>
                  <router-link :to="`transactions/debit/Group/${props.row.id}`">withdrawals</router-link>
                  <router-link :to="`group-withdrawal-requests/${props.row.id}`">withdrawal requests</router-link>
                  <router-link :to="`pending-payments/${props.row.id}/group`">Pending payment</router-link>
                  <router-link disabled :to="`group-chats`">chats</router-link>
                  <router-link :to="`members/${props.row.id}`">members</router-link>
                  <router-link :to="`members/${props.row.id}/admins`">admins</router-link>
                  <router-link :to="`members/${props.row.id}/loan-approvers`">loan approvers</router-link>
                  <router-link
                    :to="`members/${props.row.id}/withdrawal-approvers`"
                  >withdrawal approvers</router-link>
                  <router-link :to="`membership-settings/${props.row.id}`">membership settings</router-link>
                  <router-link :to="`loans/all/group/${props.row.id}`">loans</router-link>
                  <router-link :to="`loan-settings/${props.row.id}`">loan settings</router-link>
                  <!--                                    <router-link :to="`withdrawal-settings/${props.row.id}`">withdrawal settings</router-link>-->
                  <router-link :to="`activity/event/${props.row.id}`">Events</router-link>
                  <router-link :to="`activity/meeting/${props.row.id}`">Meetings</router-link>
                  <router-link :to="`activity/tour/${props.row.id}`">Tours</router-link>
                  <router-link :to="`project/${props.row.id}`">Projects</router-link>
                </b-dropdown-item>
                <b-dropdown-item
                  aria-role="listitem"
                  @click="toggleActive(props.row.id)"
                >{{props.row.active ? 'deactivate' : 'activate'}}</b-dropdown-item>
                <b-dropdown-item aria-role="listitem" @click="suspend(props.row.id)">suspend</b-dropdown-item>
              </b-dropdown>
            </b-table-column>
          </template>

          <section class="section" slot="empty">
            <div class="content has-text-grey has-text-centered">
              <template v-if="isLoading">
                <p>
                  <b-icon icon="dots-horizontal" size="is-large" />
                </p>
                <p>Fetching data...</p>
              </template>
              <template v-else>
                <p>
                  <b-icon icon="emoticon-sad" size="is-large" />
                </p>
                <p>Nothing's here&hellip;</p>
              </template>
            </div>
          </section>
        </b-table>
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
            <a class="button">Close</a>
            <a class="button is-primary" @click.prevent="onOkSuspend">Save</a>
          </footer>
        </div>
      </form>
    </b-modal>
  </div>
</template>

<script>
import ModalBox from "../../components/ModalBox";
import CardComponent from "../../components/CardComponent";
import HeroBar from "../../components/HeroBar";

export default {
  name: "Group",
  components: { HeroBar, CardComponent, ModalBox },
  data() {
    return {
      isModalActivateActive: false,
      isModalSuspendActive: false,
      reason: "",
      id: "",
      trashObject: null,
      isLoading: false,
      paginated: true,
      perPage: 10,
    };
  },
  beforeRouteEnter(to, from, next) {
    next((v) => {
      if (to.params.id) {
        v.$store.dispatch("Group/myGroups", to.params.id);
      } else {
        v.$store.dispatch("Group/getGroups");
      }
    });
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
  computed: {
    groups() {
      return this.$store.getters["Group/groups"];
    },
  },
};
</script>

<style scoped>
</style>
