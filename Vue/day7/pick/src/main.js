import Vue from 'vue'

import vant from "vant"
import "vant/lib/index.css"
Vue.use(vant)

import { CouponCell, CouponList } from 'vant';

Vue.use(CouponCell).use(CouponList);

import App from './App.vue'
import router from './router'
import store from './store'


Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
