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
                      to: '/wallet-deposits',
                      label: 'Deposits'
                  },
                  {
                      to: '/wallet-withdrawals',
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
                      to: '/new-admin',
                      label: 'New admin user'
                  },
                  {
                      to: '/wallet-withdrawals',
                      label: 'view admin users'
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
              label: 'Transactions',
              icon: 'view-list',
              menu: [
                  {
                      to: '/group-withdrawal-requests',
                      label: 'Group withdrawal requests'
                  },
                  {
                      to: '/withdrawals',
                      label: 'withdrawals'
                  },
                  {
                      to: '/deposits',
                      label: 'deposits'
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
                      to: '/pending-loans',
                      label: 'Pending loans'
                  },
                  {
                      to: '/paid-loans',
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
