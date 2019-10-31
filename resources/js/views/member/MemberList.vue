<template>
    <div class="Card has-background-white">
        <header class="card-header">
            <p class="card-header-title">Groups</p>
        </header>
        <div class="card-content is-size-7">
            <b-table
                    :data="data"
                    :striped="true"
                    :narrowed="true"
                    :hoverable="true">
                <template slot-scope="props">
                    <b-table-column field="name" label="Name" :searchable="true" >
                        {{ props.row.name }}
                    </b-table-column>
                    <b-table-column field="country" label="Country" :searchable="true">
                        {{ props.row.country }}
                    </b-table-column>
                    <b-table-column field="phone" label="Phone" :searchable="true">
                        {{ props.row.phone }}
                    </b-table-column>
                    <b-table-column field="email" label="Email" :searchable="true">
                            {{ props.row.email }}
                    </b-table-column>
                    <b-table-column field="status" label="Status" :searchable="true">
                        <span class="tag" :class="props.row.status === 'active' ? 'is-success' : 'is-grey'">
                            {{ props.row.status }}
                        </span>
                    </b-table-column>
                    <b-table-column field="wef" label="WEF" :searchable="true">
                        {{ props.row.wef }}
                    </b-table-column>
                    <b-table-column field="id" label="Options">
                        <b-dropdown aria-role="list">
                            <button class="button" slot="trigger">
                                <span>Options</span> &nbsp;
                                <font-awesome-icon icon="caret-down"/>
                            </button>
                            <b-dropdown-item aria-role="listitem">View Details</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">View Deposits</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">View Withdrawals</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Pending Payments</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">My Groups</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">My Wallets</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Next Of Kin</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">My Loans</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">My Events</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">My Projects</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Suspend</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">{{props.row.status === 'active' ? 'Deactivate' : 'Activate'}}</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Delete</b-dropdown-item>
                        </b-dropdown>
                    </b-table-column>
                </template>
            </b-table>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MemberList",
        data() {
            return {
                data: [
                    {
                        'name': 'Michael Kinare',
                        'country': 'Kenya',
                        'phone': '+2540708338855',
                        'email': 'michaelkinare@gmail.com',
                        'wef': '28-OCT-2019',
                        'status': 'active',
                        'id':'1'
                    },
                ],
            }
        }
    }
</script>

<style scoped>

</style>
