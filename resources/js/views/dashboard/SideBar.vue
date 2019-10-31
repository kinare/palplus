<template>
    <div class="column  is-3">
        <div class="box" style="border-radius:0; box-shadow:none">

            <article class="media">
                <figure class="media-left">
                    <p class="image is-48x48">
                        <img class="is-rounded" src="https://bulma.io/images/placeholders/48x48.png">
                    </p>
                </figure>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong>John Smith</strong>
                            <br>
                            <font-awesome-icon class="has-text-success" icon="circle"/> online
                        </p>
                    </div>
                </div>
            </article>

            <hr >
            <div class="container has-text-left">
                <aside class="menu">
                    <ul class="menu-list">
                        <li><router-link to="/dashboard/stats"><font-awesome-icon icon="tachometer-alt"/> Dashboard</router-link></li>
                        <li><router-link to="/dashboard/wallet"><font-awesome-icon icon="wallet"/> Palplus Wallets</router-link></li>
                        <li><router-link to="/dashboard/currency"><font-awesome-icon icon="coins"/> Currency Rates</router-link></li>
                        <li>
                            <a @click="isActive === 'admins' ? isActive = '' : isActive = 'admins'" :class="{'is-active' : isActive === 'admins'}">
                                <font-awesome-icon icon="user-cog"/> Palplus Admins
                                <span class="is-pulled-right">
                                <font-awesome-icon :icon="isActive !== 'admins' ? 'caret-down' : 'caret-up'"/>
                            </span>
                            </a>
                            <ul :style="isActive !== 'admins' ? 'display:none' : ''">
                                <li><router-link to="/dashboard/admin/card"><font-awesome-icon icon="user-plus"/> New Admin</router-link></li>
                                <li><router-link to="/dashboard/admins"><font-awesome-icon icon="users"/> View Admins</router-link></li>
                            </ul>
                        </li>
                        <li><router-link to="/dashboard/groups"><font-awesome-icon icon="users"/> Groups</router-link></li>
                        <li><router-link to="/dashboard/members"><font-awesome-icon icon="user-friends"/> Members</router-link></li>
                        <li>
                            <a @click="isActive === 'transacts' ? isActive = '' : isActive = 'transacts'">
                                <font-awesome-icon icon="receipt"/> Transactions
                                <span class="is-pulled-right">
                                <font-awesome-icon :icon="isActive !== 'transacts' ? 'caret-down' : 'caret-up'"/>
                            </span>
                            </a>
                            <ul :style="isActive !== 'transacts' ? 'display:none' : ''">
                                <li><router-link to="/dashboard/withdrawal-requests"><font-awesome-icon icon="users"/> Withdrawal requests</router-link></li>
                                <li><router-link to="/dashboard/withdrawals"><font-awesome-icon icon="user-plus"/> Withdrawals</router-link></li>
                                <li><router-link to="/dashboard/deposits"><font-awesome-icon icon="user-plus"/> Deposits</router-link></li>
                            </ul>
                        </li>
                        <li><router-link to="/dashboard/investment-opportunities"><font-awesome-icon icon="user-friends"/> Investment Opportunities</router-link></li>
                        <li>
                            <a @click="isActive === 'loans' ? isActive = '' : isActive = 'loans'">
                                <font-awesome-icon icon="user-cog"/> Loans
                                <span class="is-pulled-right">
                                <font-awesome-icon :icon="isActive !== 'loans' ? 'caret-down' : 'caret-up'"/>
                            </span>
                            </a>
                            <ul :style="isActive !== 'loans' ? 'display:none' : ''">
                                <li><router-link to="/dashboard/loans/pending"><font-awesome-icon icon="users"/> Pending</router-link></li>
                                <li><router-link to="loans/paid"><font-awesome-icon icon="user-plus"/> Paid</router-link></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
</template>

<script>
    import BDropdown from "buefy/src/components/dropdown/Dropdown";
    import BDropdownItem from "buefy/src/components/dropdown/DropdownItem";
    import BMenu from "buefy/src/components/menu/Menu";
    import BMenuList from "buefy/src/components/menu/MenuList";
    export default {
        name: "SideBar",
        components: {BMenuList, BMenu, BDropdownItem, BDropdown},
        data() {
            return {
                isActive: ''
            }
        }
    }
</script>

<style scoped>
a.router-link-active{
    background-color: #6d488e!important;
    color: #fff!important;
}
    .menu-list li{
        margin: 20px 0;
    }
</style>
