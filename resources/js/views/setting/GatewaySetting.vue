<template>
  <div>
    <hero-bar :has-right-visible="true">
      Gateway Settings
      <router-link slot="right" to="/setup" class="button">New Setup</router-link>
    </hero-bar>
    <section class="section is-main-section">
      <card-component title="setups" class="has-mobile-sort-spaced">
        <b-table
          :loading="isLoading"
          :paginated="paginated"
          :per-page="perPage"
          :striped="true"
          :hoverable="true"
          default-sort="type"
          :data="setups"
        >
          <template slot-scope="props">
            <b-table-column
              label="Type"
              field="type"
              sortable
              :searchable="true"
            >{{ props.row.type }}</b-table-column>
            <b-table-column
              label="Gateway"
              field="gateway"
              sortable
              :searchable="true"
            >{{ props.row.gateway }}</b-table-column>
            <b-table-column
              label="Rate %"
              field="rate"
              sortable
              :searchable="true"
            >{{ props.row.rate }} %</b-table-column>
            <b-table-column
              label="Minimum Amount Per Trans($)"
              field="min_amount"
              sortable
              :searchable="true"
            >{{ props.row.min_amount }}</b-table-column>
            <b-table-column
              label="Maximum Amount Per Trans($"
              field="max_amount"
              sortable
              :searchable="true"
            >{{ props.row.max_amount }}</b-table-column>
            <b-table-column
              label="Max Limit Amount Per Day($)"
              field="limit_per_day"
              sortable
              :searchable="true"
            >{{ props.row.limit_per_day }}</b-table-column>
            <b-table-column
              label="Created at"
              field="created_at"
              sortable
              :searchable="true"
            >{{ props.row.created_at }}</b-table-column>

            <b-table-column label="Actions">
              <router-link :to="`/setup/${props.row.id}`" class="button is-primary">Edit</router-link>
            </b-table-column>

            <b-table-column label="Actions">
              <button class="button is-primary" slot="trigger">
                <span>View</span>
                <b-icon icon="menu-down" />
              </button>
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
import CardComponent from "../../components/CardComponent";
import HeroBar from "../../components/HeroBar";
export default {
  name: "GatewaySetting",
  components: { HeroBar, CardComponent, ModalBox },
  data() {
    return {
      isModalActive: false,
      trashObject: null,
      isLoading: false,
      paginated: true,
      perPage: 10,
    };
  },
  beforeRouteEnter(to, from, next) {
    next((v) => {
      v.$store.dispatch("Setup/getSetups", to.params.id);
    });
  },
  computed: {
    setups() {
      if (this.$route.params.type) {
        return this.$store.getters["Setup/setups"].filter((s) => {
          return s.type.toLowerCase() === this.$route.params.type.toLowerCase();
        });
      }
      return this.$store.getters["Setup/setups"];
    },
  },
};
</script>

<style scoped>
</style>
