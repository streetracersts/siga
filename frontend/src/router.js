import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home.vue";
import Pessoas from "./components/Pessoas.vue";
import Tipopessoa from "./components/Tipopessoa.vue";
import Tiposervico from "./components/Tiposervico.vue";
import Navios from "./components/Navios.vue";
import Os from "./components/Oss.vue";

Vue.use(Router); 

export default new Router({
  routes: [
    {
      path: "/",
      name: "home",
      component: Home
    },
    {
      path: "/about",
      name: "about",
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () =>
        import(/* webpackChunkName: "about" */ "./views/About.vue")
    },
    {
      path: "/pessoas",
      name: "pessoas",
      component: Pessoas
    },
    {
      path: "/tipopessoa",
      name: "tipopessoa",
      component: Tipopessoa
    },
    {
      path: "/tiposervico",
      name: "tiposervico",
      component: Tiposervico
    },
    {
      path: "/navios",
      name: "navios",
      component: Navios
    },
    {
      path: "/oss",
      name: "oss",
      component: Os
    }
  ]
});
