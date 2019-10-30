<template>
    <div class="column has-background-white is-2" style="border-radius : 6px">
        <div class="content has-text-centered">
            <figure class="image is-96x96 is-inline-block">
                <img class="is-rounded" src="https://bulma.io/images/placeholders/96x96.png">
            </figure>
        </div>
        <b-dropdown aria-role="list">
            <button class="button is-white is-small" slot="trigger">
                User Name &nbsp; <font-awesome-icon icon="caret-down"/>
            </button>
            <b-dropdown-item aria-role="listitem">Profile</b-dropdown-item>
            <b-dropdown-item aria-role="listitem">Another action</b-dropdown-item>
            <b-dropdown-item aria-role="listitem">Something else</b-dropdown-item>
        </b-dropdown>
        <hr >
        <div class="container has-text-left">
            <b-menu>
                <b-menu-list label="General">
                    <b-menu-item tag="router-link" to="dashboard" label="Dashboard"></b-menu-item>
                </b-menu-list>

                <b-menu-list label="Administration">
                    <b-menu-item>
                        <template slot="label" slot-scope="props">
                            Palplus Admins
                        </template>
                        <b-menu-item tag="router-link" to="dashboard/admins" label="View Admin"></b-menu-item>
                        <b-menu-item tag="router-link" to="dashboard/new-admin" label="New Admin"></b-menu-item>
                    </b-menu-item>
                </b-menu-list>

                <b-menu-list label="Groups">
                    <b-menu-item tag="router-link" to="dashboard/groups" label="Groups"></b-menu-item>
                    <b-menu-item tag="router-link" to="dashboard/activities" label="Activities"></b-menu-item>
                </b-menu-list>

                <b-menu-list label="Members">
                    <b-menu-item tag="router-link" to="dashboard/members" label="Member"></b-menu-item>
                </b-menu-list>

                <b-menu-list label="Wallet">
                    <b-menu-item tag="router-link" to="dashboard/members" label="Group Wallets"></b-menu-item>
                    <b-menu-item tag="router-link" to="dashboard/members" label="Member Wallets"></b-menu-item>
                </b-menu-list>

                <b-menu-list label="Transactions">
                    <b-menu-item>
                        <template slot="label" slot-scope="props">
                            Transactions
                        </template>
                        <b-menu-item tag="router-link" to="dashboard/withdrawal-requests" label="Withdrawal Requests"></b-menu-item>
                        <b-menu-item tag="router-link" to="dashboard/withdrawals"label="Withdrawals"></b-menu-item>
                        <b-menu-item tag="router-link" to="dashboard/deposits" label="Deposits"></b-menu-item>
                    </b-menu-item>
                </b-menu-list>

                <b-menu-list label="Loans">
                    <b-menu-item label="Loans">
                        <b-menu-item tag="router-link" to="dashboard/loans-pending" label="Pending"></b-menu-item>
                        <b-menu-item tag="router-link" to="dashboard/loans-paid" label="Paid"></b-menu-item>
                    </b-menu-item>
                </b-menu-list>

                <b-menu-list label="Investments">
                    <b-menu-item tag="router-link" to="dashboard/investment-opportunities" label="Opportunities"></b-menu-item>
                </b-menu-list>
            </b-menu>
        </div>
    </div>
</template>

<script>
    import BDropdown from "buefy/src/components/dropdown/Dropdown";
    import BDropdownItem from "buefy/src/components/dropdown/DropdownItem";
    import BMenu from "buefy/src/components/menu/Menu";
    export default {
        name: "SideBar",
        components: {BMenu, BDropdownItem, BDropdown},
        data() {
            return {
                isActive: true
            }
        }
    }
</script>

<style scoped>
.side-menu{

}
</style>
