<template>
    <div>
        <hero-bar :has-right-visible="true">
            Members
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
                    :data="members">

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
                                    <router-link :to="`member/card/${props.row.id}`">View details</router-link>
                                    <router-link :to="`transactions/credit/User/${props.row.id}`">deposits</router-link>
                                    <router-link :to="`transactions/debit/User/${props.row.id}`">withdrawals</router-link>
                                    <router-link :to="`pending-payments/${props.row.id}/user`">Pending payment</router-link>
                                    <router-link :to="`/groups/${props.row.id}`">My Groups</router-link>
                                    <router-link :to="`/wallets/User/${props.row.id}`">My Wallet</router-link>
                                    <router-link :to="`/nok/${props.row.id}`">Next of Kin</router-link>
                                    <router-link :to="`/loans/all/user/${props.row.id}`">My Loans</router-link>
                                    <router-link :to="`activity/event/${props.row.group_id}/${props.row.id}`">My Events</router-link>
                                    <router-link :to="`activity/meeting/${props.row.group_id}/${props.row.id}`">My Meetings</router-link>
                                    <router-link :to="`project/${props.row.group_id}`">My Projects</router-link>
                                </b-dropdown-item>
                                <b-dropdown-item aria-role="listitem" @click="toggleActive(props.row.id)">{{props.row.active ? 'deactivate' : 'activate'}}</b-dropdown-item>
                                <b-dropdown-item aria-role="listitem" @click="suspend(props.row.id)">suspend</b-dropdown-item>
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

        <b-modal :active.sync="isModalActivateActive"
                 has-modal-card
                 trap-focus
                 aria-role="dialog"
                 aria-modal>

            <form action="">
                <div class="modal-card" style="width: auto">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Please input reason</p>
                    </header>
                    <section class="modal-card-body">
                        <b-field label="Reason">
                            <textarea v-model="reason" cols="50"/>
                        </b-field>
                    </section>
                    <footer class="modal-card-foot">
                        <a class="button" @click="isModalActivateActive = false">Close</a>
                        <a class="button is-primary" @click.prevent="onOkToggleActive">Save</a>
                    </footer>
                </div>
            </form>
        </b-modal>

        <b-modal :active.sync="isModalSuspendActive"
                 has-modal-card
                 trap-focus
                 aria-role="dialog"
                 aria-modal>
            <form action="">
                <div class="modal-card" style="width: auto">
                    <header class="modal-card-head">
                        <p class="modal-card-title">Please input reason</p>
                    </header>
                    <section class="modal-card-body">
                        <b-field label="Reason">
                            <textarea v-model="reason" cols="50"/>
                        </b-field>
                    </section>
                    <footer class="modal-card-foot">
                        <a class="button">Close</a>
                        <a class="button is-primary" @click.prevent="onOkSuspend">Save</a>
                    </footer>
                </div>
            </form>
        </b-modal>

    </div>
</template>

<script>
    import ModalBox from '../../components/ModalBox'
    import CardComponent from "../../components/CardComponent";
    import HeroBar from "../../components/HeroBar";
    export default {
        name: "Member",
        components: {HeroBar, CardComponent,  ModalBox },
        data () {
            return {
                group_id : '',
                type : '',
                isModalActivateActive: false,
                isModalSuspendActive: false,
                reason : '',
                id : '',
                trashObject: null,
                isLoading: false,
                paginated: true,
                perPage: 10,
            }
        },
        beforeRouteEnter(to, from, next){
            next(v => {
                v.$store.dispatch('Member/getMembers');
                v.group_id = to.params.id
                v.type = to.params.type
            })
        },
        computed: {
            members(){
                if (this.group_id  && this.type === 'admins')
                    return this.$store.getters['Member/members'].filter( m => {
                        return m.group_id === parseInt(this.group_id)
                             & m.is_admin === 1
                    });

                if (this.group_id  && this.type === 'withdrawal-approvers')
                    return this.$store.getters['Member/members'].filter( m => {
                        return m.group_id === parseInt(this.group_id)
                            & m.withdrawal_approver === 1
                    });

                if (this.group_id  && this.type === 'loan-approvers')
                    return this.$store.getters['Member/members'].filter( m => {
                        return m.group_id === parseInt(this.group_id)
                            & m.loan_approver === 1
                    });

                if (this.group_id)
                    return this.$store.getters['Member/members'].filter( m => {
                        return m.group_id === parseInt(this.group_id)
                    });

                return this.$store.getters['Member/members'];
            }
        },
        methods : {
            toggleActive : function (id) {
                this.isModalActivateActive = true;
                this.id = id;
            },

            onOkToggleActive : function(){
                this.$store.dispatch('Member/toggleMemberActive', {
                    id : this.id,
                    reason : this.reason
                });

                this.reason = '';
                this.id = '';
                this.isModalActivateActive = false;
            },

            suspend : function (id) {
                this.isModalSuspendActive = true;
                this.id = id;
            },

            onOkSuspend : function () {
                this.$store.dispatch('Member/suspendMember', {
                    id : this.id,
                    reason : this.reason
                });

                this.reason = '';
                this.id = '';
                this.isModalSuspendActive = false;
            }
        }
    }
</script>

<style scoped>

</style>
