<template>
    <div class="column is-2">
        <div class="container has-text-left">
            <aside class="menu">
                <p class="menu-label">
                    General
                </p>
                <ul class="menu-list">
                    <li><a>Dashboard</a></li>
                    <li>
                        <a class="is-active">Users</a>
                        <ul>
                            <li><a>App Users</a></li>
                            <li><a>Admins</a></li>
                        </ul>
                    </li>

                    <li>
                        <a>Groups</a>
                    <ul>
                        <li><a>Group List</a></li>
                        <li><a>Activities</a></li>
                        <li><a>Wallets</a></li>
                        <li><a>Transactions</a></li>
                    </ul>
                    </li>

                </ul>

                <p class="menu-label">
                    Accounts
                </p>
                <ul class="menu-list">
                    <li>
                        <a>Wallets</a>
                        <ul>
                            <li><a>Wallets</a></li>
                            <li><a>Withdrawals</a></li>
                            <li><a>Deposits</a></li>
                            <li><a>Loans</a></li>
                        </ul>
                    </li>

                </ul>

                <p class="menu-label">
                    Setups
                </p>
                <ul class="menu-list">
                    <li>
                        <a>App setup</a>
                        <ul>
                            <li><a>Group Types</a></li>
                            <li><a>Activity Types</a></li>
                            <li><a>Currencies</a></li>
                            <li><a>Notifications</a></li>
                        </ul>
                    </li>

                </ul>

                <p class="menu-label">
                    Integrations
                </p>
                <ul class="menu-list">
                    <li>
                        <a class="is-active">Payments</a>
                        <ul>
                            <li><a>M-pesa</a></li>
                            <li><a>Banks</a></li>
                            <li><a>Paypal</a></li>
                        </ul>
                    </li>

                </ul>
            </aside>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SideBar",
        data() {
            return {
                isActive: true
            }
        }
    }
</script>

<style scoped>

</style>
