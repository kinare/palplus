import Vue from "vue";
import Router from "vue-router";
import store from "../store/store";
import nextFactory from "./middleware/MiddlewareFactory";
import palplus from "../palplus"
import Home from "../views/Home"
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
                    component: Home
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
        }
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
