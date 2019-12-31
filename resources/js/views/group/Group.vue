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
                    :data="groups">

                    <template slot-scope="props">
                        <b-table-column label="Name" field="name" sortable :searchable="true">
                            {{ props.row.name }}
                        </b-table-column>
                        <b-table-column label="description" field="description" sortable :searchable="true">
                            {{ props.row.description }}
                        </b-table-column>
                        <b-table-column label="country" field="country" sortable :searchable="true">
                            {{ props.row.country }}
                        </b-table-column>
                        <b-table-column label="currency" field="currency" sortable :searchable="true">
                            {{ props.row.currency }}
                        </b-table-column>
                        <b-table-column label="Access level" field="access_level" sortable :searchable="true">
                            {{ props.row.access_level }}
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
        name: "Group",
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
                v.$store.dispatch('Group/getGroups');
            })
        },
        computed: {
            groups(){
                return this.$store.getters['Group/groups'];
            }
        },
    }
</script>

<style scoped>

</style>
