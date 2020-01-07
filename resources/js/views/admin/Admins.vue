<template>
    <div>
        <hero-bar :has-right-visible="true">
            Admins
            <router-link slot="right" to="/admin-card" class="button">
                New admin
            </router-link>
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
                    :data="admins">

                    <template slot-scope="props">
                        <b-table-column label="Name" field="name" sortable :searchable="true">
                            {{ props.row.name }}
                        </b-table-column>
                        <b-table-column label="Email" field="email" sortable :searchable="true">
                            {{ props.row.email }}
                        </b-table-column>
                        <b-table-column label="Phone" field="phone" sortable :searchable="true">
                            {{ props.row.phone }}
                        </b-table-column>
                        <b-table-column label="Access type" field="access_type" sortable :searchable="true">
                            {{ props.row.access_type }}
                        </b-table-column>
                        <b-table-column label="Status" field="active" sortable :searchable="true">
                            <span class="tag" :class="props.row.active ? 'is-success' : 'is-grey'">
                               {{ props.row.active ? 'active' : 'inactive' }}
                            </span>
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

                                <b-dropdown-item has-link aria-role="listitem">
                                    <router-link :to="`admin-card/${props.row.id}`">
                                        view
                                    </router-link>
                                </b-dropdown-item>
                                <b-dropdown-item aria-role="listitem">Update</b-dropdown-item>
                                <b-dropdown-item aria-role="listitem">{{props.row.active ? 'de-activate' : 'activate'}}</b-dropdown-item>
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
        name: "Admins",
        components: {HeroBar, CardComponent,  ModalBox },
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
                v.$store.dispatch('Admin/getAdmins');
            })
        },
        computed: {
            admins(){
                return this.$store.getters['Admin/admins'];
            }
        },
    }
</script>

<style scoped>

</style>
