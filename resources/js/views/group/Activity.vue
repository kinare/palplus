<template>
    <div>
        <hero-bar :has-right-visible="true">
            Group Activities
        </hero-bar>
        <section class="section is-main-section">
            <card-component :title="type" class="has-mobile-sort-spaced">
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="activity"
                >

                    <template slot-scope="props">
                        <b-table-column label="Name" field="name" sortable :searchable="true">
                            {{ props.row.name }}
                        </b-table-column>
                        <b-table-column label="Date/Time" field="start_date" sortable :searchable="true">
                            {{ props.row.start_date }}
                        </b-table-column>
                        <b-table-column label="contacts" field="contacts" sortable :searchable="true">
                            {{ props.row.contacts }}
                        </b-table-column>
                        <b-table-column label="slots" field="slots" sortable :searchable="true">
                            {{ props.row.slots }}
                        </b-table-column>
                        <b-table-column label="Booking Fee" field="booking_fee_amount" sortable :searchable="true">
                            {{ props.row.currency + ' '+props.row.booking_fee_amount }}
                        </b-table-column>
                        <b-table-column label="Created at" field="created_at" sortable :searchable="true">
                            {{ props.row.created_at }}
                        </b-table-column>
                        <b-table-column label="Actions" >
                            <button class="button is-primary" >
                                <span>Options</span>
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
        name: "Activity",
        components: {HeroBar, CardComponent,  ModalBox },
        data () {
            return {
                type : '',
                group_id : '',
                isModalActive: false,
                trashObject: null,
                isLoading: false,
                paginated: true,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Group/getActivity');
                v.type = to.params.type;
                v.group_id = to.params.id;
            })
        },
        computed: {
            activity(){
                if(this.type && this.group_id)
                    return this.$store.getters['Group/activity'].filter(a => {
                        return a.group_id = parseInt(this.group_id)
                            && a.type.toLowerCase() === this.type.toLowerCase()
                    });

                return this.$store.getters['Group/activity'];
            }
        },
    }
</script>

<style scoped>

</style>
