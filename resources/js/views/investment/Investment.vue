<template>
    <div>
        <hero-bar :has-right-visible="true">
            Investment Opportunities
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="opportunities" class="has-mobile-sort-spaced">
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="opportunities">

                    <template slot-scope="props">
                        <b-table-column label="Title" field="title" sortable :searchable="true">
                            {{ props.row.title }}
                        </b-table-column>
                        <b-table-column label="Description" field="description" sortable :searchable="true">
                            {{ props.row.description }}
                        </b-table-column>
                        <b-table-column label="Featured" field="featured" sortable :searchable="true">
                            {{ props.row.featured }}
                        </b-table-column>
                        <b-table-column label="Amount" field="amount" sortable :searchable="true">
                            {{ props.row.amount }}
                        </b-table-column>
                        <b-table-column label="Created at" field="created_at" sortable :searchable="true">
                            {{ props.row.created_at }}
                        </b-table-column>
                        <b-table-column label="Actions" >
                            <b-dropdown aria-role="list">
                                <button class="button is-primary" slot="trigger">
                                    <span>Options</span>
                                    <b-icon icon="menu-down"></b-icon>
                                </button>

                                <b-dropdown-item aria-role="listitem">View</b-dropdown-item>
                                <b-dropdown-item aria-role="listitem">Update</b-dropdown-item>
                                <b-dropdown-item aria-role="listitem">Delete</b-dropdown-item>
                            </b-dropdown>
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
        name: "Investment",
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
                v.$store.dispatch('Investment/getOpportunities');
            })
        },
        computed: {
            opportunities(){
                return this.$store.getters['Investment/opportunities'];
            }
        },
    }
</script>

<style scoped>

</style>
