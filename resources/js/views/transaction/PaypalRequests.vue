<template>
  <div>
    <hero-bar :has-right-visible="true">Paypal Withdrawal Requests</hero-bar>
    <section class="section is-main-section">
      <card-component title="Requests" class="has-table has-mobile-sort-spaced">
        <b-table
          :loading="isLoading"
          :paginated="paginated"
          :per-page="perPage"
          :striped="true"
          :hoverable="true"
          default-sort="name"
          :data="paypal"
        >
          <template slot-scope="props">
            <b-table-column
              label="Name"
              field="name"
              sortable
              :searchable="true"
            >{{ props.row.user.name }}</b-table-column>
            <b-table-column
              label="Amount"
              field="amount"
              sortable
              :searchable="true"
            >{{ props.row.amount }}</b-table-column>
            <b-table-column
              label="created_at"
              field="created_at"
              sortable
              :searchable="true"
            >{{ props.row.created_at }}</b-table-column>

            <b-table-column label="Actions">
              <a target="_blank" :href="props.row.url" class="button is-primary">Validate</a>
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
  </div>
</template>

<script>
import ModalBox from "../../components/ModalBox";
import TitleBar from "../../components/TitleBar";
import CardComponent from "../../components/CardComponent";
import HeroBar from "../../components/HeroBar";
export default {
  name: "PaypalRequests",
  components: { HeroBar, CardComponent, TitleBar, ModalBox },
  data() {
    return {
      isModalActive: false,
      trashObject: null,
      isLoading: false,
      paginated: true,
      perPage: 10
    };
  },
  beforeRouteEnter(to, from, next) {
    next(v => {
      v.$store.dispatch("Transaction/getPaypalPayment");
    });
  },
  computed: {
    paypal() {
      return this.$store.getters["Transaction/paypalRequests"];
    }
  }
};
</script>

<style scoped>
</style>
