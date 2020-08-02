<template>
    <div>
        <hero-bar :has-right-visible="true">
            Next of Kin
        </hero-bar>
        <section class="section is-main-section">
            <card-component
                title="Next of Kin"
                class="has-table has-mobile-sort-spaced"
            >
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="nok"
                >
                    <template slot-scope="props">
                        <b-table-column
                            label="Type"
                            field="type"
                            sortable
                            :searchable="true"
                        >
                            {{ props.row.type }}
                        </b-table-column>
                        <b-table-column
                            label="Currency"
                            field="currency"
                            sortable
                            :searchable="true"
                        >
                            {{ props.row.currency }}
                        </b-table-column>
                        <b-table-column
                            label="Total Balance"
                            field="total_balance"
                            sortable
                            :searchable="true"
                        >
                            {{ props.row.total_balance }}
                        </b-table-column>
                        <b-table-column
                            label="Total Deposit"
                            field="total_deposits"
                            sortable
                            :searchable="true"
                        >
                            {{ props.row.total_deposits }}
                        </b-table-column>
                        <b-table-column
                            label="Total Withdrawal"
                            field="total_withdrawals"
                            sortable
                            :searchable="true"
                        >
                            {{ props.row.total_withdrawals }}
                        </b-table-column>
                        <b-table-column
                            label="Created at"
                            field="created_at"
                            sortable
                            :searchable="true"
                        >
                            {{ props.row.created_at }}
                        </b-table-column>
                    </template>

                    <section class="section" slot="empty">
                        <div class="content has-text-grey has-text-centered">
                            <template v-if="isLoading">
                                <p>
                                    <b-icon
                                        icon="dots-horizontal"
                                        size="is-large"
                                    />
                                </p>
                                <p>Fetching data...</p>
                            </template>
                            <template v-else>
                                <p>
                                    <b-icon
                                        icon="emoticon-sad"
                                        size="is-large"
                                    />
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
    name: "NextOfKin",
    components: { HeroBar, CardComponent, TitleBar, ModalBox },
    data() {
        return {
            id: "",
            type: "",
            isModalActive: false,
            trashObject: null,
            isLoading: false,
            paginated: false,
            perPage: 10,
        };
    },
    beforeRouteEnter(to, from, next) {
        next((v) => {
            v.$store.dispatch("Member/getNok");
            v.id = to.params.id;
        });
    },
    computed: {
        nok() {
            if (this.id) {
                return this.$store.getters["Member/nok"].filter((nok) => {
                    return nok.user_id === parseInt(this.id);
                });
            }
            return this.$store.getters["Member/nok"];
        },
    },
};
</script>

<style scoped></style>
