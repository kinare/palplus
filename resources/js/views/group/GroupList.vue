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
                    <b-table-column field="currency" label="Currency" :searchable="true">
                        {{ props.row.currency }}
                    </b-table-column>
                    <b-table-column field="type" label="Type" :searchable="true">
                        <span class="tag" :class="props.row.status === 'active' ? 'is-success' : 'is-grey'">
                            {{ props.row.type }}
                        </span>
                    </b-table-column>
                    <b-table-column field="wef" label="WEF" :searchable="true">
                        {{ props.row.wef }}
                    </b-table-column>
                    <b-table-column field="access_level" label="Access Level" :searchable="true">
                        {{ props.row.access_level }}
                    </b-table-column>
                    <b-table-column field="created_by_name" label="Created By" :searchable="true">
                        {{ props.row.created_by_name }}
                    </b-table-column>
                    <b-table-column field="created_by_phone" label="Phone" :searchable="true">
                        {{ props.row.created_by_phone }}
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
                            <b-dropdown-item aria-role="listitem">View Chats</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Pending Payments</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Members</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Admins</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Loan</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Loan Approvers</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Withdawal Approvers</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Membership Settings</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Loan Settings</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Events</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Meetings</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Projects</b-dropdown-item>
                            <b-dropdown-item aria-role="listitem">Projects</b-dropdown-item>
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
        name: "GroupList",
        data() {
            return {
                data: [
                    {
                        'name': 'Huruma Youth Group',
                        'country': 'Kenya',
                        'currency': 'KES',
                        'type': 'Investment',
                        'wef': '28-OCT-2019',
                        'access_level': 'private',
                        'status': 'active',
                        'created_by_name': 'John Doe',
                        'created_by_phone': '+254708338855',
                        'id':'1'
                    },
                ],
            }
        }
    }
</script>

<style scoped>

</style>
