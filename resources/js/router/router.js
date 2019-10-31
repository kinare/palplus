import Vue from "vue";
import Router from "vue-router";
import NotFound from "../views/error/NotFound";
import Home from "../views/Home";
import Dashboard from "../views/dashboard/Dashboard";
import Auth from "../views/auth/Auth";
import Login from "../views/auth/Login";
import PasswordRequest from "../views/auth/PasswordRequest";
import Password from "../views/auth/Password";
Vue.use(Router);

export default new Router({
  mode: "history",
  base: process.env.BASE_URL,
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/dashboard",
      component: Dashboard,
      children : [
        {
          path : '',
          redirect: '/dashboard/stats'
        },
        {
          path : 'stats',
          name: "Dashboard",
          components : {
            content : () => import(/* webpackChunkName: "about" */ "../views/stats/Stats"),
            menu : () => import(/* webpackChunkName: "about" */ "../views/stats/Menu")
          }
        },
        {
          path : 'wallet',
          name: "Palplus Wallet",
          components : {
            content : () => import(/* webpackChunkName: "about" */ "../views/wallet/List"),
          }
        },
        {
          path : 'currency',
          name: "Currency Rates",
          components : {
            content : () => import(/* webpackChunkName: "about" */ "../views/currency/List"),
          }
        },
        {
          path : 'admins',
          name: "Admin",
          components : {
            content : () => import(/* webpackChunkName: "about" */ "../views/admin/AdminList"),
          }
        },
        {
          path : 'admin/card/:id?',
          name: "Admin Card",
          components : {
            content : () => import(/* webpackChunkName: "about" */ "../views/admin/AdminCard"),
          }
        },
        {
          path : 'groups',
          name: "Groups",
          components : {
            content : () => import(/* webpackChunkName: "about" */ "../views/group/GroupList"),
          }
        },
        {
          path : 'members',
          name: "Members",
          components : {
            content : () => import(/* webpackChunkName: "about" */ "../views/member/MemberList"),
          }
        },
      ]
    },

    {
      path : '/auth',
      component : Auth,
      children : [
        {
          path : '',
          redirect : 'auth/login',
        },
        {
          path : 'login',
          component : Login
        },
        {
          path : 'reset',
          component : PasswordRequest
        },
        {
          path : 'password/:token',
          component : Password
        }
      ]
    },

    //fallback rout
    {
      path: "*",
      component: NotFound
    }
  ]
});
