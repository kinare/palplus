import Vue from "vue";
import Router from "vue-router";
import store from "../store/store";
import nextFactory from "./middleware/MiddlewareFactory";
import palplus from "../palplus"
import Home from "../views/Home"
import Wallets from "../views/wallet/Wallets";
import Transactions from "../views/wallet/Transactions";
import { authRoutes } from "../modules/auth";
import { auth } from "./middleware";
import Currency from "../views/currency/Currency";
import Admins from "../views/admin/Admins";

Vue.use(Router);

const router =new Router({
  mode: "history",
  base: process.env.BASE_URL,
    routes: [
        {
            path : "/",
            component : palplus,
            children : [
                {
                    path: '/',
                    name: 'home',
                    component: Home,
                    meta : { middleware : auth}
                },
                {
                    path: '/wallets',
                    name: 'wallets',
                    component: Wallets,
                    meta : { middleware : auth}
                },
                {
                    path: '/wallets-transactions/:type?',
                    name: 'Transactions',
                    component: Transactions,
                    meta : { middleware : auth},
                    props : true
                },
                {
                    path: '/currency-rates',
                    name: 'Currency',
                    component: Currency,
                    meta : { middleware : auth},
                },
                {
                    path: '/admins',
                    name: 'Admins',
                    component: Admins,
                    meta : { middleware : auth},
                },
                {
                    path: '/tables',
                    name: 'tables',
                    // route level code-splitting
                    // this generates a separate chunk (about.[hash].js) for this route
                    // which is lazy-loaded when the route is visited.
                    component: () => import(/* webpackChunkName: "tables" */ '../views/Tables.vue')
                },
                {
                    path: '/forms',
                    name: 'forms',
                    component: () => import(/* webpackChunkName: "forms" */ '../views/Forms.vue')
                },
                {
                    path: '/profile',
                    name: 'profile',
                    component: () => import(/* webpackChunkName: "profile" */ '../views/Profile.vue')
                },
                {
                    path: '/client/new',
                    name: 'client.new',
                    component: () => import(/* webpackChunkName: "client-form" */ '../views/ClientForm.vue')
                },
                {
                    path: '/client/:id',
                    name: 'client.edit',
                    component: () => import(/* webpackChunkName: "client-form" */ '../views/ClientForm.vue'),
                    props: true
                }
            ]
        },
        ...authRoutes
    ],
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
});

/* Collapse mobile aside menu on route change */
router.afterEach(() => {
    store.commit('asideMobileStateToggle', false)
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
