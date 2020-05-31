<template>
  <div>
    <hero-bar :has-right-visible="true">Transactions</hero-bar>
    <section class="section is-main-section">
      <card-component title="Transactions" class="has-table has-mobile-sort-spaced">
        <b-table
          :loading="isLoading"
          :paginated="paginated"
          :per-page="perPage"
          :striped="true"
          :hoverable="true"
          default-sort="name"
          :data="transactions"
        >
          <template slot-scope="props">
            <b-table-column
              label="Transaction code"
              field="transaction_code"
              sortable
              :searchable="true"
            >{{ props.row.transaction_code }}</b-table-column>
            <b-table-column
              label="User"
              field="user_name"
              sortable
              :searchable="true"
            >{{ props.row.user_name }}</b-table-column>
            <b-table-column
              label="Type"
              field="type"
              sortable
              :searchable="true"
            >{{ props.row.type }}</b-table-column>
            <b-table-column
              label="Transaction Date"
              field="conversion_time"
              sortable
              :searchable="true"
            >{{ props.row.conversion_time }}</b-table-column>
            <b-table-column
              label="Gateway"
              field="account_no"
              sortable
              :searchable="true"
            >{{ props.row.account_no }}</b-table-column>
            <b-table-column
              label="Amount"
              field="amount"
              sortable
              :searchable="true"
            >{{props.row.to_currency}} {{ props.row.amount }}</b-table-column>
            <b-table-column label="Status" field="status">
              <template v-if="props.row.status === 'processing'">
                <b-button type="is-info" style="text-transform: capitalize;">{{props.row.status}}</b-button>
              </template>

              <template v-if="props.row.status === 'pending'">
                <b-button type="is-link" style="text-transform: capitalize;">{{props.row.status}}</b-button>
              </template>

              <template v-if="props.row.status === 'processed'">
                <b-button type="is-success" style="text-transform: capitalize;">{{props.row.status}}</b-button>
              </template>
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
  name: "Transaction",
  components: { HeroBar, CardComponent, TitleBar, ModalBox },
  data() {
    return {
      type: "",
      owner: "",
      owner_id: "",
      isModalActive: false,
      trashObject: null,
      isLoading: false,
      paginated: true,
      perPage: 10
    };
  },
  beforeRouteEnter(to, from, next) {
    next(v => {
      v.$store.dispatch("Transaction/getTransactions");
      v.type = to.params.type;
      v.owner = to.params.owner;
      v.owner_id = to.params.id;
    });
  },
  computed: {
    transactions() {
      if (this.owner && this.owner_id) {
        return this.$store.getters["Transaction/transactions"]
          .filter(trans => {
            return (
              trans.entry === this.type &&
              trans.owner === this.owner &&
              trans[this.owner.toLowerCase()] === parseInt(this.owner_id)
            );
          })
          .reverse();
      }
      return this.$store.getters["Transaction/transactions"]
        .filter(trans => {
          return trans.entry === this.type;
        })
        .reverse();
    }
  }
};
</script>

<style scoped>
</style>
