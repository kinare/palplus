<template>
    <div>
        <hero-bar :has-right-visible="true">
            Wallets
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="Clients" class="has-table has-mobile-sort-spaced">
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="transactions">

                    <template slot-scope="props">
                        <b-table-column label="Transaction code" field="transaction_code" sortable :searchable="true">
                            {{ props.row.transaction_code }}
                        </b-table-column>
                        <b-table-column label="Amount" field="amount" sortable :searchable="true">
                            {{ props.row.amount }}
                        </b-table-column>
                        <b-table-column label="From currency" field="from_currency" sortable :searchable="true">
                            {{ props.row.from_currency }}
                        </b-table-column>
                        <b-table-column label="To currency" field="to_currency" sortable :searchable="true">
                            {{ props.row.to_currency }}
                        </b-table-column>
                        <b-table-column label="Conversion rate" field="conversion_rate" sortable :searchable="true">
                            {{ props.row.conversion_rate }}
                        </b-table-column>
                        <b-table-column label="conversion time" field="conversion_time" sortable :searchable="true">
                            {{ props.row.conversion_time }}
                        </b-table-column>
                        <b-table-column label="Gateway" field="account_no" sortable :searchable="true">
                            {{ props.row.account_no }}
                        </b-table-column>
                    </template>

                    <section class="section" slot="empty">
                        <div class="content has-text-grey has-text-centered">
                            <template v-if="isLoading">
                                <p>
                                    <b-icon icon="dots-horizontal" size="is-large"/>
                                </p>
                                <p>Fetching data...</p>
                            </template>
                            <template v-else>
                                <p>
                                    <b-icon icon="emoticon-sad" size="is-large"/>
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
    import ModalBox from '../../components/ModalBox'
    import TitleBar from "../../components/TitleBar";
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    export default {
        name: "Transactions",
        components: {HeroBar, CardComponent, TitleBar, ModalBox },
        data () {
            return {
                type : '',
                isModalActive: false,
                trashObject: null,
                isLoading: false,
                paginated: false,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Wallet/getTransactions');
                v.type = to.params.type;
            })
        },
        computed: {
            transactions(){
                return this.$store.getters['Wallet/transactions'].filter(trans => {
                    return trans.entry === this.type;
                })
            }
        },
        watch : {
            '$route.params.type' : {
                handler : function(n){
                    this.type = n
                }
            }
        }

    }
</script>

<style scoped>

</style>
