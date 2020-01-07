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
              icon: 'view-list',
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
            icon: 'desktop-mac',
            label: 'currency rates'
          }
        ],
          [
              {
              label: 'Palplus Admins',
              icon: 'view-list',
              menu: [
                  {
                      to: '/admins',
                      label: 'view admin users'
                  },
                  {
                      to: '/admin-card',
                      label: 'Admin Card'
                  }
              ]
          }
          ],
          [
            {
            to: '/groups',
            label: 'Groups',
            icon: 'table',
            updateMark: true
          },
          {
            to: '/members',
            label: 'Members',
            icon: 'square-edit-outline'
          }
        ],
          [{
              label: 'Transaction',
              icon: 'view-list',
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
            icon: 'credit-card'
          }],
          [{
              label: 'Loans',
              icon: 'view-list',
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
    this.$store.commit('user', {
      name: 'John Doe',
      email: 'john@example.com',
      avatar: '/data-sources/avatars/annie-spratt-121576-unsplash.jpg'
    })
  }
}
</script>
