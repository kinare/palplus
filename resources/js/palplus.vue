<template>
  <div>
    <nav-bar/>
    <aside-menu :menu="menu"/>
    <router-view/>
    <footer-bar/>
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from './components/NavBar'
import AsideMenu from './components/AsideMenu'
import FooterBar from './components/FooterBar'

export default {
  name: 'palplus',
  components: {
    FooterBar,
    AsideMenu,
    NavBar
  },
  computed: {
    menu () {
      return [
          [
              {
              label: 'Palplus wallet',
              icon: 'wallet',
              menu: [
                  {
                      to: '/wallets',
                      label: 'Wallets'
                  },
                  {
                      to: '/wallets-transactions/credit',
                      label: 'Deposits'
                  },
                  {
                      to: '/wallets-transactions/debit',
                      label: 'Withdrawals'
                  }
              ]
          }
          ],
          [
          {
            to: '/currency-rates',
            icon: 'cash',
            label: 'currency rates'
          }
        ],
          [
              {
              label: 'Palplus Admins',
              icon: 'account-tie',
              menu: [
                  {
                      to: '/admins',
                      icon: 'account-supervisor',
                      label: 'view admin users'
                  },
                  {
                      to: '/admin-card',
                      icon: 'account-plus',
                      label: 'new admin'
                  }
              ]
          }
          ],
          [
            {
            to: '/groups',
            label: 'Groups',
            icon: 'account-group',
          },
          {
            to: '/members',
            label: 'Members',
            icon: 'account-supervisor-circle'
          }
        ],
          [{
              label: 'Transaction',
              icon: 'cash-register',
              menu: [
                  {
                      to: '/group-withdrawal-requests',
                      label: 'Group withdrawal requests'
                  },
                  {
                      to: '/transactions/credit',
                      label: 'Deposits'
                  },
                  {
                      to: '/transactions/debit',
                      label: 'Withdrawals'
                  }
              ]
          }],
          [{
            to: '/investment-opportunity',
            label: 'Investment opportunity',
            icon: 'cash-usd'
          }],
          [{
              label: 'Loans',
              icon: 'cash-multiple',
              menu: [
                  {
                      to: '/loans/approved',
                      label: 'Pending loans'
                  },
                  {
                      to: '/loans/cleared',
                      label: 'Paid loans'
                  },
              ]
          }],
      ]
    }
  },
  created () {
      this.$store.dispatch('Auth/user');
  }
}
</script>
