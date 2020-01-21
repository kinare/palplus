<template>
    <div>
        <hero-bar :has-right-visible="true">
            Admins
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="Admins" class="has-mobile-sort-spaced">
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="setups"
                >

                    <template slot-scope="props">
                        <b-table-column label="Type" field="type" sortable :searchable="true">
                            {{ props.row.type }}
                        </b-table-column>
                        <b-table-column label="gateway" field="gateway" sortable :searchable="true">
                            {{ props.row.gateway }}
                        </b-table-column>
                        <b-table-column label="rate" field="rate" sortable :searchable="true">
                            {{ props.row.rate }}
                        </b-table-column>
                        <b-table-column label="created_at" field="created_at" sortable :searchable="true">
                            {{ props.row.created_at }}
                        </b-table-column>


                        <b-table-column label="Actions" >
                            <button class="button is-primary" slot="trigger">
                                <span>View</span>
                                <b-icon icon="menu-down"/>
                            </button>
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
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    export default {
        name: "GatewaySetting",
        components: {HeroBar, CardComponent,  ModalBox },
        data () {
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
                v.$store.dispatch('Setup/getSetups', to.params.id);
            })
        },
        computed: {
            setups(){
                if (this.$route.params.type){
                    return this.$store.getters['Setup/setups'].filter(s => {
                        return s.type === this.$route.params.type
                    })
                }
                return this.$store.getters['Setup/setups'];
            }
        },
    }
</script>

<style scoped>

</style>
