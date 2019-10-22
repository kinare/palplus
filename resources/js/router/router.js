import Vue from "vue";
import Router from "vue-router";
import NotFound from "../views/error/NotFound";
import Home from "../views/Home";
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

    //fallback rout
    {
      path: "*",
      component: NotFound
    }
  ]
});
