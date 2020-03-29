<template>
    <div>
        <hero-bar :has-right-visible="true">
            Group Settings
            <router-link slot="right" to="/advert-setup" class="button">
                New Setup
            </router-link>
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="Settings" class="has-mobile-sort-spaced">
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
                        <b-table-column label="Description" field="description" sortable :searchable="true">
                            {{ props.row.description }}
                        </b-table-column>
                        <b-table-column label="Amount" field="amount" sortable :searchable="true">
                            {{ props.row.amount }}
                        </b-table-column>
                        <b-table-column label="Currency" field="currency" sortable :searchable="true">
                            {{ props.row.currency }}
                        </b-table-column>
                        <b-table-column label="Actions" >
                            <router-link :to="`/group-setup/${props.row.id}`" class="button is-primary">
                                Edit
                            </router-link>
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
    import HeroBar from "../../components/HeroBar";
    import CardComponent from "../../components/CardComponent";
    import ModalBox from "../../components/ModalBox";
    export default {
        name: "GroupSetup",
        components: {HeroBar, CardComponent,  ModalBox },
        data :  function() {
            return {
                isModalActive: false,
                trashObject: null,
                isLoading: false,
                paginated: true,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Setup/getGroupSetups');
            })
        },
        computed: {
            setups(){
                return this.$store.getters['Setup/groupSetups'];
            }
        },
    }
</script>

<style scoped>

</style>
