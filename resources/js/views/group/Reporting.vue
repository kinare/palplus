<template>
    <div>
        <hero-bar :has-right-visible="true">
            App Reportings
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="feedback" class="has-mobile-sort-spaced">
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="reportings"
                >

                    <template slot-scope="props">
                        <b-table-column label="User" field="user" sortable :searchable="true">
                            {{ props.row.user }}
                        </b-table-column>
                        <b-table-column label="Group" field="group" sortable :searchable="true">
                            {{ props.row.group }}
                        </b-table-column>
                        <b-table-column label="Message" field="message" sortable :searchable="true">
                            {{ props.row.message }}
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
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    export default {
        name: "Reporting",
        components: {HeroBar, CardComponent,  ModalBox },
        data () {
            return {
                trashObject: null,
                isLoading: false,
                paginated: true,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Group/getReportings');
            })
        },
        computed: {
            reportings(){
                return this.$store.getters['Group/reposrtings'];
            }
        },
    }
</script>

<style scoped>

</style>
