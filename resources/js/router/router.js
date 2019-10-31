import Vue from "vue";
import Router from "vue-router";
import AuthCheck from "./middleware/Auth";
import nextFactory from "./middleware/MiddlewareFactory";
import NotFound from "../views/error/NotFound";
import Home from "../views/Home";
import Dashboard from "../views/dashboard/Dashboard";
import Auth from "../views/auth/Auth";
import Login from "../views/auth/Login";
import PasswordRequest from "../views/auth/PasswordRequest";
import Password from "../views/auth/Password";
import Invitation from "../views/auth/Invitation";
Vue.use(Router);


const router =new Router({
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
          },
          meta: { middleware: AuthCheck }
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
      ],
      meta: { middleware: AuthCheck }
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
        },
        {
          path : 'invitation/:token',
          component : Invitation
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


router.beforeEach((to, from, next) => {
  if (to.meta.middleware) {
    const middleware = Array.isArray(to.meta.middleware)
        ? to.meta.middleware
        : [to.meta.middleware];

    const context = {
      from,
      next,
      router,
      to
    };
    const nextMiddleware = nextFactory(context, middleware, 1);

    return middleware[0]({ ...context, next: nextMiddleware });
  }

  return next();
});

export default router;
