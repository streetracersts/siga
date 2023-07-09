import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import "bootstrap/dist/css/bootstrap.css";
import "jquery/dist/jquery.min.js";
import pt from "vee-validate/dist/locale/pt_BR";
import VeeValidate, { Validator } from "vee-validate";
import VueTheMask from "vue-the-mask";
import pt_BR from "vee-validate/dist/locale/pt_BR";
import moment from 'moment';

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
    }
});

//window.jQuery = require('jquery') // << import jquery global
require("bootstrap");

Vue.use(VueTheMask);
//Vue.use(VeeValidate);

Vue.use(VeeValidate, {
  errorBagName: "errors",
  fieldsBagName: "formFields",
  dictionary: pt_BR,
  events: "blur|keyup",
  classes: true,
  classNames: {
    invalid: "invalido"
  }
});
Validator.localize("pt_BR", pt);
Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
