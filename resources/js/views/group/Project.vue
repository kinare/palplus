<template>
    <div>
        <hero-bar :has-right-visible="true">
            Group Activities
        </hero-bar>
        <section class="section is-main-section">
            <card-component title="Projects" class="has-mobile-sort-spaced">
                <b-table
                    :loading="isLoading"
                    :paginated="paginated"
                    :per-page="perPage"
                    :striped="true"
                    :hoverable="true"
                    default-sort="name"
                    :data="project"
                >

                    <template slot-scope="props">
                        <b-table-column label="Name" field="name" sortable :searchable="true">
                            {{ props.row.name }}
                        </b-table-column>
                        <b-table-column label="description" field="description" sortable :searchable="true">
                            {{ props.row.description }}
                        </b-table-column>
                        <b-table-column label="Start" field="start_date" sortable :searchable="true">
                            {{ props.row.start_date }}
                        </b-table-column>
                        <b-table-column label="End" field="end_date" sortable :searchable="true">
                            {{ props.row.end_date }}
                        </b-table-column>
                        <b-table-column label="Estimated Cost" field="estimated_cost" sortable :searchable="true">
                            {{ `${props.row.currency}  ${props.row.estimated_cost}` }}
                        </b-table-column>
                        <b-table-column label="Actual Cost" field="actual_cost" sortable :searchable="true">
                            {{ `${props.row.currency}  ${props.row.actual_cost}` }}
                        </b-table-column>
                        <b-table-column label="Contributions" field="allow_contributions" sortable :searchable="true">
                            {{ props.row.allow_contributions ?  'Yes' : 'No' }}
                        </b-table-column>
                        <b-table-column label="Amount" field="contribution_amount" sortable :searchable="true">
                            {{ props.row.currency + ' '+props.row.contribution_amount }}
                        </b-table-column>
                        <b-table-column label="Frequency" field="contribution_frequency" sortable :searchable="true">
                            {{ props.row.frequency }}
                        </b-table-column>
                        <b-table-column label="Reminders" field="reminders" sortable :searchable="true">
                            {{ props.row.enable_reminders ?  'Yes' : 'No' }}
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
        name: "Project",
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
                v.$store.dispatch('Group/getProject');
                v.type = to.params.type;
                v.group_id = to.params.id;
            })
        },
        computed: {
            project(){
                if(this.group_id)
                    return this.$store.getters['Group/project'].filter(a => {
                        return a.group_id = parseInt(this.group_id)
                    });

                return this.$store.getters['Group/project'];
            }
        },
    }
</script>

<style scoped>

</style>
