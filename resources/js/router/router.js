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
      name: "Dashboard",
      component: Dashboard
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
