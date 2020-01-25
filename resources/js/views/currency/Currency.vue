<template>
    <div>
        <hero-bar :has-right-visible="true">
            Currencies
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="Currencies" class="has-table has-mobile-sort-spaced">
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="currency">

                    <template slot-scope="props">
                        <b-table-column label="Currency" field="currency" sortable :searchable="true">
                            {{ props.row.currency }}
                        </b-table-column>
                        <b-table-column label="Short description" field="short_description" sortable :searchable="true">
                            {{ props.row.short_description }}
                        </b-table-column>
                        <b-table-column label="Country" field="country" sortable :searchable="true">
                            {{ props.row.country }}
                        </b-table-column>
                        <b-table-column label="Today's Rate vs USD" field="rate" sortable :searchable="true">
                            {{ props.row.rate }}
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
        name: "Currency",
        components: {HeroBar, CardComponent, TitleBar, ModalBox },
        data () {
            return {
                isModalActive: false,
                trashObject: null,
                isLoading: false,
                paginated: false,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Currency/getCurrency');
            })
        },
        computed: {
            currency(){
                return this.$store.getters['Currency/currency'];
            }
        },
    }
</script>

<style scoped>

</style>
