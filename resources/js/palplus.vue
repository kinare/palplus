<template>
  <div>
    <nav-bar />
    <aside-menu :menu="menu" />
    <router-view />
    <footer-bar />
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from "./components/NavBar";
import AsideMenu from "./components/AsideMenu";
import FooterBar from "./components/FooterBar";

export default {
  name: "palplus",
  components: {
    FooterBar,
    AsideMenu,
    NavBar,
  },
  computed: {
    menu() {
      return [
        [
          {
            to: "/dashboard",
            icon: "desktop-mac-dashboard",
            label: "Dashboard",
          },
          {
            to: "/communication",
            icon: "desktop-mac-dashboard",
            label: "Communicate",
          },
        ],
        [
          {
            label: "App wallet",
            icon: "wallet",
            menu: [
              {
                to: "/wallets",
                label: "Wallets",
              },
              {
                to: "/wallets-transactions/credit",
                label: "Deposits",
              },
              {
                to: "/wallets-transactions/debit",
                label: "Withdrawals",
              },
            ],
          },
        ],
        [
          {
            to: "/currency-rates",
            icon: "cash",
            label: "Currency rates",
          },
        ],
        [
          {
            label: "Palplus Admins",
            icon: "account-tie",
            menu: [
              {
                to: "/admins",
                icon: "account-supervisor",
                label: "View admin users",
              },
              {
                to: "/admin-card",
                icon: "account-plus",
                label: "New admin",
              },
            ],
          },
        ],
        [
          {
            to: "/groups",
            label: "Groups",
            icon: "account-group",
          },
          {
            to: "/members",
            label: "Members",
            icon: "account-supervisor-circle",
          },
          {
            to: "/reportings",
            label: "Reportings",
            icon: "whistle",
          },
        ],
        [
          {
            label: "Transaction",
            icon: "cash-register",
            menu: [
              {
                to: "/group-withdrawal-requests",
                label: "Group withdrawal requests",
              },
              {
                to: "/transactions/credit",
                label: "Deposits",
              },
              {
                to: "/transactions/debit",
                label: "Withdrawals",
              },
              {
                to: "/paypal-withdrawal",
                label: "Paypal Withdrawal",
              },
            ],
          },
        ],
        [
          {
            to: "/investment-opportunity",
            label: "Investment opportunity",
            icon: "cash-usd",
          },
        ],
        [
          {
            label: "Loans",
            icon: "cash-multiple",
            menu: [
              {
                to: "/loans/approved",
                label: "Pending loans",
              },
              {
                to: "/loans/cleared",
                label: "Paid loans",
              },
            ],
          },
        ],
        [
          {
            label: "Setup",
            icon: "cogs",
            menu: [
              {
                to: "/setups/withdrawal",
                label: "Withdrawal",
              },
              {
                to: "/setups/deposit",
                label: "Deposit",
              },
              {
                to: "/advert-setups",
                label: "Ad setup",
              },
              {
                to: "/group-setups",
                label: "Group setup",
              },
            ],
          },
        ],
      ];
    },
  },
  created() {
    this.$store.dispatch("Auth/user");
  },
};
</script>

<style>
.actions-span {
  display: flex;
  justify-content: space-between;
  align-content: center;
  align-items: center;
}
.actions-span span {
  margin-right: 5px !important;
}
.card-title {
  padding: 1rem 0.2rem !important;
}
</style>