<template>
  <div>
    <hero-bar :has-right-visible="true">Loans</hero-bar>
    <section class="section is-main-section">
      <card-component title="Loans" class="has-table has-mobile-sort-spaced">
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
              label="Member"
              field="name"
              sortable
              :searchable="true"
            >{{ props.row.name }}</b-table-column>
            <b-table-column
              label="Group"
              field="group_id"
              sortable
              :searchable="true"
            >{{ props.row.group_id }}</b-table-column>
            <b-table-column
              label="Amount"
              field="loan_amount"
              sortable
              :searchable="true"
            >{{ `${props.row.currency} ${props.row.loan_amount}` }}</b-table-column>
            <b-table-column
              label="Paid"
              field="paid_amount"
              sortable
              :searchable="true"
            >{{ `${props.row.currency} ${props.row.paid_amount}` }}</b-table-column>
            <b-table-column
              label="Balance"
              field="balance_amount"
              sortable
              :searchable="true"
            >{{ `${props.row.currency} ${props.row.balance_amount}` }}</b-table-column>
            <b-table-column
              label="Status"
              field="status"
              sortable
              :searchable="true"
            >{{ props.row.status }}</b-table-column>
            <b-table-column
              label="Payment period"
              field="payment_period"
              sortable
              :searchable="true"
            >{{ props.row.payment_period }}</b-table-column>
            <b-table-column
              label="Created at"
              field="created_at"
              sortable
              :searchable="true"
            >{{ props.row.created_at }}</b-table-column>
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
  name: "Loan",
  components: { HeroBar, CardComponent, TitleBar, ModalBox },
  data() {
    return {
      type: "",
      id: "",
      owner: "",
      isModalActive: false,
      trashObject: null,
      isLoading: false,
      paginated: true,
      perPage: 10
    };
  },
  beforeRouteEnter(to, from, next) {
    next(v => {
      v.$store.dispatch("Loan/getLoans");
      v.status = to.params.status;
      v.owner = to.params.owner;
      v.id = to.params.id;
    });
  },
  computed: {
    transactions() {
      if (this.type === "all" && this.id && this.owner)
        return this.$store.getters["Loan/loans"].filter(loan => {
          return loan[`${this.owner}_id`] === parseInt(this.id);
        });

      if (this.type && this.id && this.owner)
        return this.$store.getters["Loan/loans"].filter(loan => {
          return (
            loan[`${this.owner}_id`] === parseInt(this.id) &&
            loan.status === this.status
          );
        });

      return this.$store.getters["Loan/loans"].filter(loan => {
        return loan.status === this.status;
      });
    }
  },
  watch: {
    "$route.params.status": {
      handler: function(n) {
        this.status = n;
      }
    }
  }
};
</script>

<style scoped>
</style>
