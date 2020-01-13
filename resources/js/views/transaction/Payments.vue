<template>
    <div>
        <hero-bar :has-right-visible="true">
            Pending Payments
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
                    :data="payments">

                    <template slot-scope="props">
                        <b-table-column label="Transaction code" field="transaction_code" sortable :searchable="true">
                            {{ props.row.description }}
                        </b-table-column>
                        <b-table-column label="Amount" field="amount" sortable :searchable="true">
                            {{ props.row.amount }}
                        </b-table-column>
                        <b-table-column label="Currency" field="currency" sortable :searchable="true">
                            {{ props.row.currency }}
                        </b-table-column>
                        <b-table-column label="Status" field="status" sortable :searchable="true">
                            {{ props.row.status }}
                        </b-table-column>
                        <b-table-column label="created_at" field="created_at" sortable :searchable="true">
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
        name: "Payments",
        components: {HeroBar, CardComponent, TitleBar, ModalBox },
        data () {
            return {
                group_id : '',
                isModalActive: false,
                trashObject: null,
                isLoading: false,
                paginated: false,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Transaction/getPayments');
                v.group_id = to.params.id;
            })
        },
        computed: {
            payments(){
                if(this.group_id){
                    return this.$store.getters['Transaction/payments'].filter(trans => {
                        return trans.group_id === parseInt(this.group_id)
                    });
                }
                return this.$store.getters['Transaction/payments']
            }
        },
    }
</script>

<style scoped>

</style>
