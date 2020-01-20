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

                    :data="wallets">

                    <template slot-scope="props">
                        <b-table-column label="Type" field="type" sortable :searchable="true">
                            {{ props.row.type }}
                        </b-table-column>
                        <b-table-column label="Currency" field="currency" sortable :searchable="true">
                            {{ props.row.currency }}
                        </b-table-column>
                        <b-table-column label="Total Balance" field="total_balance" sortable :searchable="true">
                            {{ props.row.total_balance }}
                        </b-table-column>
                        <b-table-column label="Total Deposit" field="total_deposits" sortable :searchable="true">
                            {{ props.row.total_deposits }}
                        </b-table-column>
                        <b-table-column label="Total Withdrawal" field="total_withdrawals" sortable :searchable="true">
                            {{ props.row.total_withdrawals }}
                        </b-table-column>
                        <b-table-column label="Created at" field="created_at" sortable :searchable="true">
                            {{ props.row.created_at }}
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
        name: "Wallets",
        components: {HeroBar, CardComponent, TitleBar, ModalBox },
        data () {
            return {
                id : '',
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
                v.$store.dispatch('Wallet/getWallets');
                v.type = to.params.type;
                v.id = to.params.id;
            })
        },
        computed: {
            wallets(){

                if (this.type && this.id){
                    return this.$store.getters['Wallet/wallets'].filter(w => {
                        return w.type === this.type
                            && w[`${this.type.toLowerCase()}_id`] === parseInt(this.id)
                    })
                }
                return this.$store.getters['Wallet/wallets'];
            }
        },
        methods: {
            trashModal (trashObject) {
                this.trashObject = trashObject;
                this.isModalActive = true
            },
            trashConfirm () {
                this.isModalActive = false;
                this.$buefy.snackbar.open({
                    message: 'Confirmed',
                    queue: false
                })
            },
            trashCancel () {
                this.isModalActive = false
            }
        }
    }
</script>

<style scoped>

</style>
